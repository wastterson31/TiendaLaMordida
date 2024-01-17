<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function ShowAdmin()
    {
        return view('admin.WilcomeAdminView');
    }

    public function ShowAdminFilter($id)
    {

        $products = Category::find($id)->products;

        $categories = Category::all();
        return view('admin.product.AdminProductView', ['products' => $products, 'categories' => $categories]);
    }
}
