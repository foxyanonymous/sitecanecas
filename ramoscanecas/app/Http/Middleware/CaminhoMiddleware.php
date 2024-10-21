<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CaminhoMiddleware
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
        // Defina o caminho desejado
        $caminho = 'seu/caminho/aqui'; // Altere para o caminho que você deseja compartilhar

        // Compartilhar a variável $caminho com todas as views
        view()->share('caminho', $caminho);

        return $next($request);
    }
}