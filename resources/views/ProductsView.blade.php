@extends('Menu')

@section('start')
    <section class="products">
        <h2>Productos</h2>
        <!-- Botón de desplegable -->
        <div class="col-12 d-flex justify-content-center">
            <div class="mb-3">
                <label for="category_id" class="form-label">Selecciona una categoría</label>
                <select class="form-select form-select-lg" name="category_id" id="category_id">
                    <option value="0" selected>Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="all-products">
            @foreach ($products as $producto)
                <div class="product">
                    <img src="{{ $producto->image }}" alt="{{ $producto->name }}">
                    <div class="product-info">
                        <h4 class="product-title">{{ $producto->name }}</h4>
                        <p class="product-price">Precio: {{ $producto->price }}</p>
                        <input type="hidden" name="producto" id="producto" value="{{ $producto->id }}">
                        @if (auth()->check())
                            <a class="product-btn" href="#" data-product="{{ $producto->id }}">Comprar</a>
                        @else
                            @guest
                                <a class="btn" href="{{ route('Session') }}">Comprara</a>
                            @endguest
                            @auth
                                <a class="btn btn-secondary" href="{{ route('Session') }}">Comprar</a>
                            @endauth
                        @endif
                    </div>
                </div>
            @endforeach
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

                    <form id="pedidoForm" method="POST" action="{{ route('buy') }}">
                        @csrf
                        {{-- Optinen los datos de manera oculta --}}
                        <input type="hidden" name="product_id" id="product_id" value="{{ $producto->id }}">
                        <input type="hidden" name="price" id="price" value="{{ $producto->price }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">

                        <div class="form-group">
                            <label for="amount">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección de Entrega:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>

                        </div>
                        {{-- <input type="hidden" disabled readonly name="hidden" value=""> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="confirmarPedido">Confirmar Pedido</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var comprarButtons = document.querySelectorAll('.product-btn');

            comprarButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita la redirección del enlace

                    var productId = this.getAttribute('data-product');
                    updateProductInForm(productId);
                    openPedidoModal();
                });
            });

            function updateProductInForm(productId) {
                // Actualiza el valor del campo product_id en el formulario
                document.getElementById('product_id').value = productId;
            }

            function openPedidoModal() {
                var modal = new bootstrap.Modal(document.getElementById('pedidoModal'));
                modal.show();
                // Aquí puedes realizar cualquier otra acción que necesites al abrir el modal.
            }
        });
    </script>
@endsection
