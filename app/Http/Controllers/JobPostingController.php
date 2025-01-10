<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Package;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobPostingController extends Controller
{
    public function index()
    {
        // Fetch all published jobs
        $jobPostings = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'approved')
            ->where('is_active', true)
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->paginate(10);

        // Fetch all pending jobs
        $pendingJobs = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'pending')
            ->where('is_active', true)
            ->whereDate('closing_date', '>=', now()) // Exclude expired jobs
            ->paginate(10);

        // Fetch all rejected jobs
        $rejectedJobs = JobPosting::with(['category', 'subcategory', 'employer'])
            ->where('status', 'reject')
            ->where('is_active', true)
            ->paginate(10); // Rejected jobs are displayed regardless of closing date

        return view('admin.jobview', compact('jobPostings', 'pendingJobs', 'rejectedJobs'));
    }

    public function topEmployers()
    {
        // Fetch top 28 employers based on job postings count and filter those with a logo
        $topEmployers = Employer::withCount('jobPostings') // Assuming 'jobPostings' is the relationship
            ->whereNotNull('logo') // Filter employers with a non-null logo
            ->where('logo', '!=', '') // Ensure the logo is not an empty string
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
            ->where('is_active', true)
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
        $contacts = ContactUs::all();

        return view('home.home', compact('categories', 'jobs', 'contacts'));
    }

    public function toggleActiveStatus($id)
    {
        // Find the job posting by ID and ensure it belongs to the authenticated employer
        $job = JobPosting::where('id', $id)
            ->where('employer_id', auth('employer')->id()) // Ensure the job belongs to the current employer
            ->firstOrFail();

        // Toggle the is_active status
        $job->is_active = !$job->is_active;
        $job->save();

        $status = $job->is_active ? 'active' : 'inactive';

        return redirect()->back()->with('success', "Job posting has been marked as $status.");
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
        $packages = Package::all();

        return view('employer.jobcreate', compact('categories', 'subcategories', 'employerId', 'packages'));
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
        try {
            // First validate the package selection
            $request->validate([
                'package_id' => 'required|exists:packages,id',
            ]);

            $employerId = auth('employer')->id();
            $packageId = $request->input('package_id');
            $jobPostings = $request->input('job_postings', []);

            // Check if job postings exist
            if (!is_array($jobPostings) || empty($jobPostings)) {
                return redirect()->back()
                    ->withErrors(['job_postings' => 'No job postings provided.'])
                    ->withInput();
            }

            // Validate all job postings first
            foreach ($jobPostings as $index => $posting) {
                $request->validate([
                    "job_postings.{$index}.title" => 'required|string|max:255',
                    "job_postings.{$index}.description" => 'required|string',
                    "job_postings.{$index}.category_id" => 'required|exists:categories,id',
                    "job_postings.{$index}.subcategory_id" => 'required|exists:subcategories,id',
                    "job_postings.{$index}.location" => 'required|string|max:255',
                    "job_postings.{$index}.salary_range" => 'nullable|numeric',
                    "job_postings.{$index}.image" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
                    "job_postings.{$index}.requirements" => 'required|string',
                    "job_postings.{$index}.closing_date" => 'required|date',
                    "job_postings.{$index}.status" => 'required|in:pending,reject,approved',
                ]);
            }

            // Check package limits
            $package = Package::findOrFail($packageId);
            $existingJobCount = JobPosting::where('employer_id', $employerId)
                ->where('package_id', $packageId)
                ->count();

            if ($existingJobCount + count($jobPostings) > $package->package_size) {
                return redirect()->back()
                    ->withErrors(['package_id' => 'Exceeded maximum allowed job postings for this package.'])
                    ->withInput();
            }

            // Process each job posting
            DB::beginTransaction();
            try {
                foreach ($jobPostings as $index => $jobData) {
                    // Generate unique job ID
                    do {
                        $jobId = 'J' . rand(10000, 99999);
                    } while (JobPosting::where('job_id', $jobId)->exists());

                    // Create job posting data
                    $jobPostingData = [
                        'job_id' => $jobId,
                        'employer_id' => $employerId,
                        'package_id' => $packageId,
                        'title' => $jobData['title'],
                        'description' => $jobData['description'],
                        'category_id' => $jobData['category_id'],
                        'subcategory_id' => $jobData['subcategory_id'],
                        'location' => $jobData['location'],
                        'salary_range' => $jobData['salary_range'] ?? null,
                        'requirements' => $jobData['requirements'],
                        'closing_date' => $jobData['closing_date'],
                        'status' => $jobData['status'],
                    ];

                    // Create the job posting
                    $posting = JobPosting::create($jobPostingData);

                    // Handle image upload if present
                    if ($request->hasFile("job_postings.{$index}.image")) {
                        $imagePath = $request->file("job_postings.{$index}.image")
                            ->store('job_images', 'public');
                        $posting->image = $imagePath;
                        $posting->save();
                    }
                }

                DB::commit();
                return redirect()->route('employer.job_postings.post.create')
                    ->with('success', 'Job postings created successfully!');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->withErrors(['error' => 'Failed to create job postings. Please try again.'])
                    ->withInput();
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred. Please try again.'])
                ->withInput();
        }
    }
    public function storeForAdmin(Request $request)
    {
        // Validate package selection and job postings
        $validatedData = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'job_postings.*.title' => 'required|string|max:255',
            'job_postings.*.description' => 'required|string',
            'job_postings.*.category_id' => 'required|exists:categories,id',
            'job_postings.*.subcategory_id' => 'required|exists:subcategories,id',
            'job_postings.*.location' => 'required|string|max:255',
            'job_postings.*.salary_range' => 'nullable|numeric',
            'job_postings.*.image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:4048',
            'job_postings.*.requirements' => 'required|string',
            'job_postings.*.closing_date' => 'required|date',
            'job_postings.*.status' => 'required|in:pending,reject,approved',
        ]);

        $adminId = auth('admin')->id();
        $packageId = $request->input('package_id');
        $jobPostings = $request->input('job_postings', []);

        if (empty($jobPostings)) {
            return redirect()->back()->withErrors(['job_postings' => 'No job postings provided.']);
        }

        // Check package limitations
        $package = Package::find($packageId);
        $existingJobCount = JobPosting::where('creator_id', $adminId)
            ->where('package_id', $packageId)
            ->count();

        if ($existingJobCount + count($jobPostings) > $package->package_size) {
            return redirect()->back()
                ->withErrors(['package_id' => 'Exceeded maximum allowed job postings for this package.'])
                ->withInput();
        }

        $storedPostings = [];
        foreach ($jobPostings as $index => $jobData) {
            // Generate unique job ID
            do {
                $jobId = 'J' . rand(10000, 99999);
            } while (JobPosting::where('job_id', $jobId)->exists());

            $jobData['job_id'] = $jobId;
            $jobData['creator_id'] = $adminId;
            $jobData['package_id'] = $packageId;

            // Handle image upload
            if ($request->hasFile("job_postings.$index.image")) {
                $jobData['image'] = $request->file("job_postings.$index.image")
                    ->store('job_images', 'public');
            }

            $storedPostings[] = JobPosting::create($jobData);
        }

        return redirect()->route('job_postings.index')->with('success', 'Job postings created successfully!');
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
    public function createForAdmin()
    {
        $categories = Category::all(); // Fetch all categories
        $subcategories = Subcategory::all(); // Fetch all subcategories
        $employers = Employer::all(); // Fetch all employers
        $packages = Package::all(); // Fetch all packages

        return view('Admin.jobcreate', compact('categories', 'subcategories', 'employers', 'packages'));
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
        return redirect()->route('employer.job_postings.employer.jobs')->with('success', 'Job Posting deleted successfully.');
    }
}
