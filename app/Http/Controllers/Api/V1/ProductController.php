<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verifica si el parámetro discount está presente en la solicitud
        $discountFilter = $request->has('discount') ? true : false;

        // Aplica el filtro solo si hay descuento está presente
        $products = $discountFilter
            ? Product::where('delete', false)->where('discount', '>', 0)->get()
            : Product::where('delete', false)->get();

        return ProductResource::collection($products);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());

        $product->save();

        return response()->json([
            'message' => 'Datos del producto registrados',
            'data' => $product
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'message' => 'Los datos de la mascota han sido actualizados',
            'data' => $product
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->update(
            [
                'delete' => true
            ]
        );
        return response()->json([
            'message' => 'Datos del producto eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
