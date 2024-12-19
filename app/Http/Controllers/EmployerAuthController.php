<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployerAuthController extends Controller
{
    public function list()
    {
        $employers = Employer::all(); // Fetch all employers
        return view('admin.employerlist', compact('employers')); // Pass to view
    }
    // Show the login form
    public function showLoginForm()
    {
        return view('employer.login'); // Ensure you have a view at resources/views/employer/login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('employer')->attempt($credentials)) {
            return redirect()->route('employer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('employer')->logout();
        return redirect()->route('employer.login');
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('employer.register'); // Ensure you have a view at resources/views/employer/register.blade.php
    }

    // Handle employer registration
    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|string|min:8|confirmed',
            'contact_details' => 'nullable|string|max:255',
            'business_info' => 'nullable|string',
        ]);

        Employer::create([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_details' => $request->contact_details,
            'business_info' => $request->business_info,
        ]);

        return redirect()->route('employer.login')->with('success', 'Employer registered successfully. You can now log in.');
    }

    // Dashboard
    public function dashboard()
    {
        return view('employer.dashboard'); // Ensure you have a view at resources/views/employer/dashboard.blade.php
    }
    // Show Employer Profile Form
    public function showProfileForm()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile', compact('employer')); // Ensure you have a view at resources/views/employer/profile.blade.php
    }

// Handle Employer Profile Update
    public function updateProfile(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        // Validate the incoming request
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employers', 'email')->ignore($employer->id),
            ],
            'contact_details' => 'nullable|string|max:255',
            'business_info' => 'nullable|string|max:1000',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update company name, email, contact details, and business info
        $employer->company_name = $request->company_name;
        $employer->email = $request->email;
        $employer->contact_details = $request->contact_details;
        $employer->business_info = $request->business_info;

        // Handle password change if new password is provided
        if ($request->filled('new_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $employer->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update to new password
            $employer->password = Hash::make($request->new_password);
        }

        // Save the updates
        $employer->save();

        // Redirect back with a success message
        return redirect()->route('employer.profile')
            ->with('success', 'Profile updated successfully.');
    }
    public function toggleStatus($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->is_active = !$employer->is_active; // Toggle status
        $employer->save();

        return redirect()->route('employer.list')->with('success', 'Employer status updated successfully!');
    }

}