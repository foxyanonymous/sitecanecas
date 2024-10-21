@extends("layoutadmin.indexadmin")

@section("conteudoadmin")

<div class="container" style="margin-top: 100px;">
    <h1 class="text-center">{{ isset($cliente) ? 'Editar Cliente' : 'Adicionar Cliente' }}</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
        @csrf
        @if (isset($cliente))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ isset($cliente) ? $cliente->nome : '' }}" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" {{ isset($cliente) ? '' : 'required' }}>
            @if (isset($cliente) && $cliente->imagem)
                <img src="{{ asset($cliente->imagem) }}" class="img-fluid rounded" alt="{{ $cliente->nome }}">
            @endif
        </div>
        <div class="mb-3">
            <label for="avaliacao" class="form-label">Avaliação (1 a 5)</label>
            <input type="number" class="form-control" id="avaliacao" name="avaliacao" value="{{ isset($cliente) ? $cliente->avaliacao : '' }}" min="1" max="5" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">{{ isset($cliente) ? 'Atualizar' : 'Adicionar' }}</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>

    <h2 class="mt-5 text-center">Lista de Clientes</h2>
    <div class="owl-carousel testimonial-carousel">
        @foreach ($clientes as $cliente)
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="d-flex align-items-center flex-nowrap">
                    <div class="bg-secondary rounded">
                        <img src="{{ asset($cliente->imagem) }}" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                    </div>
                    <div class="ms-4 d-block">
                        <h4 class="text-dark">{{ $cliente->nome }}</h4>
                        <div class="d-flex pe-5">
                            @for ($i = 0; $i < $cliente->avaliacao; $i++)
                                <i class="fas fa-star amarelo"></i>
                            @endfor
                        </div>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                        <a href="#" class="btn btn-warning" onclick="event.preventDefault(); editCliente({{ $cliente->id }});">Editar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal para editar clientes -->
<div class="modal fade" id="editClienteModal" tabindex="-1" aria-labelledby="editClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClienteModalLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClienteForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="editImagem" name="imagem" accept="image/*">
                        <img id="editImagemPreview" src="#" class="img-fluid rounded mt-3" alt="Preview" style="display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="editAvaliacao" class="form-label">Avaliação (1 a 5)</label>
                        <input type="number" class="form-control" id="editAvaliacao" name="avaliacao" min="1" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editCliente(clienteId) {
        fetch('/clientes/' + clienteId)
            .then(response => response.json())
            .then(cliente => {
                // Preencher os campos do formulário de edição com os dados do cliente
                document.getElementById('editNome').value = cliente.nome;
                document.getElementById('editAvaliacao').value = cliente.avaliacao;

                // Atualizar a imagem de pré-visualização
                const preview = document.getElementById('editImagemPreview');
                preview.src = '{{ asset('') }}' + cliente.imagem; // Adicione o caminho completo
                preview.style.display = 'block';

                // Atualizar o formulário para apontar para a rota correta
                const form = document.getElementById('editClienteForm');
                form.action = '/clientes/' + clienteId;

                // Mostrar o modal
                const modal = new bootstrap.Modal(document.getElementById('editClienteModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Erro ao buscar cliente:', error);
            });
    }

    document.getElementById('editClienteForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impedir o envio padrão do formulário

        let form = this;
        let formData = new FormData(form); // Captura todos os dados do formulário

        // Enviar o formulário via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao atualizar cliente');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Recarregar a página após salvar o cliente
                location.reload(); // Recarrega a página
            } else {
                alert('Erro ao salvar as alterações!');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao atualizar o cliente.');
        });
    });
</script>

@endsection
