<?php

namespace App\Http\Controllers;

use App\Models\BannerPackage;
use Illuminate\Http\Request;

class BannerPackageController extends Controller
{
    // Display a listing of banner packages
    public function index()
    {
        $packages = BannerPackage::all();
        return view('Admin.banner.package.index', compact('packages'));
    }

    // Show the form for creating a new banner package
    public function create()
    {
        return view('Admin.banner.package.create');
    }

    // Store a newly created banner package in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'duration' => 'required|in:7days,21days',
            'price_lkr' => 'required|numeric|min:0',
            'price_usd' => 'required|numeric|min:0',
        ]);

        BannerPackage::create($validated);

        return redirect()->route('banner_packages.index')->with('success', 'Banner Package created successfully.');
    }
    // Display the specified banner package
    public function show(BannerPackage $bannerPackage)
    {
        return view('Admin.banner.package.show', compact('bannerPackage'));
    }

    // Show the form for editing a banner package
    public function edit(BannerPackage $bannerPackage)
    {
        return view('Admin.banner.package.edit', compact('bannerPackage'));
    }

    // Update the specified banner package in the database
    public function update(Request $request, BannerPackage $bannerPackage)
    {
        $validated = $request->validate([
            'duration' => 'required|in:7days,21days',
            'price_lkr' => 'required|numeric|min:0',
            'price_usd' => 'required|numeric|min:0',
        ]);

        $bannerPackage->update($validated);

        return redirect()->route('banner_packages.index')->with('success', 'Banner Package updated successfully.');
    }

    // Remove the specified banner package from the database
    public function destroy(BannerPackage $bannerPackage)
    {
        $bannerPackage->delete();

        return redirect()->route('banner_packages.index')->with('success', 'Banner Package deleted successfully.');
    }
}