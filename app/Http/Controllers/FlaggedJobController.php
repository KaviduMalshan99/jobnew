<?php

namespace App\Http\Controllers;

use App\Models\FlaggedJob;
use Illuminate\Http\Request;

class FlaggedJobController extends Controller
{
    public function toggleFlag(Request $request, $jobId)
    {
        $user = auth()->user(); // Get the logged-in user

        // Check if the job is already flagged
        $flaggedJob = FlaggedJob::where('user_id', $user->id)->where('job_posting_id', $jobId)->first();

        if ($flaggedJob) {
            // If flagged, unflag it
            $flaggedJob->delete();
            return response()->json(['status' => 'unflagged', 'message' => 'Job removed from your list.']);
        } else {
            // If not flagged, flag it
            FlaggedJob::create([
                'user_id' => $user->id,
                'job_posting_id' => $jobId,
            ]);
            return response()->json(['status' => 'flagged', 'message' => 'Job saved to your list.']);
        }
    }
    public function showFlaggedJobs()
    {
        $user = auth()->user(); // Get the logged-in user

        // Fetch flagged jobs with job posting and employer details
        $flaggedJobs = FlaggedJob::where('user_id', $user->id)
            ->with(['jobPosting.employer']) // Access the jobPosting relationship
            ->get();

        return view('User.jobseekerprofile.myJobs.myapplication', compact('flaggedJobs'));
    }

}