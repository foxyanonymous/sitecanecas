@extends("layout.index")

@section("conteudo")

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{ $categoria->nome }}</h1>
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
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="Pesquisar por..." aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Exibe as categorias em formato de lista -->
                    <div class="col-lg-3"> <!-- Agora será fixado em 3 colunas para as categorias -->
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
                            <!-- Início dos itens -->
                            @foreach($produtos as $produto)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item h-100">
                                    <div class="fruite-img position-relative">
                                        <img src="{{ asset($produto->imagem) }}" class="img-fluid w-100 rounded-top" alt="{{ $produto->nome }}">
                                        <span class="position-absolute top-0 start-0 bg-dark text-white p-2" style="opacity: 0.8;">
                                            {{ $produto->categoria->nome }}
                                        </span> <!-- Exibe a categoria sobre a imagem -->
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $produto->nome }}</h4>
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
