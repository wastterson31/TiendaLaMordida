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
        $products = Product::get();
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
        // Agrega registros de depuración para verificar los datos del formulario
        //dd($request->all()); // Verifica si los datos del formulario se están pasando correctamente


        // Crea un nuevo objeto Producto y almacena los datos del formulario
        //$product = new Product();
        // $product->name = $request->input('name');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->image = $request->input('image');
        // $product->discount = $request->input('discount');
        // $product->category_id = $request->input('category_id');

        // // Guarda el producto en la base de datos
        // $product->save();

        // // Redirection a una página de éxito o a donde desees
        // return view('admin.AdminPetView')->with('success', 'Producto creado con éxito');

        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,50',
            'price' => 'required',
            //'image' => 'required|integer|',
            'discount' => 'required|integer|'
        ]);

        Product::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => '',
                'discount' => $request->discount,
                'category_id' => $request->category_id
            ]
        );
        return redirect()->route('Product.index');
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

        // Actualizar los datos del producto con los valores del formulario
        // $product->name = $request->input('name');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->discount = $request->input('discount');
        // $product->category_id = $request->input('category_id');

        // // Guardar los cambios en la base de datos
        // $product->save();

        // // Redirection a la vista de detalles del producto actualizado o a donde desees
        // return redirect()->route('AdminPetView', $product->id)->with('success', 'Producto actualizado con éxito');

        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required',
            'price' => 'required|min:1|max:1000000',
            //'image' => 'required|integer|',
            'discount' => 'required|integer'
        ]);

        $product->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                // 'image' => '',
                'discount' => $request->discount,
                'category_id' => $request->category_id
            ]
        );
        // Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path(), $imageName);
            $product->update(['image' => $imageName]);
        }
        return redirect()->route('product.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
