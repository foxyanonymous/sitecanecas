<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Importar o modelo Produto
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use App\Models\Venda;

class CartController extends Controller
{
    // Exibir o carrinho
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('layout.carrinho', compact('cart'));
    }

    // Método para processar os itens do carrinho
    public function processCartItems()
    {
        $cart = session()->get('cart', []);
        $total = 0; // Inicializa o total

        // Loop para processar cada item do carrinho
        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity']; // Calcular o total
        }

        return response()->json([
            'total' => $total,
            'cartCount' => count($cart),
        ]);
    }

    // Adicionar produto ao carrinho
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Produto::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado!'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->nome,
                'price' => $product->preco,
                'quantity' => $quantity,
                'image' => $product->imagem,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['cartCount' => count(session('cart'))]);
    }

    // Remover produto do carrinho
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produto removido do carrinho!');
    }

    // Atualizar quantidade do produto no carrinho
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Carrinho atualizado!');
    }

    // Função para autenticar o Mercado Pago
    protected function authenticate()
    {
        $mpAccessToken = env('MERCADO_PAGO_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    // Função para criar a preferência de pagamento no Mercado Pago
    public function createPaymentPreference()
    {
        $this->authenticate();

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Carrinho está vazio!');
        }

        $items = [];
        foreach ($cart as $id => $product) {
            $items[] = [
                'id' => $id,
                'title' => $product['name'],
                'description' => 'Descrição do produto', // Melhorar a descrição se necessário
                'quantity' => intval($product['quantity']),
                'currency_id' => 'BRL',
                'unit_price' => floatval($product['price']),
            ];
        }

        $payer = [
            'name' => 'Cliente Teste', // Melhorar com dados reais se disponíveis
            'surname' => 'Teste Sobrenome',
            'email' => 'email_teste@example.com',
        ];

        $request = $this->createPreferenceRequest($items, $payer);
        $client = new PreferenceClient();

        try {
            $preference = $client->create($request);
            $link = $preference->init_point;

            return redirect()->away($link);
        } catch (MPApiException $error) {
            \Log::error('Erro Mercado Pago: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Erro ao criar a preferência de pagamento! Por favor, tente novamente.');
        }
    }

    // Função para criar a requisição de preferência
    protected function createPreferenceRequest($items, $payer)
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1,
        ];

        $backUrls = [
            'success' => route('sucesso'),
            'failure' => route('falha'),
        ];

        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NOME_DA_EMPRESA",
            "external_reference" => uniqid(),
            "expires" => false,
            "auto_return" => 'approved',
        ];
    }

    // Método para checkout
    public function checkout()
    {
        $link = $this->createPaymentPreference();

        if ($link) {
            return redirect()->away($link); // Redirecionar para o link externo
        }

        return redirect()->back()->with('error', 'Erro ao criar preferência de pagamento.');
    }

    public function sucesso(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (!empty($cart)) {
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);
            
            // Obtém o usuário autenticado
            $user = auth()->user(); // Pega o usuário autenticado
            // Salvar a venda no banco
            foreach ($cart as $id => $item) {
                Venda::create([
                    'comprador_nome' => $user->name, // Usa o nome real do usuário
                    'comprador_email' => $user->email, // Usa o e-mail real do usuário
                    'id_produto' => $item['id'], // Usar o ID do produto, que é a chave do item no carrinho
                    'quantidade' => $item['quantity'], // A quantidade do produto
                    'preco_unitario' => $item['price'], // O preço unitário do produto
                    'status' => 'aprovado', // Defina o status da venda
                    'external_reference' => uniqid(), // Se necessário, gere a referência externa
                ]);
            }
            
            // Limpa o carrinho após o checkout
            session()->forget('cart');
        }
        
        return view('layout.sucesso');
    }

    public function minhasCompras()
    {
        $user = auth()->user();
        
        // Obtém as compras do usuário pelo email (ou outro identificador) no modelo Venda
        $compras = Venda::where('comprador_email', $user->email)->get();

        // Retorna a view com os dados das compras
        return view('layout.minhascompras', compact('compras'));
    }

    public function falha(Request $request)
    {
        // Aqui você pode registrar a falha do pagamento em logs, se necessário
        \Log::error('Pagamento falhou', [
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'request' => $request->all(),
        ]);

        // Redireciona para a view de falha
        return view('layout.falha'); // Certifique-se de que a view 'falha.blade.php' existe
    }


}
