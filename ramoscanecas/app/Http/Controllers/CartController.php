<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Importar o modelo Produto

class CartController extends Controller
{
    // Exibir o carrinho
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('layout.carrinho', compact('cart'));
    }

    // Adicionar produto ao carrinho
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Padrão 1 se não for especificado

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

        // Retorne a contagem do carrinho como resposta JSON
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
}
