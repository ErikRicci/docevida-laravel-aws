@extends('includes.app')

@section('title', 'Lojinha')

@section('content')
<style>
    #hover-image:hover {
        animation: mymove 0.5s;
        animation-fill-mode: forwards;
    }
    @keyframes mymove {
        from {opacity: 100%;}
        to {opacity: 50%;}
    }
</style>

    <nav class="navbar fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">PRODUTOS</a>
        <h4 id="carrinhoTotal" style="color: white">TOTAL: R$ 0.00</h4>
    </nav>
    <br><br><br>

    <script>

        var carrinho = {};
        var carrinhoTotal = 0;
        var pedido = "";

        var addQty = (id, product, price) => {

            if (!carrinho[product]) {
                carrinho[product] = {
                    'self': product,
                    'qty': 0,
                    'price': price,
                    'total': 0.00
                };
            }

            if (document.getElementById('qtd' + id).value < 99) {
                document.getElementById('qtd' + id).value = parseInt(document.getElementById('qtd' + id).value) + 1;
                carrinho[product]['qty']++;
                carrinho[product]['total'] = carrinho[product]['qty'] * carrinho[product]['price'];
            }
            setTotal();
        }

        var rmvQty = (id, product) => {
            if (document.getElementById('qtd' + id).value && document.getElementById('qtd' + id).value > 0) {
                document.getElementById('qtd' + id).value = parseInt(document.getElementById('qtd' + id).value) - 1;
                carrinho[product]['qty']--;
                carrinho[product]['total'] = carrinho[product]['qty'] * carrinho[product]['price'];
            }
            setTotal();
        }

        var setTotal = () => {

            carrinhoTotal = 0;
            pedido = "";

            for (var i = 0; i < Object.keys(carrinho).length; i++) {
                carrinhoTotal += carrinho[Object.keys(carrinho)[i]]['total'];
                if(carrinho[Object.keys(carrinho)[i]]['qty'] > 0)
                    pedido += carrinho[Object.keys(carrinho)[i]]['qty'] + ' ' + carrinho[Object.keys(carrinho)[i]]['self'] + ';';
            }
            document.getElementById('pedido_cliente').value = pedido;
            document.getElementById('carrinhoTotal').innerText = 'TOTAL: R$' + carrinhoTotal.toFixed(2);
        }

    </script>

    @isset($products)
        <div class="card-deck" style="margin-left: 2vh; margin-right: 2vh">
            @foreach ($products as $index => $product)
                <div class="card" style="width: 40vh; border-top-left-radius: 12px; border-top-right-radius: 12px">
                    <button data-toggle="modal" data-target="#exampleModal{{ $product->nome_produto }}"
                        class="card-link btn" id="hover-image"><img style="margin:auto; width: 100%; max-height: 500px; border-top-left-radius: 12px; border-top-right-radius: 12px" class="card-img-top" src="{{ Storage::disk('s3')->url($product->thumbnail_produto) }}" alt="">
                    </button>
                    <div class="card-body">
                        <h5 class="card-title">{{ strtoupper($product->nome_produto) }}</h5>
                        <p class="card-text">{{ strtoupper($product->desc_produto) }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">A partir de R$ {{ $product->preco_produto }}</li>
                    </ul>
                    <div class="card-body">
                        <div style="width: 60%" class="input-group">
                            <input type="number" class="form-control" value="0" id="qtd{{ $index }}" placeholder="QTD."
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button id="{{ $index }}" onclick="rmvQty(this.id, '{{ $product->nome_produto }}')"
                                    class="btn btn-danger" type="button">-</button>
                                <button id="{{ $index }}"
                                    onclick="addQty(this.id, '{{ $product->nome_produto }}', '{{ $product->preco_produto }}')"
                                    class="btn btn-primary" type="button">+</button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                @if (($index + 1) % 3 == 0)
        </div>
        <br>
        <div class="card-deck" style="margin-left: 5px; margin-right: 5px">
            @endif


            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $product->nome_produto }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ strtoupper($product->nome_produto) }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExampleControls{{ $product->nome_produto }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div style="background-color: rgb(180, 83, 66); height: 100px; text-align: center" class="carousel-item active">
                                        SABOR 1
                                    </div>
                                    <div style="background-color: rgb(247, 181, 105); height: 100px; text-align: center" class="carousel-item">
                                        SABOR 2
                                    </div>
                                    <div style="background-color: rgb(184, 126, 223); height: 100px; text-align: center" class="carousel-item">
                                        SABOR 3
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls{{ $product->nome_produto }}" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls{{ $product->nome_produto }}" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Escolher Sabor</button>
                        </div>
                    </div>
                </div>
            </div>


            @endforeach
        </div>
    @endisset
    <br>
    <img src="{{asset('whatsapp.png')}}">
    <nav style="background-color: rgb(177, 100, 113); border-top-left-radius: 12px; border-top-right-radius: 12px"
        class="navbar fixed-bottom navbar-light">
        <form action="{{ route('whatsapp') }}" method="POST">
        @csrf
            <input class="form-input" type="text" name="nome_cliente" id="nome_cliente">
            <input type="text" name="pedido_cliente" id="pedido_cliente" hidden value="">
            <input type="datetime" name="datapedido_cliente" id="datapedido_cliente" hidden value="123">
            <button type="submit">Wpp</button>
        </form>
    </nav>
@endsection
</html>
