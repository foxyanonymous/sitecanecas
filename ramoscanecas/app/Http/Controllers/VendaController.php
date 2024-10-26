<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Categoria; // Importa o modelo Categoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index()
    {

        if (!Auth::guard('admin')->check()) {
            return redirect('/loginadmin');
        }

        $vendas = Venda::with('produtos')->get(); // Carrega as vendas com produtos relacionados

        return view('layoutadmin.painelvendas', compact('vendas'));
        
    }
}
