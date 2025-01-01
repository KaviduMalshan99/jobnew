<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    /**
     * Show the application form.
     */
    public function showApplyForm(JobPosting $job)
    {
        $employerEmail = $job->employer->email;

        return view('home.jobs.apply', compact('job', 'employerEmail')); // Replace with the actual view path
    }

    public function myApplications()
    {
        $applications = Application::with(['job', 'job.employer'])
            ->where('user_id', auth()->id())
            ->get();

        return view('User.jobseekerprofile.myJobs.myapplication', compact('applications'));
    }
    public function viewApplicationDetails($id)
    {
        // Fetch the application along with the associated job and employer
        $application = Application::with('job.employer')
            ->where('id', $id)
            ->where('user_id', auth()->id()) // Ensure the user owns the application
            ->firstOrFail();

        return view('User.jobseekerprofile.myJobs.applicationDetails', compact('application'));
    }
    /**
     * Handle form submission.
     */
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|regex:/^[0-9]+$/',
            'message' => 'nullable|string',
            'cv_path' => 'required|mimes:doc,docx,pdf,odt,rtf,jpg,jpeg,gif,png|max:2048',

            'employer_id' => 'required|exists:employers,id',
            'user_id' => 'nullable|exists:users,id',
            'company_mail' => 'required|email',
            'job_posting_id' => 'required|exists:job_postings,id',
        ]);

        // Handle file upload
        if ($request->hasFile('cv')) {
            $validated['cv_path'] = $request->file('cv')->store('cv_uploads', 'public');
        }

        Application::create($validated);

        Session::flash('success', 'Your application has been submitted successfully.');

        return redirect()->back();
    }
}