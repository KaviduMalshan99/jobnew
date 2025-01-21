<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerPackage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = Banner::with(['category', 'package'])->get();
        return view('banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'nullable|exists:categories,id',
                'package_id' => 'required|exists:banner_packages,id',
                'payment_method' => 'required|in:contact_admin,online',
                'placement' => 'required|in:banner,category_page',
            ]);

            // Start transaction
            DB::beginTransaction();

            // Handle image upload
            $imagePath = $request->file('image')->store('banner_images', 'public');

            // Create banner
            $banner = Banner::create([
                'title' => $validated['title'],
                'image' => $imagePath,
                'category_id' => $validated['category_id'],
                'package_id' => $validated['package_id'],
                'payment_method' => $validated['payment_method'],
                'placement' => $validated['placement'],
                'status' => 'pending', // Default status
                'user_id' => auth()->id(), // Assuming you have authentication
            ]);

            DB::commit();

            // Handle different payment methods
            if ($validated['payment_method'] === 'online') {
                // Store banner ID in session for payment processing
                session(['pending_banner_id' => $banner->id]);
                return redirect()->route('payment.checkout');
            }

            return redirect()->route('banners.index')
                ->with('success', 'Banner created successfully! Our admin will contact you soon.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded image if exists
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while creating the banner. Please try again.'])
                ->withInput();
        }
    }

    public function storeBannerData(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'nullable|exists:categories,id',
                'package_id' => 'required|exists:banner_packages,id',
                'placement' => 'required|in:banner,category_page',
            ]);

            // Store form data in session for payment processing
            session(['banner_form_data' => $validated]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
        $categories = Category::all();
        $packages = BannerPackage::all();
        return view('Admin.banner.create', compact('categories', 'packages'));
    }

    /**
     * Store a newly created banner in storage.
     */

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Banner $banner)
    {
        $categories = Category::all();
        $packages = BannerPackage::all();
        return view('banners.edit', compact('banner', 'categories', 'packages'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'package_id' => 'required|exists:banner_packages,id',
            'payment_method' => 'nullable|string',
            'placement' => 'required|in:banner,category_page',
        ]);

        $banner->update($request->all());
        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }
    public function updateStatus(Request $request, Banner $banner)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'status' => 'required|in:pending,approved,rejected',
                'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500',
            ]);

            // Start transaction
            DB::beginTransaction();

            // Update banner status
            $banner->status = $validated['status'];

            // Handle rejection reason
            if ($validated['status'] === 'rejected') {
                $banner->rejection_reason = $validated['rejection_reason'];
            } else {
                $banner->rejection_reason = null; // Clear rejection reason if status is not rejected
            }

            // If banner is being approved, set the published date
            if ($validated['status'] === 'approved') {
                $banner->published_at = now();
            }

            $banner->save();

            // If status is approved, you might want to notify the user
            if ($validated['status'] === 'approved') {
                // You can implement notification logic here
                // Notification::send($banner->user, new BannerApprovedNotification($banner));
            }

            // If status is rejected, you might want to notify the user with rejection reason
            if ($validated['status'] === 'rejected') {
                // You can implement notification logic here
                // Notification::send($banner->user, new BannerRejectedNotification($banner));
            }

            DB::commit();

            return redirect()->back()->with('success', 'Banner status updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while updating the banner status.'])
                ->withInput();
        }
    }
    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}