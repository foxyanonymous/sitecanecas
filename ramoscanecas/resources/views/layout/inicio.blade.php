@extends("layout.index")

@section("conteudo")
    <body>

            <!-- Hero Start -->
            <!DOCTYPE html>
            <html lang="pt-BR">
            
            <body>
            <div class="container-fluid p-0">
            <div class="mt-5"></div> <br><br><br><br><br>
                <img src="/layout/img/bannersite.png" class="img-fluid w-100" alt="Banner do site">
            </div>
            </body>
            </html>

            <!-- Hero End -->



            <!-- Featurs Section Start -->
            <div class="container-fluid featurs py-5">
                <div class="container py-5">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="featurs-item text-center rounded bg-light p-4">
                                <div class="featurs-icon btn-square rounded-circle azulescuroinicio mb-5 mx-auto">
                                    <i class="fas fa-car-side fa-3x branco"></i>
                                </div>
                                <div class="featurs-content text-center">
                                    <h5>Entrega Grátis</h5>
                                    <p class="mb-0">Entrega grátis em Santa Cruz do Rio Pardo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="featurs-item text-center rounded bg-light p-4">
                                <div class="featurs-icon btn-square rounded-circle azulescuroinicio mb-5 mx-auto">
                                    <i class="fas fa-trophy fa-3x branco"></i>
                                </div>
                                <div class="featurs-content text-center">
                                    <h5>Cliente Satisfeito</h5>
                                    <p class="mb-0">+ 1.000 clientes satisfeitos com nosso trabalho</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="featurs-item text-center rounded bg-light p-4">
                                <div class="featurs-icon btn-square rounded-circle azulescuroinicio mb-5 mx-auto">
                                    <i class="fas fa-scroll fa-3x branco"></i>
                                </div>
                                <div class="featurs-content text-center">
                                    <h5>Nota Fiscal</h5>
                                    <p class="mb-0">Emissão de Nota Fiscal para empresas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="featurs-item text-center rounded bg-light p-4">
                                <div class="featurs-icon btn-square rounded-circle azulescuroinicio mb-5 mx-auto">
                                    <i class="fab fa-whatsapp fa-3x branco"></i>
                                </div>
                                <div class="featurs-content text-center">
                                    <h5>Suporte</h5>
                                    <p class="mb-0">Suporte imediato através do WhatsApp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featurs Section End -->


            <!-- Fruits Shop Start-->
            <div class="container-fluid fruite py-3">
                <div class="container py-5">
                    <div class="tab-class text-center">
                        <div class="row g-4">
                            <div class="centralizar">
                                <h1 class="display-5 mb-1 text-dark">Canecas Personalizadas<br><br></h1>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane fade show p-0 active">
                                        <div class="row g-4">
                                            <!-- Início dos itens -->
                                            @php
                                                // Limitar a exibição a 8 produtos
                                                $produtosVisiveis = $produtos->take(8);
                                            @endphp

                                            @foreach($produtosVisiveis as $produto)
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                    <div class="rounded position-relative fruite-item h-100">
                                                        <div class="fruite-img position-relative">
                                                            <img src="{{ asset($produto->imagem) }}" class="img-fluid w-100 rounded-top" alt="{{ $produto->nome }}">
                                                            <span class="position-absolute top-0 start-0 bg-dark text-white p-2" style="opacity: 0.8;">
                                                                {{ $produto->categoria->nome }}
                                                            </span>
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
                                        <div class="mt-4 text-end">
                                            <a href="{{ url('/produtos') }}" class="btn btn-outline-azulclaro rounded-circle py-3 px-4">
                                                Ver todos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fruits Shop End-->



            <!-- Featurs Start -->
            <div class="container-fluid service py-5">
                <div class="centralizar">
                    <h1 class="display-5 mb- text-dark">Categorias</h1>
                </div>
                <div class="container py-5">
                    <div class="row g-4 justify-content-center">
                        @php
                            // Limitar a exibição a 8 categorias
                            $categoriasVisiveis = $categorias->take(6);
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
                    <div class="mt-4 text-end">
                        <a href="{{ url('/categorias') }}" class="btn btn-outline-azulclaro rounded-circle py-3 px-4">
                            Ver todos
                        </a>
                    </div>
                </div>
            </div>
            <!-- Features End -->



            @php
                $clientes = App\Models\Cliente::all();
            @endphp
            <!-- Testimonial Start -->
            <div class="container-fluid testimonial py-5">
                <div class="container py-3">
                    <div class="testimonial-header text-center">
                        <h1 class="display-5 mb-5 text-dark">Nossos Clientes</h1>
                    </div>
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($clientes as $cliente)
                            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                                <div class="d-flex align-items-center flex-nowrap">
                                    <div class="bg-secondary rounded">
                                        <!-- Usar asset() corretamente para exibir a imagem -->
                                        <img src="{{ asset($cliente->imagem) }}" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="{{ $cliente->nome }}">
                                    </div>
                                    <div class="ms-4 d-block">
                                        <h4 class="text-dark">{{ $cliente->nome }}</h4>
                                        <div class="d-flex pe-5">
                                            @for ($i = 0; $i < $cliente->avaliacao; $i++)
                                                <i class="fas fa-star amarelo"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



    </html>
@endsection