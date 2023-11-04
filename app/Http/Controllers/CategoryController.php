<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('delete', '=', false)->get();
        return view('admin.category.AdminCategoryView', ['categories' => $categories]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.CreateCategory', ['category' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            //'image' => 'required|integer|',
        ]);

        Category::create(
            [
                'name' => $request->name,
                'image' => '',
                'state' => 'activo'
            ]
        );
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.ModifyCategory', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            //'image' => 'required|integer|',
        ]);

        Category::create(
            [
                'name' => $request->name,
                'image' => '',
                'state' => 'activo'
            ]
        );
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
    public function setStateDeleteCategory($id)
    {
        //dd($id);
        $category = Category::find($id);
        $category->update(
            [
                'delete' => true
            ]
        );
        return redirect()->route('category.index');
    }
}
