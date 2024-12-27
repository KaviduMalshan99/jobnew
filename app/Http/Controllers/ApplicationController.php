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
