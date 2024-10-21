@extends("layout.index_login")

@section("conteudo_login")
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('cadastrar.post') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-48">
                        <img src="layout/img/logo.png" alt="Ramos Canecas" width="200" height="120">
                        <a href="/" class="btn-back-home"><i class="fa fa-arrow-left"></i></a>
                    </span>
                    <span class="login100-form-title p-b-50">Cadastrar</span>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="wrap-input100 validate-input" data-validate="Nome é obrigatório">
                        <input class="input100" type="text" name="name" value="{{ old('name') }}">
                        <span class="focus-input100" data-placeholder="Nome"></span>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Email válido é necessário: a@b.c">
                        <input class="input100" type="email" name="email" value="{{ old('email') }}">
                        <span class="focus-input100" data-placeholder="Email"></span>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Senha é obrigatória">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Senha"></span>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Confirme sua senha">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password_confirmation">
                        <span class="focus-input100" data-placeholder="Confirmar Senha"></span>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">Cadastrar</button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">Já tem uma conta?</span>
                        <a class="txt2" href="/login">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
