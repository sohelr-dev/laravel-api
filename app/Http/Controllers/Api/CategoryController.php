<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Create a new category
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'is_inactive' => 'nullable',
        ]);

      
        $category = Category::create([
            'name' => $request->name,
            'is_inactive' => $request->is_inactive ?? 0,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

 
    public function update(Request $request, $id)
    {
        // $category = Category::find($id)->update($request->all());   //update only true but data update 
        // $category->update($request->all());

       $category = Category::find($id);
        $request->validate([
            'name' => 'string|max:255',
            
        ]);

        // Update the specific category instance
        $category->update([
            'name' => $request->name,
            'is_inactive' => $request->is_inactive ?? 0,
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }



    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
