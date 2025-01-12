<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

// Import the Dompdf facade

class CVController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Fetch authenticated user
        $experiences = $user->jobExperiences; // Assuming relationship is defined
        $educations = $user->jobEducations; // Assuming relationship is defined

        return view('User.cv', compact('user', 'experiences', 'educations'));
    }
    public function generateCV(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:20',
            'employer_id' => 'required|exists:employers,id',
            'job_posting_id' => 'required|exists:job_postings,id',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            $user = auth()->user();
            $experiences = $user->jobExperiences;
            $educations = $user->jobEducations;

            // Generate PDF
            $hideButton = true;
            $pdf = PDF::loadView('User.cv', compact(
                'user',
                'experiences',
                'educations',
                'hideButton'
            ));

            // Save PDF file
            $fileName = 'cv_' . $user->id . '_' . time() . '.pdf';
            $fileDirectory = 'resumes';
            $filePath = $fileDirectory . '/' . $fileName;
            Storage::put($filePath, $pdf->output());

            // Update user's resume file
            $user->resume_file = $filePath;
            $user->save();

            // Create application
            $application = Application::create([
                'user_id' => $user->id,
                'employer_id' => $validated['employer_id'],
                'company_mail' => Employer::findOrFail($validated['employer_id'])->email,
                'cv_path' => $filePath,
                'job_posting_id' => $validated['job_posting_id'],
                'message' => $validated['message'],
                'contact_number' => $validated['contact_number'],
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Log successful application creation
            \Log::info('Application created successfully', [
                'application_id' => $application->id,
                'user_id' => $application->user_id,
            ]);

            return redirect()->route('profile.edit')
                ->with('success', 'CV generated and application submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('CV Generation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->with('error', 'Unable to process your application. Please try again.')
                ->withInput();
        }
    }

}