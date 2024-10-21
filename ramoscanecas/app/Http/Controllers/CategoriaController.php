<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    // Exibe a lista de categorias
    public function index()
    {
        // Verifica se o usuário está autenticado como administrador
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        // Obtém todas as categorias
        $categorias = Categoria::all();

        // Retorna a view com as categorias
        return view('layoutadmin.painelcategorias', compact('categorias'));
    }

    // Armazena uma nova categoria
    public function store(Request $request)
    {
        // Valida os dados da requisição
        $request->validate([
            'nome' => 'required|string|max:255',
            'caminho' => 'required|string|max:255|unique:categorias',
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Armazena a imagem
        $imagemNome = uniqid() . '_' . $request->file('imagem')->getClientOriginalName();
        $request->file('imagem')->move(public_path('layout/img/categorias'), $imagemNome);

        // Cria a nova categoria
        $categoria = Categoria::create([
            'nome' => $request->nome,
            'caminho' => $request->caminho,
            'imagem' => 'layout/img/categorias/' . $imagemNome,
        ]);

        // Cria o arquivo .blade.php para a nova categoria
        $this->createBladeFile($request->caminho);

        // Redireciona com mensagem de sucesso
        return redirect()->route('categorias.index')->with('success', 'Categoria adicionada com sucesso!');
    }

    protected function createBladeFile($caminho)
    {
        $filePath = resource_path("views/layout/categorias/{$caminho}.blade.php");

        // Verifica se o arquivo já existe para evitar sobrescrita
        if (!File::exists($filePath)) {
            // Conteúdo padrão da nova view que inclui o arquivo de categorias
            $conteudo = "@extends('layout.index')\n@section('conteudo')\n" .
                "@include('layout.categorias.categorias')\n" .
                "@endsection\n";

            // Cria o arquivo com o conteúdo gerado
            File::put($filePath, $conteudo);
        }
    }

    // Exibe a categoria específica
    public function show($caminho)
    {
        // Encontra a categoria pelo caminho
        $categoria = Categoria::where('caminho', $caminho)->first();

        // Verifica se a categoria foi encontrada
        if (!$categoria) {
            // Redireciona para a página de erro se a categoria não existir
            return redirect('/error');
        }

        // Obtém os produtos relacionados à categoria
        $produtos = $categoria->produtos;

        // Retorna a view da categoria com os produtos
        return view("layout.categorias.$caminho", compact('categoria', 'produtos'));
    }

    // Atualiza uma categoria existente
    public function update(Request $request, $id)
    {
        // Valida os dados da requisição
        $request->validate([
            'nome' => 'required|string|max:255',
            'caminho' => 'required|string|max:255|unique:categorias,caminho,' . $id,
        ]);

        // Encontra a categoria ou lança uma exceção se não encontrar
        $categoria = Categoria::findOrFail($id);

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Armazena a nova imagem
            $imagemNome = uniqid() . '_' . $request->file('imagem')->getClientOriginalName();
            $request->file('imagem')->move(public_path('layout/img/categorias'), $imagemNome);
            $categoria->imagem = 'layout/img/categorias/' . $imagemNome;
        }

        // Atualiza os dados da categoria
        $categoria->nome = $request->nome;
        $categoria->caminho = $request->caminho;
        $categoria->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Remove uma categoria
    public function destroy($id)
    {
        // Encontra a categoria ou lança uma exceção se não encontrar
        $categoria = Categoria::findOrFail($id);

        // Remove a imagem do servidor, se existir
        if (File::exists(public_path($categoria->imagem))) {
            File::delete(public_path($categoria->imagem));
        }

        // Remove o arquivo .blade.php correspondente
        $this->deleteBladeFile($categoria->caminho);

        // Remove a categoria do banco de dados
        $categoria->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('categorias.index')->with('success', 'Categoria removida com sucesso!');
    }

    protected function deleteBladeFile($caminho)
    {
        $filePath = resource_path("views/layout/categorias/{$caminho}.blade.php");

        // Verifica se o arquivo existe e o remove
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

    public function getCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }
}
