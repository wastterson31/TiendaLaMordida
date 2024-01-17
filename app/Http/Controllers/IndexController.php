<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function ShowHome()
    {
        //dd($offers);
        // $offers = Product::where('discount', '>', 0)->get();
        // $categories = Category::all();
        //$products = Product::all(); // Obtén los productos que deseas mostrar en la vista.
        $offers = Product::where('discount', '>', 0)->get();
        $categories = Category::all();
        $products = Product::all(); // Obtén los productos que deseas mostrar en la vista.
        return view('Index', ['offers' => $offers, 'categories' => $categories, 'products' => $products]);
    }

    public function ShowProductsByCategory($id)
    {
        $categories = Category::all();
        if ($id != '0') {
            $products = Category::find($id)->products;
            dd($products);
            // $products = Category::find($id);
            // $products = Product::where('category_id', '=', $category->id);
            // dd($category, $products);
            return view('ProductsView', ['products' => $products, 'categories' => $categories, 'category_id' => $id]);
        } else {
            $products = Product::get();
            return view('ProductsView', ['products' => $products, 'categories' => $categories, 'category_id' => $id]);
        }
    }

    public function ShowProducts()
    {
        $offers = Product::where('discount', '>', 0)->get();
        $categories = Category::all();
        $products = Product::all();

        return view('ProductsView', ['products' => $products, 'offers' => $offers, 'categories' => $categories]);
    }

    public function ShowPredict()
    {
        return view('user.UserPedido');
    }





    public function ShowRegister()
    {
        return view('UserRegisterView');
    }

    public function ShowSession()
    {
        return view('UserLoginView');
    }
    public function ShowSessionAdmin()
    {
        return view('admin.auth.Login');
    }
    public function ShowNOSOTROS()
    {
        return view('Nosotros');
    }

    public function  ShowUserPedido()
    {
        //dd(auth()->user()->username);
        //where('state', true)->where('category_id', $category->id)->get();
        //$orders = Order::where('delete', '=', false, 'and', 'user_id', '=', auth()->user()->id)->get();
        $orders = Order::where('delete', false)->where('user_id', auth()->user()->id)->get();
        return view('user.UserPedido', ['orders' => $orders]);
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
