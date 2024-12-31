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

        return view('user.jobseekerprofile.experience', compact('experiences'));
    }

    public function store(Request $request)
    {
        Log::info('Incoming new experience data:', $request->all());

        $validatedData = $request->validate([
            'job_seeker_id' => 'required|exists:users,id',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.job_title' => 'required|string|max:255',
            'experiences.*.job_description' => 'nullable|string',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
        ]);

        try {
            foreach ($validatedData['experiences'] as $experienceData) {
                JobExperience::create([
                    'job_seeker_id' => $validatedData['job_seeker_id'],
                    'company_name' => $experienceData['company_name'],
                    'job_title' => $experienceData['job_title'],
                    'job_description' => $experienceData['job_description'],
                    'start_date' => $experienceData['start_date'],
                    'end_date' => $experienceData['end_date'],
                ]);
            }

            return redirect()->back()->with('success', 'Experience details added successfully!');
        } catch (\Exception $e) {
            Log::error('Error in experience creation:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Incoming experience update data:', $request->all());

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        try {
            $experience = JobExperience::where('id', $id)
                ->where('job_seeker_id', auth()->id())
                ->firstOrFail();

            $experience->update($validatedData);

            return redirect()->back()->with('success', 'Experience details updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error in experience update:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $experience = JobExperience::where('id', $id)
                ->where('job_seeker_id', auth()->id())
                ->firstOrFail();

            $experience->delete();

            return redirect()->back()->with('success', 'Experience record deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error in experience deletion:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while deleting the record.');
        }
    }
}