<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ContactUs;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Ensure authentication for all methods
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Use $request->user() instead of auth()->user()
        $user = $request->user();

        // Ensure these relationships exist in the User model
        $experiences = $user->jobExperiences ?? collect();
        $educations = $user->jobEducations ?? collect();
        $contacts = ContactUs::all();

        return view('user.jobseekerprofile.jobseekerprofile', compact('user', 'experiences', 'educations', 'contacts'));
    }
    public function showpersonal(Request $request): View
    {
        // Use $request->user() instead of auth()->user()
        $user = $request->user();

        // Ensure these relationships exist in the User model
        $experiences = $user->jobExperiences ?? collect();
        $educations = $user->jobEducations ?? collect();
        $contacts = ContactUs::all();

        return view('user.jobseekerprofile.personal', compact('user', 'experiences', 'educations', 'contacts'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Use $request->user() for consistency and to avoid potential auth issues
        $user = $request->user();

        DB::transaction(function () use ($request, $user) {
            // Update main user profile
            $user->update($request->only([
                'name', 'email', 'phone_number', 'address',
                'linkedin', 'summary', 'skills',
                'portfolio_link', 'experience', 'education', 'certifications', 'social_links',
            ]));

            // Handle Resume Upload
            if ($request->hasFile('resume_file')) {
                // Delete old resume if exists
                if ($user->resume_file) {
                    Storage::delete($user->resume_file);
                }

                // Store new resume
                $resumePath = $request->file('resume_file')->store('resumes');
                $user->resume_file = $resumePath;
                $user->save();
            }

            // Update Experiences
            // Use deleteMany() for more robust deletion
            if ($request->has('educations')) {
                // Delete existing education records
                $user->jobEducations()->delete();

                // Create new education records
                foreach ($request->input('educations') as $education) {
                    // Validate required fields
                    if (!empty($education['institution_name']) &&
                        !empty($education['degree']) &&
                        !empty($education['field_of_study'])) {

                        $user->jobEducations()->create([
                            'institution_name' => $education['institution_name'],
                            'degree' => $education['degree'],
                            'field_of_study' => $education['field_of_study'],
                            'start_date' => $education['start_date'],
                            'end_date' => $education['end_date'],
                        ]);
                    }
                }
            }

            // Update Educations
            $user->jobEducations()->delete();
            if ($request->has('educations')) {
                foreach ($request->input('educations', []) as $education) {
                    // Ensure all required fields are present
                    if (!empty($education['institution_name']) && !empty($education['degree'])) {
                        $user->jobEducations()->create($education);
                    }
                }
            }
        });

        return redirect()->route('profile.edit')
            ->with('status', 'Profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Optional: Delete associated resume file
        if ($user->resume_file) {
            Storage::delete($user->resume_file);
        }

        // Logout user
        Auth::logout();

        // Delete user account
        $user->delete();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'account-deleted');
    }

    /**
     * Optional: Method to handle resume file download
     */
    public function downloadResume(Request $request)
    {
        $user = $request->user();

        if (!$user->resume_file) {
            return back()->with('error', 'No resume file found.');
        }

        return Storage::download($user->resume_file, 'resume.pdf');
    }

    /**
     * Optional: Method to remove resume file
     */
    public function removeResume(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->resume_file) {
            Storage::delete($user->resume_file);
            $user->resume_file = null;
            $user->save();
        }

        return Redirect::route('profile.edit')
            ->with('status', 'resume-removed');
    }
    public function generateCv()
    {
        $user = auth()->user();
        $experiences = $user->experiences;
        $educations = $user->educations;

        // Generate PDF using the alias
        $pdf = Pdf::loadView('profile.cv', compact('user', 'experiences', 'educations'));

        return $pdf->download('cv.pdf');
    }

}
