@extends("layoutadmin.indexadmin")

@section("conteudoadmin")
<div class="container mt-custom">
    
    <h1 class="mt-5">Painel de Vendas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nome do Comprador</th>
                    <th>Email do Comprador</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Status</th>
                    <th>Data da Venda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendas as $venda)
                    <tr class="text-center align-middle">
                        <td>{{ $venda->id }}</td>
                        <td>{{ $venda->comprador_nome }}</td>
                        <td>{{ $venda->comprador_email }}</td>
                        <td>{{ $venda->produto->nome ?? 'Produto não encontrado' }}</td>
                        <td>{{ $venda->quantidade }}</td>
                        <td>R$ {{ number_format($venda->preco_unitario, 2, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $venda->status == 'aprovado' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($venda->status) }}
                            </span>
                        </td>
                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .mt-custom {
        margin-top: 50px; /* Ajuste a margem superior */
    }
    .table {
        border-radius: 15px; /* Bordas arredondadas para a tabela */
        overflow: hidden; /* Evita que as bordas arredondadas sejam cortadas */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra para a tabela */
    }
    .table th, .table td {
        text-align: center; /* Centraliza o texto das células */
        vertical-align: middle; /* Centraliza verticalmente o conteúdo das células */
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa; /* Cor de fundo das linhas ímpares */
    }
    .badge {
        border-radius: 10px; /* Bordas arredondadas para os badges */
    }
</style>
@endsection
