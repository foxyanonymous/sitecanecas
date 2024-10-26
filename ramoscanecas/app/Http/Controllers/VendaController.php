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
    
        // Carregando as vendas com produtos
        $vendas = Venda::with('produtos')->get(); // Use 'produtos' no plural
    
        return view('layoutadmin.painelvendas', compact('vendas'));
    }
}
