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
        $pendingBanners = Banner::with(['category', 'package'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10, ['*'], 'pending_page');

        $publishedBanners = Banner::with(['category', 'package'])
            ->where('status', 'published') // Changed from 'approved'
            ->latest()
            ->paginate(10, ['*'], 'published_page');

        $rejectedBanners = Banner::with(['category', 'package'])
            ->where('status', 'rejected')
            ->latest()
            ->paginate(10, ['*'], 'rejected_page');

        return view('Admin.banner.index', compact('pendingBanners', 'publishedBanners', 'rejectedBanners'));
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
                'status' => 'pending',
                'user_id' => auth()->id(),
            ]);

            DB::commit();

            // Handle different payment methods
            if ($validated['payment_method'] === 'online') {
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
    // Controller function
    public function updateStatus(Request $request, Banner $banner)
    {
        try {
            // Log incoming request data
            \Log::info('Update Status Request:', [
                'banner_id' => $banner->id,
                'current_status' => $banner->status,
                'request_data' => $request->all(),
            ]);

            $validated = $request->validate([
                'status' => 'required|in:pending,published,rejected',
                'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500',
            ]);

            DB::beginTransaction();

            // Log before update
            \Log::info('Before Update:', [
                'banner_status' => $banner->status,
                'validated_data' => $validated,
            ]);

            $banner->status = $validated['status'];
            $banner->rejection_reason = $validated['status'] === 'rejected' ? $validated['rejection_reason'] : null;

            if ($validated['status'] === 'published') {
                $banner->published_at = now();
            }

            $banner->save();

            // Log after update
            \Log::info('After Update:', [
                'banner_status' => $banner->status,
                'save_result' => $banner->wasChanged(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Banner status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            \Log::error('Banner Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

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