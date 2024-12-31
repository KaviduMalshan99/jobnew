<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPostingController extends Controller
{
    public function index()
    {
        // Fetch all published jobs
        $jobPostings = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'approved')
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->paginate(10);

        // Fetch all pending jobs
        $pendingJobs = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'pending')
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->paginate(10);

        // Fetch all rejected jobs
        $rejectedJobs = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'reject')
            ->paginate(10); // Rejected jobs are displayed regardless of closing date

        return view('admin.jobview', compact('jobPostings', 'pendingJobs', 'rejectedJobs'));
    }

    public function topEmployers()
    {
        // Fetch top 28 employers based on job postings count
        $topEmployers = Employer::withCount('jobPostings') // Assuming 'jobPostings' is the relationship
            ->orderBy('job_postings_count', 'desc') // Sort by the number of job postings
            ->take(28) // Limit to top 28
            ->get();

        // Pass data to the view
        return view('User.topemployees', compact('topEmployers'));
    }

    public function home(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');

        $jobs = JobPosting::with(['category', 'subcategory'])
            ->where('status', 'approved') // Only approved jobs
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('employer', function ($q) use ($search) {
                            $q->where('company_name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($location, function ($query, $location) {
                $query->where('location', 'like', "%{$location}%");
            })
            ->get();

        $categories = Category::with('subcategories')->get();

        return view('home.home', compact('categories', 'jobs'));
    }

    public function show($id)
    {
        $job = JobPosting::with(['category', 'employer'])->findOrFail($id);
        return view('admin.showonejob', compact('job'
        ));
    }
    public function showjob($id)
    {
        $job = JobPosting::with(['category', 'employer'])->findOrFail($id);
        return view('home.jobs.show', compact('job'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|in:pending,approved,reject',
            'rejection_reason' => 'nullable|string|max:255', // Validate rejection reason
        ]);

        // Retrieve the job posting by ID
        $job = JobPosting::findOrFail($id);

        // Update the status
        $job->status = $request->input('status');

        // Save approved date if status is approved
        if ($job->status === 'approved') {
            $job->approved_date = now(); // Save the current timestamp
            $job->rejection_reason = null; // Clear rejection reason if previously set
        }

        // Save rejected date and reason if status is reject
        if ($job->status === 'reject') {
            $job->rejected_date = now(); // Save the current timestamp
            $job->rejection_reason = $request->input('rejection_reason'); // Save rejection reason
        }

        // Save the admin ID who updated the status
        $job->admin_id = auth('admin')->id(); // Assuming admin is logged in

        // Save the changes to the database
        $job->save();

        // Redirect back with a success message
        return redirect()->route('job_postings.index')->with('success', 'Job status updated successfully.');
    }
    public function getJobsByCategory($categoryId)
    {
        // Fetch jobs belonging to the specified category
        $jobs = JobPosting::where('category_id', $categoryId)
            ->where('status', 'approved')
            ->with('employer') // Load employer relationship if needed
            ->get();

        return response()->json($jobs);
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
        $employerId = auth('employer')->id();

        $jobPostings = JobPosting::where('employer_id', $employerId)
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->with(['category', 'subcategory', 'admin'])
            ->paginate(10);

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