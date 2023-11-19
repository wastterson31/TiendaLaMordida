@extends('Menu')

@section('start')
    <section class="pedidos">
        <div class="container">
            <h2 class="text-center">Mis Pedidos</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Dirección de Entrega</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->description }}</td>
                                    <td class="text-center">
                                        {{-- {{- action="">
                                            <a href="" class="btn btn-danger">
                                                <i class="fas fa-minus-circle nav-icon"></i>
                                            </a>
                                    > --}}
                                        <button class="btn btn-danger"
                                            onclick=" window.location.href = '/ordenes/{{ $order->id }}'">
                                            <i class="fas fa-minus-circle nav-icon"></i>
                                        </button>>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No has realizado pedidos aún.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>


@endsection
