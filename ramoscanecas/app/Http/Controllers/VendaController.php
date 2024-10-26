<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        // Carregar as vendas, incluindo o nome do comprador e detalhes do produto
        $vendas = Venda::with('produto')->get(); // Aqui precisamos ter certeza de que a relação produto está definida no modelo Venda

        return view('layoutadmin.painelvendas', compact('vendas'));
    }
}
