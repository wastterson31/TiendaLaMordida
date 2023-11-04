<?php

namespace App\Http\Controllers;

use App\Models\Pedict;
use Illuminate\Http\Request;

class PredictController extends Controller
{
    public function index()
    {
        //$categories = Category::all();
        //$products = Pedict::get();
        return view('admin.product.AdminProductView');
    }
}
