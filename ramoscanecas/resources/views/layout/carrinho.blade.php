@extends("layout.index")

@section("conteudo")

<!-- Single Page Header start --> 
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Meu Carrinho</h1>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            @if(count($cart) === 0)
                <div class="text-center">
                    <i class="fa fa-shopping-cart" style="font-size: 100px; opacity: 0.5;"></i>
                    <h2 class="mt-3" style="opacity: 0.5;">O carrinho está vazio</h2>
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Produtos</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">QTD</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('atualizar.carrinho') }}" method="POST" class="update-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="number" name="quantity" class="form-control form-control-sm border-0 quantity-input" value="{{ $item['quantity'] }}" min="1" style="width: 60px; font-size: 1.0em; text-align: center">
                                    </form>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total-price" data-price="{{ $item['price'] }}">
                                        R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                                    </p>
                                </td>
                                <td>
                                    <form action="{{ route('remover.carrinho', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Cupom de desconto">
            <button class="btn azulescuroinicio rounded-pill px-4 py-3 text-white" type="button">Aplicar</button>
        </div>

        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Total <span class="fw-normal">do Carrinho</span></h1>
                        @php
                            $total = 0;
                            foreach ($cart as $item) {
                                $total += $item['price'] * $item['quantity'];
                            }
                        @endphp
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 grand-total">R$ {{ number_format($total, 2, ',', '.') }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ $link }}" class="btn azulescuroinicio rounded-pill px-4 py-3 text-white text-uppercase mb-4 ms-4">Prosseguir para o Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection
