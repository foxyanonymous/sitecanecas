@extends("layout.index")

@section("conteudo")


        <!-- Single Page Header start -->
         
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Contatos e Localização</h1>
        </div>
        <!-- Single Page Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="preto">Entre em contato conosco</h1>
                            </div>
                        </div>
                        <div class="col-lg-5 mx-auto">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Endereço</h4>
                                    <p class="mb-2">Rua Nelson de Oliveira Guimarães, 50, Jardim Eldorado, Santa Cruz do Rio Pardo, CEP: 18903-100
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>E-mail</h4>
                                    <p class="mb-2" style="word-break: break-word;">ramoscanecas2909@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telefone</h4>
                                    <p class="mb-2">+55 (14) 99827-1995</p>
                                </div>
                            </div>
                            <br> <br>
                            <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="preto">Localização Maps</h1>
                            </div>
                            <br>
                        </div>
                            <div class="col-lg-12 centralizar">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1545.4706352234834!2d-49.620145123212154!3d-22.884977221061185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaf37ab6bae39473d%3A0xf5b8bf46c855494e!2sRamos%20Canecas!5e0!3m2!1sen!2sbd!4v1726591809820!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


@endsection