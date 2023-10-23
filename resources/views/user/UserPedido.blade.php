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
                            <th scope="col">Descripción</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <!-- Botón de Cancelar Pedido con confirmación -->
                                <button class="btn btn-danger" style="padding: 6px 3px;">Cancelar</button>
                            </td>

                        </tr>

                    </tbody>
                </table>

                <p class="text-center">No has realizado pedidos aún.</p>;


            </div>
        </div>
    </section>




    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <!-- SweetAlert CDN script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    </body>
@endsection
