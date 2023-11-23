<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

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



    // ...

    public function viwDashboard()
    {
        $products = Product::get();
        //dd($products);

        // $json = [];
        // foreach ($products as $obj) {
        //     $json[] = [
        //         'name' => $obj->name,
        //         'y' => $obj->price,
        //     ];
        // }
        //dd($products);

        $json = "[";
        foreach ($products as $obj) {
            $json = $json . "{";
            $json = $json . '"name":"' . $obj->name . '",';
            $json = $json . '"y":' . $obj->price;
            $json = $json . "},";
        }
        $json = $json . "]";
        $json = str_replace(",]", "]", $json);
        //dd($json);


        return view('admin.product.dashboard', ['datas' => $json]);
    }
}
