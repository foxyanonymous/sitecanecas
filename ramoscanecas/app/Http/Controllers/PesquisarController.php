<?php

namespace App\Http\Controllers;

use App\Models\User; // Modelo para a tabela de usuários normais
use App\Models\UserAdmin; // Modelo para a tabela de administradores
use Illuminate\Http\Request;

class PesquisarController extends Controller
{
    public function pesquisar(Request $request)
    {
        // Captura o termo de pesquisa do usuário
        $termo = $request->input('query');

        // Verifica se o termo de pesquisa está vazio
        if (empty($termo)) {
            // Redireciona de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'O termo de pesquisa não pode estar vazio.');
        }

        // Realiza a pesquisa por usuários administradores cujo nome contém o termo digitado
        $resultadosAdmin = UserAdmin::where('name', 'like', '%' . $termo . '%')->get();

        // Realiza a pesquisa por usuários normais cujo nome contém o termo digitado
        $resultadosUser = User::where('name', 'like', '%' . $termo . '%')->get();

        // Adiciona informações de log para depuração
        \Log::info('Termo de pesquisa: ' . $termo);
        \Log::info('Resultados encontrados (Admin): ', $resultadosAdmin->toArray());
        \Log::info('Resultados encontrados (User): ', $resultadosUser->toArray());

        // Retorna a view com os resultados
        return view('layoutadmin.pesquisa', compact('resultadosAdmin', 'resultadosUser'));
    }
}
