<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
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
        $contacts = ContactUs::all();

        return view('user.jobseekerprofile.education', compact('educations', 'contacts'));
    }

    public function store(Request $request)
    {
        Log::info('Incoming new education data:', $request->all());

        $validatedData = $request->validate([
            'job_seeker_id' => 'required|exists:users,id',
            'educations.*.institution_name' => 'required|string|max:255',
            'educations.*.degree' => 'required|string|max:255',
            'educations.*.field_of_study' => 'nullable|string|max:255',
            'educations.*.start_date' => 'required|date',
            'educations.*.end_date' => 'nullable|date|after_or_equal:educations.*.start_date',
        ]);

        try {
            foreach ($validatedData['educations'] as $educationData) {
                JobEducation::create([
                    'job_seeker_id' => $validatedData['job_seeker_id'],
                    'institution_name' => $educationData['institution_name'],
                    'degree' => $educationData['degree'],
                    'field_of_study' => $educationData['field_of_study'],
                    'start_date' => $educationData['start_date'],
                    'end_date' => $educationData['end_date'],
                ]);
            }

            return redirect()->back()->with('success', 'Education details added successfully!');
        } catch (\Exception $e) {
            Log::error('Error in education creation:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        Log::info('Incoming education update data:', $request->all());

        $validatedData = $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        try {
            $education = JobEducation::where('id', $id)
                ->where('job_seeker_id', auth()->id())
                ->firstOrFail();

            $education->update($validatedData);

            return redirect()->back()->with('success', 'Education details updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error in education update:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $education = JobEducation::where('id', $id)
                ->where('job_seeker_id', auth()->id())
                ->firstOrFail();

            $education->delete();

            return redirect()->back()->with('success', 'Education record deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error in education deletion:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while deleting the record.');
        }
    }
}
