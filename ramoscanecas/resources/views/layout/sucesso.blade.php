@extends('layout.index')

@section('conteudo')
<div class="confetti"></div> <!-- Adicionando o fundo animado -->
<div class="container mt-custom">
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 600px; min-height: 400px;"> <!-- Aumentando a altura mínima do card -->
            <div class="card-body" style="padding: 40px;"> <!-- Aumentando o padding interno do card -->
                <h1 class="text-center">🎉 Compra Aprovada! 🎉</h1> <!-- Centralizando o título -->
                <p class="text-center" style="font-size: 24px;">Parabéns pela sua compra! Estamos processando seu pedido e em breve você receberá mais informações.</p> <!-- Centralizando o texto e aumentando o tamanho -->
                <a href="/minhascompras" class="btnsucesso btn-success mt-4 d-block mx-auto">Ver Minhas Compras</a> <!-- Centralizando o botão -->
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa; /* Cor de fundo suave */
    }
    .mt-custom {
        margin-top: 200px; /* Ajuste a margem superior */
    }
    .card {
        border-radius: 15px; /* Arredondar bordas do card */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra para o card */
        background: white; /* Fundo branco para o card */
    }
    .card-body {
        text-align: center; /* Centraliza o texto */
    }
    h1 {
        font-size: 48px; /* Aumentando o tamanho do título */
        color: #28a745; /* Cor verde para o título */
        font-weight: bold; /* Negrito */
    }
    .btnsucesso {
        border-radius: 10px; /* Bordas arredondadas para botões */
        padding: 10px 20px; /* Padding interno do botão */
        font-size: 20px; /* Aumentando o tamanho do texto do botão */
    }
    .btn-success {
        background-color: #28a745; /* Cor de fundo do botão de sucesso */
        border: none; /* Remove borda do botão */
    }
    .btn:hover {
        opacity: 0.9; /* Efeito ao passar o mouse sobre os botões */
    }
    .confetti {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        background: url('https://cdn.pixabay.com/animation/2024/05/02/07/43/07-43-00-535_512.gif') repeat; /* Faz o GIF repetir */
        background-size: 500px auto; /* Define um tamanho menor para o fundo */
        z-index: -1; /* Coloca o fundo atrás do conteúdo */
    }
</style>

@endsection
