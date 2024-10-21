@extends('layoutadmin.indexadmin')

@section('conteudoadmin')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Resultados da Pesquisa</h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            @if($resultadosAdmin->isEmpty() && $resultadosUser->isEmpty())
                <div class="alert alert-warning text-center">Nenhum resultado encontrado.</div>
            @else
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Administradores</h5>
                            </div>
                            <div class="card-body">
                                @if($resultadosAdmin->isEmpty())
                                    <div class="alert alert-info">Nenhum administrador encontrado.</div>
                                @else
                                    <div class="list-group">
                                        @foreach($resultadosAdmin as $resultado)
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $resultado->name }}</h5>
                                                    <small>{{ \Carbon\Carbon::parse($resultado->created_at)->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1">{{ $resultado->email }}</p>
                                                <small>Admin</small>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Usuários Normais</h5>
                            </div>
                            <div class="card-body">
                                @if($resultadosUser->isEmpty())
                                    <div class="alert alert-info">Nenhum usuário normal encontrado.</div>
                                @else
                                    <div class="list-group">
                                        @foreach($resultadosUser as $resultado)
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $resultado->name }}</h5>
                                                    <small>{{ \Carbon\Carbon::parse($resultado->created_at)->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1">{{ $resultado->email }}</p>
                                                <small>Usuário</small>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('paineladmin') }}" class="btn btn-secondary">Voltar ao Painel</a>
            </div>
        </div>
    </main>
@endsection
