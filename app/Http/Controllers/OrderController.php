<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('delete', '=', false)->get();
        return view('admin.orders.AdminOrdersView', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::get();
        return view('admin.orders.EditOrders', ['order' => $order, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            //'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'address' => 'required',
            'description' => 'required',
            'amount' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $order->update([
            // 'name' => $request->input('name'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'price' => $request->input('price')
        ]);

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function setStateDelete($id)
    {
        //dd($id);
        $order = Order::find($id);
        $order->update(
            [
                // 'delete' => !$order->delete
                'delete' => true
            ]
        );
        return redirect()->route('order.index');
    }
}
