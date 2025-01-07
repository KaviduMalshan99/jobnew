<?php

namespace App\Http\Controllers;

use App\Models\PackageContact;
use Illuminate\Http\Request;

class PackageContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:posts,email',
            'contact' => 'required',
            'description_one' => 'required',
            'description_two' => 'required',
        ]);

        $post = PackageContact::create($request->all());

        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }

    // Fetch all posts
    public function index()
    {
        $posts = PackageContact::all();
        return view('Admin', compact('posts'));
    }
    public function create()
    {

        return view('Admin.packages.create');
    }
    // Update a specific post
    public function update(Request $request, $id)
    {
        $post = PackageContact::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:posts,email,' . $post->id,
            'contact' => 'required',
            'description_one' => 'required',
            'description_two' => 'required',
        ]);

        $post->update($request->all());

        return response()->json(['message' => 'Post updated successfully!', 'post' => $post]);
    }

    // Delete a specific post
    public function destroy($id)
    {
        $post = PackageContact::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!']);
    }
}