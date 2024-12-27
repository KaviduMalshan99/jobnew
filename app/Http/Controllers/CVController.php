<?php
namespace App\Http\Controllers;

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
    public function generateCV()
    {
        // Fetch the authenticated user
        $user = auth()->user();

        // Fetch related experiences and educations
        $experiences = $user->jobExperiences; // Ensure the relationship is defined as jobExperiences()
        $educations = $user->jobEducations; // Ensure the relationship is defined as jobEducations()

        // Load the CV view with the data
        $hideButton = true; // Define the flag
        $pdf = PDF::loadView('User.cv', compact('user', 'experiences', 'educations', 'hideButton'));
        // Return the generated PDF for download
        return $pdf->download('cv.pdf');
    }
}
