@extends('Menu')

@section('start')


<section class="products">
    <h2>Productos</h2>
<!-- Botón de desplegable -->
<div class="col-12 d-flex justify-content-center">
    <div class="mb-3">
        <label for="category_id" class="form-label">Seleciona una categoria</label>
        <select class="form-select form-select-lg" name="category_id" id="category_id">
            <option value="0" selected>Todas</option>
            @foreach ($categories as $category )
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>
    </div>
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

                    @if(auth()->check()) <!-- Verificar si el usuario está autenticado -->
                        <a class="product-btn" href="#" data-product="{{ $producto->id }}">Comprar</a>
                    @else
                        <a class="product-btn" href="{{ route('Section') }}"> comprar</a>
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
                <form id="pedidoForm">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class "form-group">
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
                <button type="button" class="btn btn-primary" id="confirmarPedido">Confirmar Pedido</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var select = document.getElementById('category_id');//optener el objeto del formulario
    select.addEventListener('change', function(){
        var selectOption = this.options[select.selectedIndex];
        //alert(selectOption.value + " - " + selectOption.text);
        window.location.href = "/category/"+ selectOption.value;
    })
</script>

@endsection
