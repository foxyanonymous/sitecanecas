<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <title>Ramos Canecas</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="icon" type="image/png" href="layout/img/caneca.png">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="/layout/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="/layout/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/layout/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/layout/css/style.css" rel="stylesheet">

        
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Inicio Topo -->
        <div class="container-fluid fixed-top">
            <!-- Primeiro Inicio -->
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3">
                        <i class="fas fa-map-marker-alt me-2 azulescuro"></i> 
                        <a class="text-white">Santa Cruz do Rio Pardo - SP</a>
                    </small>
                    <small class="me-3">
                        <i class="fab fa-whatsapp me-2 azulescuro"></i>
                        <a class="text-white" href="https://wa.me/5514998271995" target="_blank">+55 (14) 99827-1995</a>
                    </small>
                    <small class="me-3">
                        <i class="fab fa-instagram me-2 azulescuro"></i>
                        <a class="text-white" href="https://instagram.com/ramos_canecas" target="_blank">@ramos_canecas</a>
                    </small>
                </div>
                    <div class="pe-2">
                        <a href="/politicas" class="branco"><small class="branco mx-2">Politícas de Privacidade</small></a>
                    </div>
                </div>
            </div>
            <!-- Primeiro Fim -->

            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="/" class="navbar-brand"><img src="layout/img/logo.png" alt="Ramos Canecas" width="150" height="80"></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars topoazulclaro"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                            <a href="/sobrenos" class="nav-item nav-link {{ request()->is('sobrenos') ? 'active' : '' }}">Sobre Nós</a>


                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle {{ request()->is('categorias') ? 'active' : '' }}" data-bs-toggle="dropdown">Categorias</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    @foreach ($categorias as $categoria)
                                        <a href="{{ $categoria->caminho }}" class="dropdown-item {{ request()->is($categoria->caminho) ? 'active' : '' }}">
                                            {{ $categoria->nome }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>



                            <a href="/contatos" class="nav-item nav-link {{ request()->is('contatos') ? 'active' : '' }}">Contatos</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border topoazulescuro btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="/carrinho" class="position-relative me-4 my-auto">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                                    <span class="shopping-cart-count position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                        {{ session('cart') ? count(session('cart')) : 0 }}
                                    </span>

                                </i>
                            </a>

                            <!-- LOGIN -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user fa-2x"></i>
                                </a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0" aria-labelledby="userDropdown">
                                    @if(Auth::check())
                                        <div class="dropdown-header text-black fw-bold" style="font-size: 1.0rem; color: #00ceff;">
                                            <!-- Exibe o primeiro nome do usuário em destaque -->
                                            Olá, {{ explode(' ', Auth::user()->name)[0] }}
                                        </div>
                                        <a class="dropdown-item" href="/perfil">Meu perfil</a>
                                        
                                        <a class="dropdown-item" href="/compras">Minhas compras</a>
                                        
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Sair</button>
                                        </form>
                                    @else
                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                        <a class="dropdown-item" href="{{ route('cadastrar') }}">Cadastrar</a>
                                    @endif
                                </div>
                            </div>



                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Fim Topo -->


        <!-- Pesquisa Inicio Topo -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pesquisar...</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pesquisa Fim Topo -->


        <div class="content">
        @yield("conteudo")
        </div>


        <!-- Inicio Rodapé -->
        <div class="container-fluid fundoazulescuro text-white-50 footer mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(26, 35, 15, 0.5);">
                    <div class="row g-4 align-items-center text-center text-md-start">
                        
                        <!-- Bloco Localização -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-item">
                                <h4 class="text-light mb-3">Localização</h4>
                                <p class="mb-4">Rua Nelson de Oliveira Guimarães, 50,<br>Jardim Eldorado, Santa Cruz do Rio Pardo,<br>CEP: 18903-100</p>
                            </div>
                        </div>
                        
                        <!-- Bloco Logo -->
                        <div class="col-lg-4 col-md-6 text-center">
                            <a href="/">
                                <img src="layout/img/logo.png" alt="Ramos Canecas" width="200" height="125" class="img-fluid mx-auto d-block">
                            </a>
                        </div>
                        
                        <!-- Bloco Redes Sociais -->
                        <div class="col-lg-4 col-md-6 text-center">
                            <h5 class="branco">Siga nossas redes sociais</h5>
                            <div class="d-flex justify-content-center">
                                <ul class="social list-inline">
                                    <li class="list-inline-item"><a href="https://www.facebook.com/profile.php?id=100093601226477"><img src="layout/img/facebook.png" alt="Facebook"></a></li>
                                    <li class="list-inline-item"><a href="https://wa.me/5514998271995"><img src="layout/img/whatsapp.png" alt="WhatsApp"></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/ramos_canecas"><img src="layout/img/instagram.png" alt="Instagram"></a></li>
                                </ul>
                            </div>
                            <!-- Botão Login Administrador -->
                            <div class="mt-3">
                                <a href="/loginadmin" class="btn btn-light">Login Administrador</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p>© 2024 Ramos Canecas - Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
        <!-- Fim Rodapé -->



        <!-- LIBRAS  -->
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
        <!-- Fim LIBRAS -->

        
    <!-- JavaScript Biblioteca -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/layout/js/bootstrap.bundle.min.js"></script>
    <script src="layout/lib/easing/easing.min.js"></script>
    <script src="layout/lib/waypoints/waypoints.min.js"></script>
    <script src="layout/lib/lightbox/layout/js/lightbox.min.js"></script>
    <script src="layout/lib/owlcarousel/owl.carousel.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="layout/js/main.js"></script>

    <!-- barra lateral celular -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    <!-- Carrinho -->
    <script>
        let cart = [];

        function addToCart(productId, productName, productPrice) {
            const existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
            }
            updateCartDisplay();
        }

        function updateCartDisplay() {
            // Lógica para atualizar a visualização do carrinho, se necessário
            console.log(cart);
        }
    </script>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-form').on('submit', function(e) {
                e.preventDefault(); // Impede o envio normal do formulário
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        // Atualize o ícone do carrinho aqui
                        let cartCount = response.cartCount; // Supondo que você retorne isso do controller
                        $('.shopping-cart-count').text(cartCount);
                    },
                    error: function() {
                        console.error('Erro ao adicionar produto ao carrinho.'); // Log de erro no console
                    }
                });
            });

            // Para a atualização da quantidade
            $('.quantity-input').on('input', function() {
                let quantity = $(this).val();
                let price = $(this).closest('tr').find('.total-price').data('price');
                let totalPrice = price * quantity;
                $(this).closest('tr').find('.total-price').text('R$ ' + totalPrice.toFixed(2).replace('.', ','));

                // Atualiza total geral do carrinho
                updateCartTotal();

                // Envia a atualização ao servidor via AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).closest('form').attr('action'),
                    data: $(this).closest('form').serialize(),
                    success: function(response) {
                        // Opcional: processar resposta do servidor
                    },
                    error: function() {
                        console.error('Erro ao atualizar quantidade no carrinho.'); // Log de erro no console
                    }
                });
            });

            function updateCartTotal() {
                let grandTotal = 0;
                $('.total-price').each(function() {
                    let priceText = $(this).text().replace('R$ ', '').replace('.', '').replace(',', '.');
                    grandTotal += parseFloat(priceText);
                });
                $('.grand-total').text('R$ ' + grandTotal.toFixed(2).replace('.', ','));
            }
        });
    </script>





    </body>
</html>