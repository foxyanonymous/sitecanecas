@extends("layout.index")

@section("conteudo")

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{ isset($categoria) ? $categoria->nome : 'Todos os Produtos' }}</h1>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite">
    <div class="container py-5">
        <h1 class="mb-4">Categorias</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex mb-4"> <!-- Margem inferior para espaçamento -->
                            <input type="search" class="form-control p-3" placeholder="Pesquisar por..." aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                        <!-- Exibe as categorias em formato de lista -->
                        <ul class="list-unstyled fruite-categorie">
                            @foreach($categorias as $categoria) <!-- Loop através das categorias -->
                                <li class="mb-3"> <!-- Margem inferior para espaçamento -->
                                    <div class="d-flex justify-content-between fruite-name">
                                        <!-- Exibindo o nome da categoria e o número de produtos -->
                                        <a href="{{ url($categoria->caminho) }}"><i class="fas fa-mug-hot me-2"></i>{{ $categoria->nome }}</a>
                                        <span>({{ $categoria->produtos->count() }})</span> <!-- Contando os produtos associados à categoria -->
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Início dos itens de produtos -->
                    <div class="col-lg-9"> <!-- Coluna para os produtos -->
                        <div class="row g-4">
                            @foreach($produtos as $produto)
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded border border-secondary fruite-item h-100 d-flex flex-column" style="min-height: 350px;"> <!-- Contorno do produto e altura mínima -->
                                        <div class="fruite-img position-relative flex-grow-1">
                                            <img src="{{ asset($produto->imagem) }}" class="img-fluid w-100 rounded-top" alt="{{ $produto->nome }}" style="height: 200px; object-fit: cover;"> <!-- Ajustando a imagem -->
                                            <span class="position-absolute top-0 start-0 bg-dark text-white p-2" style="opacity: 0.8;">
                                                {{ $produto->categoria->nome }}
                                            </span>
                                        </div>
                                        <div class="p-4 border-top-0 rounded-bottom text-center"> <!-- Centralizando o texto -->
                                            <h4 class="mb-3">{{ $produto->nome }}</h4> <!-- Margem inferior para espaçamento -->
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-1 mx-auto">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                                <a href="#" class="btn border azulclaro rounded-pill px-3 branco mx-auto">
                                                    <i class="fas fa-shopping-cart me-2 azulescuro"></i> Adicionar ao Carrinho
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

@endsection
