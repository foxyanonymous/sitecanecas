<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/layoutadmin/css/loginadmin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <title>Painel de Login Admin</title>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <form class="login100-form validate-form" action="{{ route('admin.loginadmin.post') }}" method="POST">
                @csrf
                <div class="login100-form-title">
                <a href="/" class="back-arrow">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <img src="layout/img/logo.png" alt="Admin Logo" width="200" height="120" style="display: block; margin: 0 auto;">
                </div>
                <span class="login100-form-title">Painel de Login Admin</span>

                <div class="wrap-input100 validate-input" data-validate="Email inválido">
                    <label for="email">Email</label>
                    <input class="input100" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input" data-validate="Insira sua senha">
                    <label for="password">Senha</label>
                    <input class="input100" type="password" name="password" id="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

    <style>
        /* Estilo para a flecha de voltar */
        .back-arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #333; /* Preto/cinza */
            font-size: 24px;
            text-decoration: none;
        }
        .back-arrow:hover {
            color: #666; /* Cor um pouco mais clara ao passar o mouse */
        }
    </style>