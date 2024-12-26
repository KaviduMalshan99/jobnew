<?php

namespace App\Http\Controllers;

use App\Models\JobEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    public function showEducation()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user_id = auth()->id();
        $educations = JobEducation::where('job_seeker_id', $user_id)->get();

        return view('user.jobseekerprofile.education', compact('educations'));
    }

    public function storeOrUpdate(Request $request)
    {
        // First, let's log the incoming request data
        Log::info('Incoming education data:', $request->all());

        $validatedData = $request->validate([
            'job_seeker_id' => 'required|exists:users,id',
            'educations.*.institution_name' => 'required|string|max:255',
            'educations.*.degree' => 'required|string|max:255',
            'educations.*.field_of_study' => 'nullable|string|max:255',
            'educations.*.start_date' => 'required|date',
            'educations.*.end_date' => 'nullable|date|after_or_equal:educations.*.start_date',
        ]);

        try {
            $jobSeekerId = $validatedData['job_seeker_id'];

            // Get existing education record for this user
            $existingEducation = JobEducation::where('job_seeker_id', $jobSeekerId)->first();

            foreach ($validatedData['educations'] as $educationData) {
                if ($existingEducation) {
                    // Log update attempt
                    Log::info('Updating existing education record:', [
                        'id' => $existingEducation->id,
                        'data' => $educationData,
                    ]);

                    // Update existing record
                    $existingEducation->update([
                        'institution_name' => $educationData['institution_name'],
                        'degree' => $educationData['degree'],
                        'field_of_study' => $educationData['field_of_study'],
                        'start_date' => $educationData['start_date'],
                        'end_date' => $educationData['end_date'],
                    ]);
                } else {
                    // Log new record creation
                    Log::info('Creating new education record:', $educationData);

                    // Create new record
                    JobEducation::create([
                        'job_seeker_id' => $jobSeekerId,
                        'institution_name' => $educationData['institution_name'],
                        'degree' => $educationData['degree'],
                        'field_of_study' => $educationData['field_of_study'],
                        'start_date' => $educationData['start_date'],
                        'end_date' => $educationData['end_date'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Education details saved successfully!');
        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error in education update:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
