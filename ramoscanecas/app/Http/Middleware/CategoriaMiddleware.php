<?php

namespace App\Http\Middleware;

use App\Models\Categoria;
use Closure;
use Illuminate\Http\Request;

class CategoriaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Obter todas as categorias
        $categorias = Categoria::all();

        // Compartilhar a variável $categorias com todas as views
        view()->share('categorias', $categorias);

        return $next($request);
    }
}
