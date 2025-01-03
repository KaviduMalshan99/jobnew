<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first(); // Only one entry for About Us, so we get the first record
        return view('Admin.about.index', compact('aboutUs'));
    }
    public function indexhome()
    {
        $aboutUs = AboutUs::first(); // Only one entry for About Us, so we get the first record
        $contacts = ContactUs::all();
        return view('User/SideComponent/aboutus', compact('aboutUs', 'contacts'));
    }

    public function create()
    {
        return view('Admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        AboutUs::create($request->all());

        return redirect()->route('admin.about-us.index')->with('success', 'About Us created successfully.');
    }

    public function edit(AboutUs $aboutUs)
    {
        return view('Admin.about.edit', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $aboutUs->update($request->all());

        return redirect()->route('admin.about-us.index')->with('success', 'About Us updated successfully!');
    }

    public function destroy(AboutUs $aboutUs)
    {
        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us deleted successfully.');
    }
}
