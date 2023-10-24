@extends('Menu')

@section('start')
    <div class="home-bg">
        <section class="home">
            <div class="swiper home-slider">
                <div class="swiper-wrapper">

                    @foreach ($offers as $offer)
                        <div class="swiper-slide slide">
                            <div class="image">
                                <img src="{{ $offer->image }}" alt="Nombre de la imagen">
                            </div>
                            <div class="content">
                                <span>{{ $offer->description }}</span>
                                <h3>{{ $offer->name }}</h3>
                                <h3>Precio: {{ $offer->price }}</h3>
                                <input type="hidden" name="offer" id="offer" value="{{ $offer->id }}">
                                <a class="btn comprar-btn" href="#" data-offers="{{ $offer->id }}"
                                    data-precio-offer="{{ $offer->price }}">Comprar</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </div>


    <section class="category">
        <h1 class="heading">Categorías de productos</h1>

        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                @foreach ($categories as $category)
                    <a href="{{ route('categories', ['id' => $category->id]) }}" class="swiper-slide slide">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                        <h3>{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>


    <!-- Modal para ingresar información del pedido -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="pedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pedidoModalLabel">Información del Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pedidoForm">
                        <div class="form-group">
                            <input type="hidden" name="numero_telefonico" id="numero_telefonico">
                            <input type="hidden" name="precio" id="precio">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección de Entrega:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="#">Confirmar Pedido</button>
                </div>
            </div>
        </div>
    </div>
@endsection
