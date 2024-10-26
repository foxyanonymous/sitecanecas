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
                                <th>E-mail</th>
                                <th>Data</th>
                                <th>Status do Pagamento</th>
                                <th>Referência Externa</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($vendas->isEmpty())
                                <tr>
                                    <td colspan="7">Nenhuma venda encontrada.</td>
                                </tr>
                            @else
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td>{{ $venda->id }}</td>
                                    <td>{{ $venda->comprador_nome }}</td>
                                    <td>{{ $venda->comprador_email }}</td>
                                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ ucfirst($venda->status) }}</td>
                                    <td>{{ $venda->external_reference }}</td>
                                    <td>
                                        <button class="btn btn-info toggle-details" data-venda-id="{{ $venda->id }}">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Detalhes da Venda -->
                                <tr class="details" id="details-{{ $venda->id }}" style="display: none;">
                                    <td colspan="7">
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
                                                    @foreach ($venda->produtos as $produto)
                                                        <tr>
                                                            <td>{{ $produto->nome }}</td>
                                                            <td>{{ $produto->pivot->quantidade }}</td>
                                                            <td>R$ {{ number_format($produto->pivot->preco, 2, ',', '.') }}</td>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButtons = document.querySelectorAll(".toggle-details");

        toggleButtons.forEach(button => {
            button.addEventListener("click", function () {
                const vendaId = this.getAttribute("data-venda-id");
                const detailsRow = document.getElementById(`details-${vendaId}`);

                if (detailsRow.style.display === "none") {
                    detailsRow.style.display = "table-row";
                    this.querySelector("i").classList.replace("fa-chevron-down", "fa-chevron-up");
                } else {
                    detailsRow.style.display = "none";
                    this.querySelector("i").classList.replace("fa-chevron-up", "fa-chevron-down");
                }
            });
        });
    });
</script>

<style>
    .toggle-details {
        cursor: pointer;
    }
</style>
@endsection
