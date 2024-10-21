<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class ClienteController extends Controller
{
    // Exibir todos os clientes
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        $clientes = Cliente::all();
        return view('layoutadmin.clientes', compact('clientes'));
    }

    // Método para mostrar um cliente específico via AJAX
    public function getCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    // Método para armazenar um novo cliente
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'required|image|mimes:jpeg,png|max:2048',
            'avaliacao' => 'required|integer|min:1|max:5',
        ]);

        // Armazenar a imagem
        $imagemNome = uniqid() . '_' . $request->file('imagem')->getClientOriginalName();
        $request->file('imagem')->move(public_path('layout/img/clientes'), $imagemNome);

        // Criar um novo cliente
        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->imagem = 'layout/img/clientes/' . $imagemNome;
        $cliente->avaliacao = $request->avaliacao;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente adicionado com sucesso!');
    }

    // Método para atualizar um cliente existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpeg,png|max:2048',
            'avaliacao' => 'required|integer|min:1|max:5',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->nome = $request->nome;
        
        // Atualizar imagem se uma nova for enviada
        if ($request->hasFile('imagem')) {
            // Remover a imagem antiga se existir
            if ($cliente->imagem && file_exists(public_path($cliente->imagem))) {
                unlink(public_path($cliente->imagem));
            }
            // Armazenar a nova imagem
            $imagemNome = uniqid() . '_' . $request->file('imagem')->getClientOriginalName();
            $request->file('imagem')->move(public_path('layout/img/clientes'), $imagemNome);
            $cliente->imagem = 'layout/img/clientes/' . $imagemNome;
        }

        $cliente->avaliacao = $request->avaliacao;
        $cliente->save();

        // Retornar resposta JSON
        return response()->json(['success' => true, 'message' => 'Cliente atualizado com sucesso!']);
    }

    // Método para deletar um cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        // Remover imagem do servidor, se existir
        if ($cliente->imagem && file_exists(public_path($cliente->imagem))) {
            unlink(public_path($cliente->imagem));
        }
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}
