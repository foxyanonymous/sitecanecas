<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;
use App\Http\Controllers\PesquisarController;
use App\Http\Controllers\ProdutoController;


Route::get('/', function () {
    return view('layout.inicio');
});

/* PÁGINAS ESTÁTICAS */
Route::get('/contatos', function () {
    return view('layout.contatos');
});

Route::get('/localizacao', function () {
    return view('layout.contatos');
});

Route::get('/sobrenos', function () {
    return view('layout.sobrenos');
});

Route::get('/error', function () {
    return view('layout.error');
});

// Rota error redirecionar
Route::fallback(function () {
    return redirect('/error');
});


Route::get('/politicas', function () {
    return view('layout.politicas');
});

Route::get('/categorias', function () {
    return view('layout.categorias');
});

Route::get('/detalhe', function () {
    return view('layout.detalhe');
});

/* LOGIN */
Route::get('/login', function () {
    return view('layout.login');
})->name('login');

Route::get('/cadastrar', function () {
    return view('layout.cadastrar');
})->name('cadastrar');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/cadastrar', [AuthController::class, 'cadastrar'])->name('cadastrar.post');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

/* ROTA CARRINHO */
Route::get('/carrinho', function () {
    return view('layout.carrinho');
})->name('carrinho');

/* ADMINISTRADOR */
Route::get('/loginadmin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/loginadmin', [AdminController::class, 'login'])->name('admin.loginadmin.post');
Route::post('/', [AdminController::class, 'logout'])->name('admin.logout');

// Rota para o painel admin
Route::get('/paineladmin', [AdminController::class, 'index'])->name('paineladmin');
Route::delete('/paineladmin/deletar/{id}', [AdminController::class, 'destroy'])->name('admin.deletar');
Route::put('/paineladmin/atualizar/{id}', [AdminController::class, 'atualizar'])->name('admin.atualizar'); // Corrigido para 'atualizar'
Route::post('/paineladmin/criar', [AdminController::class, 'salvar'])->name('admin.criar');


// Rota para o painel de usuários
Route::get('/painel', [UserController::class, 'index'])->name('usuarios.index');
Route::post('/painel/criar', [UserController::class, 'create'])->name('usuarios.criar');
Route::put('/painel/atualizar/{id}', [UserController::class, 'update'])->name('usuarios.atualizar');
Route::delete('/painel/deletar/{id}', [UserController::class, 'destroy'])->name('usuarios.deletar');

//Clientes
Route::get('/clientes/{id}', [ClienteController::class, 'getCliente']); // Rota para buscar dados de cliente via AJAX
Route::resource('clientes', ClienteController::class);

// Categoria
Route::get('/painelcategorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{id}', [CategoriaController::class, 'getCategoria'])->name('categorias.show'); // Adicionando nome para a rota
Route::resource('categorias', CategoriaController::class)->except(['index', 'show']); // Excluindo a rota de index e show

//PesquisarAdmin
Route::get('/pesquisar', [PesquisarController::class, 'pesquisar'])->name('pesquisa');

//Produtos
Route::prefix('painelprodutos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index'); // Lista todos os produtos
    Route::post('/', [ProdutoController::class, 'store'])->name('produtos.store'); // Adiciona um novo produto
    Route::get('/create', [ProdutoController::class, 'create'])->name('produtos.create'); // Exibe o formulário para criar um novo produto
    Route::get('/{id}', [ProdutoController::class, 'getProduto'])->name('produtos.show'); // Mostra um produto específico para edição
    Route::put('/{id}', [ProdutoController::class, 'update'])->name('produtos.update'); // Atualiza um produto
    Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy'); // Remove um produto
});

// Rota dinâmica para exibir a categoria com seus produtos
Route::get('/{caminho}', [CategoriaController::class, 'show']);
