<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria; // Importa o modelo Categoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    // Exibe a lista de produtos
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        $produtos = Produto::with('categoria')->get(); // Recupera todos os produtos com categoria
        return view('layoutadmin.painelprodutos', compact('produtos'));
    }

    // Exibe o formulário para criar um novo produto
    public function create()
    {
        $categorias = Categoria::all(); // Recupera todas as categorias
        return view('layoutadmin.createprodutos', compact('categorias'));
    }

    // Armazena um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'descricao' => 'required|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id', // Validação para a categoria
        ]);

        $imagemNome = uniqid() . '.' . $request->imagem->extension();
        $request->imagem->move(public_path('layout/img/produtos'), $imagemNome);

        Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao,
            'imagem' => 'layout/img/produtos/' . $imagemNome,
            'categoria_id' => $request->categoria_id, // Armazena o ID da categoria
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto adicionado com sucesso!');
    }

    // Exibe o formulário para editar um produto existente
    public function getProduto($id)
    {
        $produto = Produto::with('categoria')->findOrFail($id); // Encontra o produto pelo ID
        return response()->json($produto);
    }

    // Atualiza um produto existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'descricao' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id', // Validação para a categoria
        ]);

        $produto = Produto::findOrFail($id);

        if ($request->hasFile('imagem')) {
            if ($produto->imagem) {
                unlink(public_path($produto->imagem));
            }

            $imagemNome = uniqid() . '.' . $request->imagem->extension();
            $request->imagem->move(public_path('layout/img/produtos'), $imagemNome);
            $produto->imagem = 'layout/img/produtos/' . $imagemNome;
        }

        $produto->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id, // Atualiza o ID da categoria
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Remove um produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->imagem) {
            unlink(public_path($produto->imagem));
        }

        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
    }
}
