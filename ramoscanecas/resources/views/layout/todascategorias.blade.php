@extends("layout.index")

@section("conteudo")
            <!-- Single Page Header start -->
            <div class="container-fluid page-header py-5">
                <h1 class="text-center text-white display-6">Todas Categorias</h1>
            </div>
            <!-- Single Page Header End -->

            <!-- Featurs Start -->
            <div class="container-fluid service py-5">
                <div class="container py-5">
                    <div class="row g-4 justify-content-center">
                        @php
                            // Limitar a exibição a 8 categorias
                            $categoriasVisiveis = $categorias->take(100);
                        @endphp

                        @foreach ($categoriasVisiveis as $categoria)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ url($categoria->caminho) }}">
                                    <div class="service-item azulclaro rounded border border-secondary">
                                        <img src="{{ asset($categoria->imagem) }}" class="img-fluid rounded-top w-100" alt="{{ $categoria->nome }}">
                                        <div class="px-4 rounded-bottom">
                                            <div class="text-center p-4 rounded">
                                                <h1 class="mb-0 branco">➜</h1>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Features End -->



@endsection