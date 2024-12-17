<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        return view('Admin.categoryview', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('Admin.categoryform');
    }

    // Store a newly created category
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:active,inactive',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'string|max:255',
        ]);

        // Create the main category
        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        // Add subcategories to the 'subcategories' table
        if ($request->has('subcategories')) {
            foreach ($request->subcategories as $subcategoryName) {
                if (!empty($subcategoryName)) {
                    Subcategory::create([
                        'name' => $subcategoryName,
                        'category_id' => $category->id,
                        'status' => 'active', // Default status
                    ]);
                }
            }
        }

        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category and subcategories created successfully!');
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        $category = Category::with('subcategories')->findOrFail($id);
        return view('Admin.editcategory', compact('category'));
    }

    // Update the specified category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'status' => 'required|in:active,inactive',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'string|max:255',
        ]);

        // Update main category
        $category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        // Handle subcategories
        // First, remove existing subcategories
        $category->subcategories()->delete();

        // Then add new subcategories
        if ($request->has('subcategories')) {
            foreach ($request->subcategories as $subcategoryName) {
                if (!empty($subcategoryName)) {
                    Subcategory::create([
                        'name' => $subcategoryName,
                        'category_id' => $category->id,
                        'status' => 'active',
                    ]);
                }
            }
        }

        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete associated subcategories first
        $category->subcategories()->delete();

        // Then delete the category
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}