<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderResource;
use App\Http\Resources\V1\UserResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::where('delete', '=', false)->get();
        return OrderResource::collection($order);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->amount = $request->input('amount');
        $order->description = $request->input('description');
        $order->address = $request->input('address');
        $order->price = $request->input('price');
        $order->user_id = $request->input('user_id');
        $order->delete = false;
        $order->product_id = $request->input('product_id');

        $order->save();

        return response()->json([
            'message' => 'Datos de ordenes registrados',
            'data' => $order
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return response()->json([
            'message' => 'Los datos de la ordenes han sido actualizados',
            'data' => $order
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->update(
            [
                'delete' => true
            ]
        );
        return response()->json([
            'message' => 'Datos de la orden eliminados'
        ], Response::HTTP_ACCEPTED);
    }

    public function getOrdersByUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        // return new UserResource($user);
        // $order = Order::where('delete', '=', false)->get();
        $order = Order::where('user_id', $user->id)->where('delete', '=', false)->get();
        // $order = Order::where('user_id', $user->id)->get();

        // Verifica si se encontró alguna orden
        if ($order->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron pedidos para este usuario.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Si se encontró una orden, devuelve el recurso
        // return new OrderResource($order->first());
        return OrderResource::collection($order);
    }
}
