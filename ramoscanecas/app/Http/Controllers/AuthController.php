<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa o model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth
use Illuminate\Support\Facades\Hash; // Importa a classe Hash

class AuthController extends Controller
{
    // Método para cadastrar um novo usuário
    public function cadastrar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Verifica se o email já existe
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Método para fazer login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('carrinho'); // Redirecionar para a view layout.carrinho após login
        }

        return back()->withErrors(['email' => 'As credenciais não correspondem aos nossos registros.']);
    }

    // Método para logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirecionar para a página de login após logout
    }
}
