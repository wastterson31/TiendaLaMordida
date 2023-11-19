<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories = Category::all();
        $products = Product::where('delete', '=', false)->get();
        return view('admin.product.AdminProductView', ['products' => $products]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.product.CreateProduct', ['categories' => $categories, 'product' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Almacena un nuevo producto en el almacenamiento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,50',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Validación de imagen
            'discount' => 'required|integer',
            'category_id' => 'required'
        ]);

        // Obtener la extensión del archivo de imagen
        $extension = $request->image->extension();

        // Construir el nombre único para la imagen
        $imageName = time() . '.' . $extension;

        // Mover la imagen al directorio de almacenamiento
        $request->image->move(public_path('public'), $imageName);

        // Crear el producto en la base de datos
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName, // Guardar el nombre de la imagen en la base de datos
            'discount' => $request->discount,
            'category_id' => $request->category_id
        ]);

        // Redireccionar a la ruta de índice de productos
        return redirect()->route('product.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.product.EditProduct', ['categories' => $categories, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required',
            'price' => 'required|min:1|max:1000000',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'discount' => 'required|integer',
            'category_id' => 'required'
        ]);

        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id
        ];

        // Procesar la imagen solo si se proporciona una nueva
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/'), $imageName);
            $productData['image'] = $imageName;
        }

        $product->update($productData);

        return redirect()->route('product.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function setStateDelete($id)
    {
        //dd($id);
        $product = Product::find($id);
        $product->update(
            [
                // 'delete' => !$product->delete
                'delete' => true
            ]
        );
        return redirect()->route('product.index');
    }
}
