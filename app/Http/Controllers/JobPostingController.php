<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobPosting;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPostingController extends Controller
{
    public function index()
    {
        $jobPostings = JobPosting::with(['category', 'subcategory', 'employer'])->paginate(10);
        return view('admin.jobview', compact('jobPostings'));
    }
    public function updateStatus(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id); // Retrieve the job posting by ID
        $job->status = $request->input('status'); // Update the status
        $job->save(); // Save the changes

        return redirect()->route('job_postings.index')->with('success', 'Job status updated successfully.');
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        $subcategories = Subcategory::all(); // Fetch all subcategories
        $employerId = auth('employer')->user()->id; // Fetch all employers

        return view('employer.jobcreate', compact('categories', 'subcategories', 'employerId'));
    }
    public function employerJobs()
    {
        // Get the logged-in employer's ID
        $employerId = auth('employer')->id();

        // Retrieve job postings created by the employer
        $jobPostings = JobPosting::where('employer_id', $employerId)
            ->with(['category', 'subcategory'])
            ->paginate(10);

        // Return the view with the job postings data
        return view('employer.jobview', compact('jobPostings'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'location' => 'required|string|max:255',
            'salary_range' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'requirements' => 'required|string',
            'closing_date' => 'required|date',
            'status' => 'required|in:pending,reject,approved',
        ]);

        // Automatically assign the employer_id based on the logged-in employer
        $validated['employer_id'] = auth('employer')->id();

        // Generate a unique job_id (ensure it's unique by checking the database)
        do {
            $jobId = 'J' . Str::random(8); // Generates a random string of 8 characters
        } while (JobPosting::where('job_id', $jobId)->exists()); // Check for uniqueness

        $validated['job_id'] = $jobId;

        // Handle image upload if a file is provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('job_images', 'public');
        }

        // Create and save the job posting
        $jobPosting = JobPosting::create($validated);

        // Redirect with a success message
        return redirect()->route('employer.job_postings.post.create')->with('success', 'Job posting created successfully!');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function edit(JobPosting $jobPosting)
    {
        $categories = Category::all(); // Assuming you have a Category model
        $subcategories = Subcategory::where('category_id', $jobPosting->category_id)->get(); // Assuming you have a Subcategory model
        return view('employer.jobupdate', compact('jobPosting', 'categories', 'subcategories'));
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        try {
            // Remove employer_id and job_id from validation since they shouldn't change
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'required|exists:subcategories,id',
                'location' => 'required|string|max:255',
                'salary_range' => 'nullable|numeric',
                'image' => 'nullable|image|max:2048',
                'requirements' => 'required',
                'closing_date' => 'required|date',
                'status' => 'nullable|in:pending,reject,approved', // Make status nullable
            ]);

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('job_images', 'public');
            }

            // Update the job posting
            $jobPosting->update($validated);

            // Redirect to employer jobs view
            return redirect()->route('employer.job_postings.employer.jobs')
                ->with('success', 'Job Posting updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while updating the job posting: ' . $e->getMessage());
        }
    }

    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();
        return redirect()->route('job_postings.index')->with('success', 'Job Posting deleted successfully.');
    }
}