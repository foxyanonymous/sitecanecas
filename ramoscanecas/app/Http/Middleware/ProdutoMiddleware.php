<?php

namespace App\Http\Middleware;

use App\Models\Produto;
use Closure;
use Illuminate\Http\Request;

class ProdutoMiddleware
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
        // Obter todos os produtos
        $produtos = Produto::all();

        // Compartilhar a variável $produtos com todas as views
        view()->share('produtos', $produtos);

        return $next($request);
    }
}
