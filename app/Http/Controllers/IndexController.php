<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function ShowHome()
    {
        $offers = Product::where('discount', '>', 0)->get();
        $categories = Category::all();
        //$products = Product::all(); // Obtén los productos que deseas mostrar en la vista.
        return view('Index', ['offers' => $offers, 'categories' => $categories]);
    }

    public function ShowProductsByCategory($id)
    {
        $products = Category::find($id)->products;
        $categories = Category::all();
        return view('ProductsView', ['products' => $products, 'categories' => $categories]);
    }

    public function ShowProducts()
    {
        $offers = Product::where('discount', '>', 0)->get();
        $categories = Category::all();
        $products = Product::all();

        return view('ProductsView', ['products' => $products, 'offers' => $offers, 'categories' => $categories]);
    }



    public function ShowRegister()
    {
        return view('UserRegisterView');
    }

    public function ShowSection()
    {
        return view('UserLoginView');
    }

    public function ShowNOSOTROS()
    {
        return view('Nosotros');
    }

    public function  ShowUserPedido()
    {
        return view('user/UserPedido');
    }

    public function ShowAdmin()
    {
        return view('admin/AdminWelcomeView');
    }

    public function ShowAdminProduct()
    {
        return view('admin/AdminProductsView');
    }

    public function ShowAdminCategory()
    {
        return view('admin/AdminCategory');
    }

    public function ShowAdminOrders()
    {
        return view('admin/AdminOrders');
    }
}
