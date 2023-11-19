<?php

namespace App\Http\Controllers;

use App\Models\Order;


class PredictController extends Controller
{
    public function index()
    {
        $orders = Order::where('delete', '=', false)->get();
        return view('user.UserPedido', ['orders' => $orders]);
    }
    public function setStateDeletes($id)
    {
        //dd($id);
        $order = Order::find($id);
        $order->update(
            [
                // 'delete' => !$order->delete
                'delete' => true
            ]
        );
        return redirect()->route('predict.index');
    }
}
