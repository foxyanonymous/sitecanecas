@extends("layoutadmin.indexadmin")

@section("conteudoadmin")
<div class="container mt-5">
    <h1>Painel de Vendas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
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
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->comprador_nome }}</td>
                    <td>{{ $venda->comprador_email }}</td>
                    <td>{{ $venda->produto->nome ?? 'Produto não encontrado' }}</td>
                    <td>{{ $venda->quantidade }}</td>
                    <td>R$ {{ number_format($venda->preco_unitario, 2, ',', '.') }}</td>
                    <td>{{ $venda->status }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
