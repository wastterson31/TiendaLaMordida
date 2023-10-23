@extends('admin.BaseAdmin')

@section('title')
    <div style="

    position: relative;
    left: 360px;">
        Modificar una orden</div>
@endsection

@section('content')
    <div class="row">
        <div class="offset-3 col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Orders.update', $order) }}" method="POST">
                        @method('put')
                        @include('admin.orders.FormCategory')

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit"> Registrar </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection