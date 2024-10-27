@extends('layout.index')

@section('conteudo')
<div class="container mt-custom">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg" style="width: 700px; min-height: 450px; border-radius: 20px;"> <!-- Aumentando largura e altura -->
            <div class="card-body text-center d-flex flex-column align-items-center justify-content-center"> <!-- Flexbox para centralização -->
                <h1 style="color: #dc3545; font-size: 64px;">❌</h1> <!-- Aumentando o tamanho do ícone -->
                <h2 class="mb-4" style="color: #dc3545; font-weight: bold; font-size: 40px;">Falha no Pagamento!</h2> <!-- Aumentando o tamanho do título -->
                <p class="message-text">Infelizmente, houve um problema com o seu pagamento. Por favor, tente novamente mais tarde ou entre em contato com o suporte para assistência.</p> <!-- Adicionando classe específica -->
                <a href="/carrinho" class="btnfalha btn-primary btn-lg" style="padding: 10px 30px; border-radius: 10px;">Voltar</a> <!-- Mantendo o botão embaixo do texto -->
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f0f2f5; /* Cor de fundo suave */
    }
    .mt-custom {
        margin-top: 200px; /* Ajustando a margem superior para descer o footer */
    }
    .card {
        background: white; /* Fundo branco para o card */
        transition: transform 0.3s; /* Animação ao passar o mouse */
    }
    .card:hover {
        transform: translateY(-10px); /* Levanta o card ao passar o mouse */
    }
    h1 {
        font-size: 64px; /* Tamanho do ícone aumentado */
    }
    h2 {
        font-size: 40px; /* Tamanho do título aumentado */
        margin-bottom: 20px; /* Espaçamento abaixo do título */
    }
    .message-text { /* Classe específica para o parágrafo */
        font-size: 20px; /* Tamanho do texto da mensagem aumentado */
        color: #555; /* Cor do texto da mensagem */
        line-height: 1.5; /* Altura da linha para melhor legibilidade */
        margin-bottom: 30px; /* Margem inferior para espaçamento */
        text-align: center; /* Centralizando o texto da mensagem */
    }
    .btnfalha {
        padding: 10px 30px; /* Aumentando o padding interno do botão */
        border-radius: 10px; /* Bordas arredondadas para botões */
        font-size: 20px; /* Tamanho do texto do botão */
    }
    .btn-primary {
        background-color: #007bff; /* Cor azul para o botão */
        border: none; /* Remove borda do botão */
        transition: background-color 0.3s; /* Animação ao passar o mouse */
    }
    .btn-primary:hover {
        background-color: #0056b3; /* Cor mais escura ao passar o mouse */
    }
</style>

@endsection
