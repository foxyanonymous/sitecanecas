@extends("layout.index")

@section("conteudo")

        <!-- Single Page Header start --> 
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
        </div>
        <!-- Single Page Header End -->


       <!-- Página de Checkout Início -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Já é quase seu...</h1>
                <form action="#">
                    <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Nome<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Sobrenome<sup>*</sup></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">CEP<sup>*</sup></label>
                            <input type="text" class="form-control" id="cep">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Rua<sup>*</sup></label>
                            <input type="text" class="form-control" id="rua">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Número<sup>*</sup></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Bairro<sup>*</sup></label>
                            <input type="text" class="form-control" id="bairro">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Cidade<sup>*</sup></label>
                            <input type="text" class="form-control" id="cidade">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Celular<sup>*</sup></label>
                            <input type="tel" class="form-control">
                        </div>
                    </div>

                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                <table class="table text-center"> <!-- Adicionando text-center para centralizar o texto -->
                                    <thead>
                                        <tr>
                                            <th scope="col">Produtos</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Preço</th>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-center"> <!-- Adicione text-center aqui -->
                                                <div class="d-flex justify-content-center align-items-center mt-2"> <!-- Adicione justify-content-center -->
                                                    <img src="layout/img/testemoc.png" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5 text-center">Caneca Dia dos Pais</td> <!-- Adicione text-center aqui -->
                                            <td class="py-5 text-center">R$ 35,00</td> <!-- Adicione text-center aqui -->
                                            <td class="py-5 text-center">1</td> <!-- Adicione text-center aqui -->
                                            <td class="py-5 text-center">R$ 35,00</td> <!-- Adicione text-center aqui -->
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5 text-dark">
                                                <p class="mb-0 py-4">Frete</p>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-center"> <!-- Centraliza os checkboxes -->
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-1" name="Shipping-1" value="Shipping">
                                                    <label class="form-check-label" for="Shipping-1">Frete Express: R$ 20,00</label>
                                                </div>
                                                <div class="form-check text-center"> <!-- Centraliza os checkboxes -->
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping">
                                                    <label class="form-check-label" for="Shipping-3">Retirada Local: R$ 0</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5 text-dark text-uppercase">
                                                <p class="mb-0 py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5 text-center"> <!-- Centraliza o total -->
                                                <div class="py-3 border-top border-bottom">
                                                    <p class="mb-0 text-dark">R$ 35,00</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Pix</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Cartão de Crédito</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Boleto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="button" class="btn azulescuroinicio py-3 px-4 text-uppercase w-100 text-white">Finalizar compra</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <script>
        document.getElementById('cep').addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('rua').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            // Preencha outros campos se necessário
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            } else {
                alert('CEP inválido.');
            }
        });
        </script>





@endsection