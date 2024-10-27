@extends('layout.index')

@section('conteudo')
    <div class="container mt-custom"> <!-- Aplicando a margem superior personalizada -->
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 450px;"> <!-- Aumentando a largura do card -->
                <div class="card-body">
                    <h1 class="text-center mb-4">Meu Perfil</h1> <!-- Título dentro do formulário -->

                    <!-- Exibir mensagens de sucesso ou erro -->
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Digite a nova senha">
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirme a nova senha">
                        </div>

                        <div class="mb-4">
                            <label for="current_password" class="form-label">Senha Atual</label>
                            <input type="password" class="form-control form-control-lg" id="current_password" name="current_password" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg me-2">Confirmar Alterações</button>
                            <a href="{{ url('/') }}" class="btn btn-warning btn-lg">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .mt-custom {
            margin-top: 200px; /* Ajuste a margem superior */
        }
        .card {
            border-radius: 15px; /* Arredondar bordas do card */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra para o card */
        }
        .card-body {
            padding: 30px; /* Padding interno do card */
        }
        h1 {
            font-size: 24px; /* Tamanho do título */
            color: #333; /* Cor do título */
        }
        .form-label {
            font-weight: bold; /* Negrito para rótulos dos campos */
        }
        .form-control {
            border-radius: 10px; /* Bordas arredondadas para campos de entrada */
            border: 1px solid #ced4da; /* Cor da borda */
        }
        .btn {
            border-radius: 10px; /* Bordas arredondadas para botões */
        }
        .btn-success {
            background-color: #28a745; /* Cor de fundo do botão de sucesso */
            border: none; /* Remove borda do botão */
        }
        .btn-warning {
            background-color: #ffc107; /* Cor de fundo do botão de voltar */
            border: none; /* Remove borda do botão */
        }
        .btn:hover {
            opacity: 0.9; /* Efeito ao passar o mouse sobre os botões */
        }
    </style>
@endsection
