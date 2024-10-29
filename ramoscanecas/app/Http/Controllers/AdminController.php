<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Importa Hash
use App\Models\UserAdmin; // Model do administrador

class AdminController extends Controller
{
    // Exibir a página de login do administrador
    public function showLoginForm()
    {
        return view('layoutadmin.loginadmin'); // Ajuste para o caminho correto da view
    }

    // Processar o login do administrador
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/paineladmin'); // Redirecionar após sucesso
        }

        return back()->withErrors(['email' => 'As credenciais estão incorretas'])->withInput();
    }

    // Exibir o painel administrativo
    public function index()
    {
        // Obtenha os usuários administradores do banco de dados
        $users = UserAdmin::all(); // Ou use paginate() se preferir paginar os resultados

        return view('layoutadmin.paineladmin', compact('users')); // Ajuste para o caminho correto da view
    }

    public function salvar(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usersadmin',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Criação do novo usuário
        $user = new UserAdmin();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Usando Hash::make
        $user->save();

        return redirect('/paineladmin')->with('success', 'Usuário criado com sucesso!');
    }

    // Método para deletar usuário
    public function destroy($id)
    {
        $user = UserAdmin::find($id);

        if ($user) {
            $user->delete();
            return redirect('/paineladmin')->with('success', 'Usuário deletado com sucesso!');
        }

        return redirect('/paineladmin')->with('error', 'Usuário não encontrado.');
    }

    // Método para atualizar usuário
    public function atualizar(Request $request, $id)
    {
        $user = UserAdmin::find($id);

        if ($user) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            // Se a senha for enviada, atualize
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'confirmed|min:6',
                ]);
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            return redirect('/paineladmin')->with('success', 'Usuário atualizado com sucesso!');
        }

        return redirect('/paineladmin')->with('error', 'Usuário não encontrado.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->invalidate(); // Invalida a sessão
        session()->regenerateToken(); // Gera um novo token de sessão
        return redirect('/'); // Redireciona para a página inicial
    }
}
