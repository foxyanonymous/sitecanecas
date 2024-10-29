@extends("layout.index")

@section("conteudo")

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Resultados da Pesquisa</h1>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid fruite">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Coluna para categorias -->
            <div class="col-xl-3">
                <h1 class="mb-4">Categorias</h1>
                <!-- Exibe as categorias em formato de lista -->
                <ul class="list-unstyled fruite-categorie">
                    <div class="d-flex justify-content-between fruite-name">
                        <a href="{{ url('/todosprodutos') }}"><i class="fas fa-mug-hot me-2"></i>Todos</a>
                        <span>({{ \App\Models\Produto::count() }})</span> <!-- Conta todos os produtos -->
                    </div>
                    @foreach($categorias as $cat) <!-- Loop através de todas as categorias -->
                        <li class="mb-3"> <!-- Margem inferior para espaçamento -->
                            <div class="d-flex justify-content-between fruite-name">
                                <!-- Exibindo o nome da categoria e o número de produtos -->
                                <a href="{{ url($cat->caminho) }}"><i class="fas fa-mug-hot me-2"></i>{{ $cat->nome }}</a>
                                <span>({{ $cat->produtos->count() }})</span> <!-- Contando os produtos associados à categoria -->
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Coluna para produtos -->
            <div class="col-xl-9">
                <div class="row g-4">
                    @if($produtos->count())
                        @foreach($produtos as $produto)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div class="border border-secondary rounded position-relative fruite-item h-100 d-flex flex-column">
                                    <div class="fruite-img position-relative flex-grow-1">
                                        <img src="{{ asset($produto->imagem) }}" class="img-fluid w-100 rounded-top" alt="{{ $produto->nome }}">
                                        <span class="position-absolute top-0 start-0 bg-dark text-white p-2" style="opacity: 0.8;">
                                            {{ $produto->categoria->nome }}
                                        </span>
                                    </div>
                                    <div class="p-4 border-top-0 rounded-bottom">
                                        <h4 class="text-center text-truncate" style="overflow: hidden; white-space: nowrap;">{{ $produto->nome }}</h4>
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-1">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                            <div class="d-flex justify-content-center w-100">
                                                <form action="{{ route('adicionar.carrinho') }}" method="POST" class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $produto->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn border azulclaro rounded-pill px-3 branco">
                                                        <i class="fas fa-shopping-cart me-2 azulescuro"></i> Adicionar ao Carrinho
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center" style="margin-top: 100px;"> <!-- Ajuste o valor conforme necessário -->
                            <p class="fs-2 fw-bold text-dark" style="opacity: 0.7;">Nenhum produto encontrado<br>para sua pesquisa.</p>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

@endsection
