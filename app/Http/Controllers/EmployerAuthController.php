<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employer;
use App\Models\JobPosting;
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
    public function employerStats()
    {
        // Get current date
        $today = now();

        // Daily counts for the last 30 days
        $dailyCount = Employer::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereDate('created_at', '>=', $today->copy()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => $item->count,
                    'employers' => Employer::whereDate('created_at', $item->date)
                        ->select('company_name', 'email')
                        ->get()
                        ->toArray(),
                ];
            });

        // Weekly counts
        $weeklyCount = Employer::selectRaw('
                WEEK(created_at) as week,
                MIN(DATE(created_at)) as week_start,
                MAX(DATE(created_at)) as week_end,
                COUNT(*) as count
            ')
            ->whereDate('created_at', '>=', $today->copy()->startOfYear())
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'week' => $item->week,
                    'week_start' => $item->week_start,
                    'week_end' => $item->week_end,
                    'count' => $item->count,
                    'employers' => Employer::whereBetween('created_at', [$item->week_start, $item->week_end])
                        ->select('company_name', 'email')
                        ->get()
                        ->toArray(),
                ];
            });

        // Monthly counts
        $monthlyCount = Employer::selectRaw('
                DATE_FORMAT(created_at, "%Y-%m") as month,
                COUNT(*) as count
            ')
            ->whereDate('created_at', '>=', $today->copy()->startOfYear())
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {
                $monthStart = \Carbon\Carbon::createFromFormat('Y-m', $item->month)->startOfMonth();
                $monthEnd = \Carbon\Carbon::createFromFormat('Y-m', $item->month)->endOfMonth();

                return [
                    'month' => $monthStart->format('F Y'),
                    'count' => $item->count,
                    'employers' => Employer::whereBetween('created_at', [$monthStart, $monthEnd])
                        ->select('company_name', 'email')
                        ->get()
                        ->toArray(),
                ];
            });

        // Get summary counts
        $dailyTotal = $dailyCount->first()['count'] ?? 0;
        $weeklyTotal = $weeklyCount->first()['count'] ?? 0;

        return view('Admin.report.employer', compact(
            'dailyCount',
            'weeklyCount',
            'monthlyCount',
            'dailyTotal',
            'weeklyTotal'
        ));
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
    public function extraregister(Request $request)
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

        return redirect('/employer-register')->with('success', 'Employer registered successfully. You can now log in.');
    }
    // Dashboard

    public function dashboard()
    {
        $currentDate = now();

        // Fetch statistics for the current employer

        // Get the current employer's ID (assuming you have logged-in employer session data)
        $employerId = auth()->user()->id;

        // Fetch job and application statistics for the current employer
        $totalJobsPosted = JobPosting::where('employer_id', $employerId)->count();
        $totalApplications = Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->count();

        // Get recent applications for the employer (within the last 7 days)
        $recentApplications = Application::where('employer_id', $employerId)
            ->whereDate('created_at', '>=', $currentDate->copy()->subDays(7))
            ->latest()
            ->take(5)
            ->get();

        // Pass these statistics to the view
        return view('employer.dashboard', compact('totalJobsPosted', 'totalApplications', 'recentApplications'));
    }

    // Show Employer Profile Form
    public function showProfileForm()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile', compact('employer')); // Ensure you have a view at resources/views/employer/profile.blade.php
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $employers = Employer::where('company_name', 'LIKE', "%{$query}%")->get(['id', 'company_name']);
        return response()->json($employers);
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
    public function updateLogo(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        // Validate the logo
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Accept only images with a max size of 2MB
        ]);

        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($employer->logo) {
                \Storage::delete('public/' . $employer->logo);
            }

            // Store the new logo
            $logoPath = $request->file('logo')->store('logos', 'public'); // Save in 'public/logos'
            $employer->logo = $logoPath;
        }

        // Save the employer with the updated logo
        $employer->save();

        return redirect()->route('employer.profile')->with('success', 'Logo updated successfully.');
    }

    public function toggleStatus($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->is_active = !$employer->is_active; // Toggle status
        $employer->save();

        return redirect()->route('employer.list')->with('success', 'Employer status updated successfully!');
    }

}
