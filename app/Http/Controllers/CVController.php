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
            'name' => 'required|string',
            'email' => 'required|email',
            'contact_number' => 'required|string',
            'employer_id' => 'required|exists:employers,id',
            'job_posting_id' => 'required|exists:job_postings,id',
            'message' => 'nullable|string',
        ]);

        try {
            // Fetch the authenticated user
            $user = auth()->user();

            // Fetch related experiences and educations
            $experiences = $user->jobExperiences;
            $educations = $user->jobEducations;

            // Generate the PDF using the view
            $hideButton = true;
            $pdf = PDF::loadView('User.cv', compact('user', 'experiences', 'educations', 'hideButton'));

            // Define the file name and path
            $fileName = 'cv_' . $user->id . '_' . time() . '.pdf';
            $fileDirectory = 'resumes';
            $filePath = $fileDirectory . '/' . $fileName;

            // Save the PDF file
            Storage::put($filePath, $pdf->output());

            // Update user's resume file
            $user->resume_file = $filePath;
            $user->save();

            // Fetch employer details
            $employer = Employer::findOrFail($validated['employer_id']);

            // Create the application record
            $application = new Application();
            $application->user_id = $user->id;
            $application->employer_id = $validated['employer_id'];
            $application->company_mail = $employer->email;
            $application->cv_path = $filePath;
            $application->job_posting_id = $validated['job_posting_id'];
            $application->message = $validated['message'];
            $application->contact_number = $validated['contact_number'];
            $application->name = $validated['name'];
            $application->email = $validated['email']; // Add this line to save email

            // For debugging
            \Log::info('Application data before save:', [
                'user_id' => $application->user_id,
                'employer_id' => $application->employer_id,
                'company_mail' => $application->company_mail,
                'cv_path' => $application->cv_path,
                'job_posting_id' => $application->job_posting_id,
                'message' => $application->message,
                'contact_number' => $application->contact_number,
                'name' => $application->name,
                'email' => $application->email,
            ]);

            dd($application);
            $application->save();

            return redirect()->route('profile.edit')
                ->with('success', 'CV generated and application submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('CV Generation Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error generating CV: ' . $e->getMessage())
                ->withInput();
        }
    }

}