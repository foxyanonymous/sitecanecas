@extends("layoutadmin.indexadmin")

@section("conteudoadmin")

<div class="container" style="margin-top: 100px;">
    <h1 class="text-center">{{ isset($categoria) ? 'Editar Categoria' : 'Adicionar Categoria' }}</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($categoria) ? route('categorias.update', $categoria->id) : route('categorias.store') }}" method="POST" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
        @csrf
        @if (isset($categoria))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ isset($categoria) ? $categoria->nome : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="caminho" class="form-label">Caminho</label>
            <input type="text" class="form-control" id="caminho" name="caminho" value="{{ isset($categoria) ? $categoria->caminho : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" {{ isset($categoria) ? '' : 'required' }}>
            @if (isset($categoria) && $categoria->imagem)
                <img src="{{ asset($categoria->imagem) }}" class="img-fluid rounded mt-3" alt="{{ $categoria->nome }}">
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">{{ isset($categoria) ? 'Atualizar' : 'Adicionar' }}</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>

    <h2 class="mt-5 text-center">Lista de Categorias</h2>
    <div class="list-group">
        @foreach ($categorias as $categoria)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $categoria->nome }}</span>
                <div>
                    <img src="{{ asset($categoria->imagem) }}" alt="{{ $categoria->nome }}" style="width: 50px; height: auto;" class="me-2">
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                    <a href="#" class="btn btn-warning btn-sm" onclick="event.preventDefault(); editCategoria({{ $categoria->id }});">Editar</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal para editar categorias -->
<div class="modal fade" id="editCategoriaModal" tabindex="-1" aria-labelledby="editCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoriaModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoriaForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCaminho" class="form-label">Caminho</label>
                        <input type="text" class="form-control" id="editCaminho" name="caminho" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="editImagem" name="imagem" accept="image/*">
                        <img id="editImagemPreview" src="#" class="img-fluid rounded mt-3" alt="Preview" style="display: none;">
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editCategoria(categoriaId) {
        fetch('/categorias/' + categoriaId)
            .then(response => response.json())
            .then(categoria => {
                document.getElementById('editNome').value = categoria.nome;
                document.getElementById('editCaminho').value = categoria.caminho;
                document.getElementById('editCategoriaForm').action = '/categorias/' + categoriaId; // Atualiza a ação do formulário com o ID correto
                $('#editCategoriaModal').modal('show'); // Mostra o modal
            })
            .catch(error => {
                console.error('Erro ao buscar a categoria:', error);
            });
    }

    document.getElementById('editImagem').addEventListener('change', function (event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('editImagemPreview');
            preview.src = reader.result;
            preview.style.display = 'block'; // Exibe a imagem de pré-visualização
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

@endsection
