@extends("layout.index")

@section("conteudo")


        <!-- Single Page Header start --> 
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Detalhes</h1>
        </div>
        <!-- Single Page Header End -->



        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="layout/img/testemoc.png" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h1 class="fw-bold mb-3">Caneca Personalizada Dia dos Pais</h1>
                                <h5 class="mb-3">Categoria: Dia dos Pais</h5>
                                <h2 class="fw-bold mb-3">R$ 35,00</h2>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fas fa-shopping-cart me-2 text-primary"></i>Adicionar no carrinho</a>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Descrição</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p>Descubra a elegância e a funcionalidade da nossa caneca de porcelana personalizada! Ideal para apreciar suas bebidas quentes ou frias, essa caneca combina um design sofisticado com a possibilidade de personalização completa. Perfeita para presentear em datas especiais ou para adicionar um toque único à sua coleção, ela é feita com material de alta qualidade que garante durabilidade e resistência. </p>
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Capacidade</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">325ml</p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Material</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Porcelana de alta qualidade</p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Personalização</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Impressão de alta definição</p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Ideal para bebidas</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Quentes e frias</p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Peso</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">0.33 kg</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        <div class="d-flex">
                                            <img src="layout/img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Jason Smith</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="layout/img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Sam Peters</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0">Outros Produtos</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        <div class="border border-secondary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <a href="/detalhe">
                                    <img src="layout/img/testemoc.png" class="img-fluid w-100 rounded-top" alt="">
                                </a>
                            </div>
                            <div class="p-4 pb-0 rounded-bottom text-center">
                                <h4>Caneca Personalizada</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <p class="text-dark fs-5 fw-bold">R$ 35.00</p>
                                    <a href="#" class="btn border azulclaro rounded-pill px-3 py-1 mb-4 branco"><i class="fas fa-shopping-cart me-2 azulescuro"></i>Adicionar no carrinho</a>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <a href="/detalhe">
                                    <img src="layout/img/testemoc.png" class="img-fluid w-100 rounded-top" alt="">
                                </a>
                            </div>
                            <div class="p-4 pb-0 rounded-bottom text-center">
                                <h4>Caneca Personalizada</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <p class="text-dark fs-5 fw-bold">R$ 35.00</p>
                                    <a href="#" class="btn border azulclaro rounded-pill px-3 py-1 mb-4 branco"><i class="fas fa-shopping-cart me-2 azulescuro"></i>Adicionar no carrinho</a>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <a href="/detalhe">
                                    <img src="layout/img/testemoc.png" class="img-fluid w-100 rounded-top" alt="">
                                </a>
                            </div>
                            <div class="p-4 pb-0 rounded-bottom text-center">
                                <h4>Caneca Personalizada</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <p class="text-dark fs-5 fw-bold">R$ 35.00</p>
                                    <a href="#" class="btn border azulclaro rounded-pill px-3 py-1 mb-4 branco"><i class="fas fa-shopping-cart me-2 azulescuro"></i>Adicionar no carrinho</a>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <a href="/detalhe">
                                    <img src="layout/img/testemoc.png" class="img-fluid w-100 rounded-top" alt="">
                                </a>
                            </div>
                            <div class="p-4 pb-0 rounded-bottom text-center">
                                <h4>Caneca Personalizada</h4>
                                <div class="d-flex flex-column align-items-center">
                                    <p class="text-dark fs-5 fw-bold">R$ 35.00</p>
                                    <a href="#" class="btn border azulclaro rounded-pill px-3 py-1 mb-4 branco"><i class="fas fa-shopping-cart me-2 azulescuro"></i>Adicionar no carrinho</a>
                                </div>
                            </div>
                        </div>


                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->

@endsection