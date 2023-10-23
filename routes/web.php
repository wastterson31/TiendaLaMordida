<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, 'ShowHome'])->name('Home');

Route::get('/Products', [IndexController::class, 'ShowProducts'])->name('Products');


Route::get('/Register', [IndexController::class, 'ShowRegister'])->name('Register');

Route::get('/StartSection', [IndexController::class, 'ShowSection'])->name('Section');

Route::get('/Nosotros', [IndexController::class, 'ShowNosotros'])->name('Nosotros');

Route::get('/category/{id}', [IndexController::class, 'ShowProductsByCategory'])->name('category');

Route::get('/UserPedido', [IndexController::class, 'ShowUserPedido'])->name('UserPedido');



//rutas admin

Route::get('/welcome', [AdminController::class, 'ShowAdmin'])->name('Admin');

Route::get('/filtrar/{id}', [AdminController::class, 'ShowAdminFilter'])->name('filtrar');

Route::resource('Product', ProductController::class);

Route::resource('Category', CategoryController::class);

Route::resource('Orders', OrdersController::class);

// insertar un producto
//Route::post('/create', [ProductController::class, 'store'])->name('products.store');

//Route::post('/edit', [ProductController::class, 'edit'])->name('products.edit');

//Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Actualizar un producto

//Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');



Route::post('Login', function () {
    $validar = request()->only('username', 'password');
    $offers = Product::where('discount', '>', 0)->get();
    $categories = Category::all();
    if (Auth::attempt($validar)) {
        return view('Index', ['offers' => $offers, 'categories' => $categories]);
    }
    return view('UserLoginView');
    return view('Index');
})->name('Login');


Route::get('/Logout', function () {
    Auth::logout(); // Cierra la sesión del usuario
    return redirect('/'); // Redirige al usuario a la página de inicio o a donde desees
})->name('Logout');
