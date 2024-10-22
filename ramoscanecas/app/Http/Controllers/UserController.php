<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa o model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth
use Illuminate\Support\Facades\Hash; // Importa a classe Hash

class UserController extends Controller
{
    // Exibir todos os usuários
    public function index()
    {
        // Verifique se o admin está logado
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        // Obtenha todos os usuários do banco de dados
        $users = User::all();

        // Passe os dados de usuários para a view do painel
        return view('layoutadmin.painel', compact('users'));
    }

    // Método para criar um novo usuário
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Método para editar um usuário
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Método para atualizar um usuário
    public function update(Request $request, $id)
    {
        // Validação de dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        // Verifique se o usuário atual é um administrador
        if (!Auth::guard('admin')->check()) {
            // Para usuários não administradores, verifique a senha atual
            $request->validate([
                'current_password' => 'required|string',
            ]);

            // Verifica se a senha atual está correta
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
            }
        }

        // Atualize os dados do usuário
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');
    }


    // Método para deletar um usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Usuário deletado com sucesso!');
    }
}
