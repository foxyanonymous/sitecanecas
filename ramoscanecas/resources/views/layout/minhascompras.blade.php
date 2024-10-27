@extends('layout.index')

@section('conteudo')
    <div class="container mt-custom min-height-container">
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Minhas Compras</h2>
            <p class="text-muted">Confira o histórico das suas compras abaixo</p>
        </div>

        @if($compras->isEmpty())
            <div class="alert alert-info text-center mt-4">
                <i class="fas fa-info-circle"></i> Você ainda não fez nenhuma compra.
            </div>
        @else
            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Total Pago</th>
                            <th>Status</th>
                            <th>Data da Compra</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr class="text-center align-middle">
                                <td class="font-weight-bold">{{ $compra->produto->nome ?? 'Produto Indisponível' }}</td>
                                <td>{{ $compra->quantidade }}</td>
                                <td>R$ {{ number_format($compra->preco_unitario, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($compra->quantidade * $compra->preco_unitario, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-{{ $compra->status == 'aprovado' ? 'success' : 'warning' }}">
                                        {{ ucfirst($compra->status) }}
                                    </span>
                                </td>
                                <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="https://wa.me/5514998271995" target="_blank" class="btn btn-whatsapp btn-sm">
                                        <i class="fab fa-whatsapp"></i> Suporte
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        /* Estilo personalizado para o layout da página */
        .mt-custom {
            margin-top: 240px; /* Margem superior ampliada */
        }
        .min-height-container {
            min-height: 40vh; /* Altura mínima para empurrar o rodapé para baixo */
            display: flex;
            flex-direction: column;
        }
        .table {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra na tabela */
        }
        .badge-success {
            background-color: #28a745; /* Verde para status aprovado */
        }
        .btn-whatsapp {
            background-color: #25D366; /* Verde padrão do WhatsApp */
            color: #fff;
            border: none;
        }
        .btn-whatsapp:hover {
            background-color: #1EBB58; /* Tom mais escuro ao passar o mouse */
        }
    </style>
@endsection
