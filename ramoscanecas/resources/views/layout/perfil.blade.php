@extends('layout.index')

@section('conteudo')
    <div class="container">
        <h1>Meu Perfil</h1>
        <p><strong>Nome:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <a href="{{ route('logout') }}" class="btn btn-danger">Sair</a>
    </div>
@endsection
