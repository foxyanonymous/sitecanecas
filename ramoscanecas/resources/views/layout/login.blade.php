
@extends("layout.index_login")

@section("conteudo_login")


<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-48">
                        <img src="layout/img/logo.png" alt="Ramos Canecas" width="200" height="120">
                        <a href="/" class="btn-back-home"><i class="fa fa-arrow-left"></i></a>
                    </span>
                    <span class="login100-form-title p-b-50">Login</span>

                    <div class="wrap-input100 validate-input" data-validate="Email inválido">
                        <input class="input100" type="email" name="email" value="{{ old('email') }}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Insira sua senha">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Senha"></span>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">Entrar</button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">Não tem uma conta?</span>
                        <a class="txt2" href="/cadastrar">Cadastrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


	

@endsection

