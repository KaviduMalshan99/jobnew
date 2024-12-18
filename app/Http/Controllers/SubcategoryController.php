<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Display a listing of subcategories
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('subcategories.index', compact('subcategories'));
    }

    // Show the form for creating a new subcategory
    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    // Store a newly created subcategory
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        Subcategory::create($request->all());
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    // Show the form for editing the specified subcategory
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    // Update the specified subcategory
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        $subcategory->update($request->all());
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    // Remove the specified subcategory
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}