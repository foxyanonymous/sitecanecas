@extends("layoutadmin.indexadmin")

@section("conteudoadmin")
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Vendas</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabela de Vendas
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comprador</th>
                                <th>E-mail</th> <!-- Coluna para o e-mail -->
                                <th>Data</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($vendas->isEmpty())
                                <tr>
                                    <td colspan="5">Nenhuma venda encontrada.</td>
                                </tr>
                            @else
                                @foreach ($vendas as $venda)
                                    <tr>
                                        <td>{{ $venda->id }}</td>
                                        <td>{{ $venda->comprador_nome }}</td> <!-- Nome do comprador -->
                                        <td>{{ $venda->comprador_email }}</td> <!-- Aqui você deve usar o campo correto do modelo Venda -->
                                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <!-- Botão para mostrar detalhes da venda -->
                                            <button class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#details{{ $venda->id }}" aria-expanded="false" aria-controls="details{{ $venda->id }}">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Detalhes da Venda -->
                                    <tr class="collapse" id="details{{ $venda->id }}">
                                        <td colspan="5">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Produto</th>
                                                            <th>Quantidade</th>
                                                            <th>Preço Unitário</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($venda->produtos as $produto) <!-- Aqui você deve garantir que tenha o relacionamento correto -->
                                                            <tr>
                                                                <td>{{ $produto->nome }}</td>
                                                                <td>{{ $produto->pivot->quantidade }}</td> <!-- A quantidade deve estar na tabela pivot -->
                                                                <td>R$ {{ number_format($produto->pivot->preco, 2, ',', '.') }}</td> <!-- O preço deve estar na tabela pivot -->
                                                                <td>R$ {{ number_format($produto->pivot->quantidade * $produto->pivot->preco, 2, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
