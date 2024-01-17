<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::where('delete', '=', false)->get();
        return CategoryResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->image = $request->input('image');
        // $category->state = 'activo';
        // $category->delete = false;

        // $category->save();

        // return response()->json([
        //     'message' => 'Datos de ordenes registrados',
        //     'data' => $category
        // ], Response::HTTP_ACCEPTED);


        $category = new Category($request->all());

        $category->save();

        return response()->json([
            'message' => 'Datos de la categoría registrados',
            'data' => $category
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return response()->json([
            'message' => 'Los datos de la Categorias han sido actualizados',
            'data' => $category
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->update(
            [
                'delete' => true
            ]
        );
        return response()->json([
            'message' => 'Datos de la categoría eliminados'
        ], Response::HTTP_ACCEPTED);
    }

    public function getProductsByCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoría no encontrada',
            ], Response::HTTP_NOT_FOUND);
        }

        $products = $category->products()->where('delete', false)->get();

        // return response()->json([
        //     'category' => new CategoryResource($category),
        //     'products' => ProductResource::collection($products),
        // ]);

        return ProductResource::collection($products);
    }
}
