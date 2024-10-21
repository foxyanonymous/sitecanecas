@extends("layoutadmin.indexadmin")

@section("conteudoadmin")

<div class="container" style="margin-top: 100px;">
    <h1 class="text-center">{{ isset($produto) ? 'Editar Produto' : 'Adicionar Produto' }}</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($produto) ? route('produtos.update', $produto->id) : route('produtos.store') }}" method="POST" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
        @csrf
        @if (isset($produto))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ isset($produto) ? $produto->nome : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="text" class="form-control" id="preco" name="preco" value="{{ isset($produto) ? $produto->preco : '' }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" required>{{ isset($produto) ? $produto->descricao : '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
                <option value="">Selecione uma Categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ isset($produto) && $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" {{ isset($produto) ? '' : 'required' }}>
            @if (isset($produto) && $produto->imagem)
                <img src="{{ asset($produto->imagem) }}" class="img-fluid rounded mt-3" alt="{{ $produto->nome }}">
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">{{ isset($produto) ? 'Atualizar' : 'Adicionar' }}</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>

    <h2 class="mt-5 text-center">Lista de Produtos</h2>
    <div class="list-group">
        @foreach ($produtos as $produto)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $produto->nome }} ({{ $produto->categoria->nome ?? 'Sem Categoria' }})</span> <!-- Exibir a categoria do produto -->
                <div>
                    <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" style="width: 50px; height: auto;" class="me-2">
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                    <a href="#" class="btn btn-warning btn-sm" onclick="event.preventDefault(); editProduto({{ $produto->id }});">Editar</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal para editar produtos -->
<div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="editProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdutoModalLabel">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProdutoForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPreco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="editPreco" name="preco" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="editDescricao" name="descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoria" class="form-label">Categoria</label>
                        <select class="form-select" id="editCategoria" name="categoria_id" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
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
    function editProduto(produtoId) {
        fetch('/painelprodutos/' + produtoId)
            .then(response => response.json())
            .then(produto => {
                document.getElementById('editNome').value = produto.nome;
                document.getElementById('editPreco').value = produto.preco;
                document.getElementById('editDescricao').value = produto.descricao;
                document.getElementById('editCategoria').value = produto.categoria_id; // Preenche a categoria
                document.getElementById('editProdutoForm').action = '/painelprodutos/' + produtoId; // Atualiza a ação do formulário com o ID correto
                $('#editProdutoModal').modal('show'); // Mostra o modal
            })
            .catch(error => {
                console.error('Erro ao buscar o produto:', error);
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
