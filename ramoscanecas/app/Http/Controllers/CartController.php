<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Importar o modelo Produto
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class CartController extends Controller
{
    // Exibir o carrinho
    public function index()
    {
        $cart = session()->get('cart', []);
        $link = 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=APP_USR-6929085682425094-102318-14d8c636e314db0c436d215702d3f28e-2055353488';

        return view('layout.carrinho', compact('cart', 'link'));
    }

    // Método para processar os itens do carrinho
    public function processCartItems()
    {
        $cart = session()->get('cart', []);
        $total = 0; // Inicializa o total

        // Loop para processar cada item do carrinho
        foreach ($cart as $id => $product) {
            $total += $product['price'] * $product['quantity']; // Calcular o total
            // Aqui você pode adicionar mais lógica, como verificar disponibilidade de estoque ou outras ações
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
        $cart = session()->get('cart');
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
                'description' => 'Descrição do produto',
                'quantity' => $product['quantity'],
                'currency_id' => 'BRL',
                'unit_price' => $product['price'],
            ];
        }

        $payer = [
            'name' => 'Cliente Teste',
            'surname' => 'Teste Sobrenome',
            'email' => 'email_teste@example.com',
        ];

        $request = $this->createPreferenceRequest($items, $payer);

        $client = new PreferenceClient();

        try {
            $preference = $client->create($request);
            \Log::info('Preferência criada com sucesso:', ['id' => $preference->id, 'init_point' => $preference->init_point]);

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
            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failed'),
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

    public function success(Request $request)
    {
        return view('layout.success');
    }

    public function failed(Request $request)
    {
        return view('layout.failed');
    }
}
