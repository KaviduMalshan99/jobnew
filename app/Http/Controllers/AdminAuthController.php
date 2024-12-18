<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminAuthController extends Controller
{

    public function adminList()
    {
        $admins = Admin::all(); // Fetch all admins
        return view('Admin.adminlist', compact('admins')); // Pass admins to the view
    }

// Method to toggle active/inactive status
    public function toggleStatus($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->is_active = !$admin->is_active; // Toggle status
        $admin->save();

        return redirect()->back()->with('success', 'Admin status updated successfully');
    }
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.login'); // Ensure you have a view at resources/views/admin/login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('admin.register'); // Ensure you have a view at resources/views/admin/register.blade.php
    }

    // Handle admin registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'nullable|string|max:20',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully. You can now log in.');
    }

    // Dashboard (example)
    public function dashboard()
    {
        return view('Admin.dashboard'); // Ensure you have a view at resources/views/admin/dashboard.blade.php
    }

    public function showProfileForm()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    // Handle profile update
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($admin->id),
            ],
            'contact' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update name and contact
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->contact = $request->contact;

        // Handle password change if new password is provided
        if ($request->filled('new_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update to new password
            $admin->password = Hash::make($request->new_password);
        }

        // Save the updates
        $admin->save();

        // Redirect back with success message
        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully');
    }

}