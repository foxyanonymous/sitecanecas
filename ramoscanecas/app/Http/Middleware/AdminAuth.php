<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin'); // Redireciona para o login do administrador, se não autenticado
        }

        return $next($request); // Permite o acesso caso o admin esteja autenticado
    }
}
