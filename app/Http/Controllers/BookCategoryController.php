<?php

namespace App\Http\Controllers;

use App\Models\bookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index () 
    {
        $categories = bookCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        bookCategory::create($request->all());
        return redirect()->route('categories.index');
    }

    public function show(bookCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(bookCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, bookCategory $category)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $category->update($request->all());
        return response()->json([
            'message' => 'Category updated successfully'
        ]);

    }

    public function destroy(bookCategory $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }

}
