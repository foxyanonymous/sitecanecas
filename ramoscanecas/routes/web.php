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
use App\Http\Controllers\CartController;
use App\Http\Controllers\VendaController;

// PÁGINAS ESTÁTICAS
Route::get('/', function () {
    return view('layout.inicio');
});

Route::get('/contatos', function () {
    return view('layout.contatos');
});

Route::get('/localizacao', function () {
    return view('layout.contatos');
});

Route::get('/sobrenos', function () {
    return view('layout.sobrenos');
});

Route::get('/todascategorias', function () {
    return view('layout.todascategorias');
});

Route::get('/todosprodutos', function () {
    return view('layout.todosprodutos');
});

Route::get('/error', function () {
    return view('layout.error');
});

Route::get('/politicas', function () {
    return view('layout.politicas');
});

Route::get('/detalhe', function () {
    return view('layout.detalhe');
});

Route::get('/login', function () {
    return view('layout.login');
})->name('login');

Route::get('/cadastrar', function () {
    return view('layout.cadastrar');
})->name('cadastrar');


// CARRINHO
Route::get('/carrinho', [CartController::class, 'index'])->name('carrinho');
Route::post('/carrinho/adicionar', [CartController::class, 'addToCart'])->name('adicionar.carrinho');
Route::post('/carrinho/atualizar', [CartController::class, 'updateCart'])->name('atualizar.carrinho');
Route::post('/carrinho/remover/{id}', [CartController::class, 'removeFromCart'])->name('remover.carrinho');


//AUTENTICAÇÃO ADMIN
Route::middleware(['auth.admin'])->group(function () {
    // Rota Painel Vendas
    Route::get('/painelvendas', [VendaController::class, 'index'])->name('vendas.index');

    // Rotas para o painel de usuários
    Route::get('/painel', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/painel/criar', [UserController::class, 'create'])->name('usuarios.criar');
    Route::put('/painel/atualizar/{id}', [UserController::class, 'update'])->name('usuarios.atualizar');
    Route::delete('/painel/deletar/{id}', [UserController::class, 'destroy'])->name('usuarios.deletar');

    // Rota para o painel admin
    Route::get('/paineladmin', [AdminController::class, 'index'])->name('paineladmin');
    Route::delete('/paineladmin/deletar/{id}', [AdminController::class, 'destroy'])->name('admin.deletar');
    Route::put('/paineladmin/atualizar/{id}', [AdminController::class, 'atualizar'])->name('admin.atualizar');
    Route::post('/paineladmin/criar', [AdminController::class, 'salvar'])->name('admin.criar');

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
});


// PESQUISAR PRODUTO
Route::get('/pesquisarproduto', [ProdutoController::class, 'pesquisar'])->name('pesquisar.produto');


// PAINEL LOGIN ADMIN
Route::get('/loginadmin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/loginadmin', [AdminController::class, 'login'])->name('admin.loginadmin.post');
Route::post('/', [AdminController::class, 'logout'])->name('admin.logout');


// PAINEL LOGIN
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/cadastrar', [AuthController::class, 'cadastrar'])->name('cadastrar.post');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


// ROTA REDIRECIONAMENTO PÓS-LOGIN
Route::get('/', function () {
    return view('layout.inicio');
})->name('inicio');


//AUTENTICAÇÃO USUARIO
Route::middleware(['user.auth'])->group(function () {
    // Rota Painel de Compras
    Route::get('/minhascompras', [CartController::class, 'minhasCompras'])->name('minhascompras');
    Route::get('/perfil', function () {
        return view('layout.perfil'); // Rota para a view de perfil
    });
    // CHECKOUT MERCADO PAGO
    Route::get('/mercadopago', [CartController::class, 'createPaymentPreference'])->name('mercadopago');
    Route::get('/mercadopago-sucesso', [CartController::class, 'sucesso'])->name('sucesso');
    Route::get('/mercadopago-falha', [CartController::class, 'falha'])->name('falha');
});


// ROTA PARA ATUALIZAR O USUÁRIO
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');


// ROTA DINAMICA PARA EXIBIR A CATEGORIA COM OS PRODUTOS
Route::get('/{caminho}', [CategoriaController::class, 'show']);


// ROTA ERROR FALLBACK
Route::fallback(function () {
    return redirect('/error');
});
