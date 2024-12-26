<?php

namespace App\Http\Controllers;

use App\Models\JobExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobExperienceController extends Controller
{
    public function showExperience()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user_id = auth()->id();
        $experiences = JobExperience::where('job_seeker_id', $user_id)->get();

        return view('user.jobseekerprofile.expirience', compact('experiences'));
    }

    public function storeOrUpdate(Request $request)
    {
        // Log the incoming request data
        Log::info('Incoming request data:', $request->all());

        try {
            $validatedData = $request->validate([
                'job_seeker_id' => 'required|exists:users,id',
                'experiences' => 'required|array',
                'experiences.*.organisation' => 'required|string|max:255',
                'experiences.*.designation' => 'required|string|max:255',
                'experiences.*.commenced_date' => 'required|date',
                'experiences.*.completion_date' => 'required|date',
                'experiences.*.job_description' => 'required|string', // Added validation for description
            ]);

            $jobSeekerId = $request->input('job_seeker_id');

            // Get existing experience for this user
            $existingExperience = JobExperience::where('job_seeker_id', $jobSeekerId)->first();

            Log::info('Existing experience:', ['experience' => $existingExperience]);

            foreach ($request->experiences as $experienceData) {
                $updateData = [
                    'company_name' => $experienceData['organisation'],
                    'job_title' => $experienceData['designation'],
                    'start_date' => $experienceData['commenced_date'],
                    'end_date' => $experienceData['completion_date'],
                    'job_description' => $experienceData['job_description'], // Added description to update data
                ];

                if ($existingExperience) {
                    // Update existing record
                    Log::info('Updating existing experience:', $updateData);
                    $updated = $existingExperience->update($updateData);
                    Log::info('Update result:', ['success' => $updated]);
                } else {
                    // Create new record
                    Log::info('Creating new experience:', $updateData);
                    $updateData['job_seeker_id'] = $jobSeekerId;
                    $created = JobExperience::create($updateData);
                    Log::info('Creation result:', ['success' => $created]);
                }
            }

            return redirect()->back()->with('success', 'Experience details saved successfully!');
        } catch (\Exception $e) {
            Log::error('Error in experience update:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }
}
