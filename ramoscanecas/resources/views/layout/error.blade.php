@extends("layout.index")

@section("conteudo")
        <!-- 404 Start -->
        <div class="container-fluid py-5" style="margin-top: 150px;">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                        <h1 class="display-1">404</h1>
                        <h1 class="mb-4">Página não encontrada</h1>
                        <p class="mb-4">Desculpe, a página que você procurou não existe em nosso site!</p>
                        <a class="btn border-secondary rounded-pill py-3 px-5" href="/">Ir para página inicial</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->
@endsection