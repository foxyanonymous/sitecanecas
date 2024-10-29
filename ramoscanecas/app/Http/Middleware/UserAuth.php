<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            // Se não estiver autenticado, redireciona para a página de login
            return redirect('/login')->withErrors(['message' => 'Você precisa estar logado para acessar esta página.']);
        }

        // Se estiver autenticado, continua a requisição
        return $next($request);
    }
}
