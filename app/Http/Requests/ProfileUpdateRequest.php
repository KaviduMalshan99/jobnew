<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'resume_file' => 'nullable|file|mimes:pdf|max:2048',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'summary' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:1000',
            'certifications' => 'nullable|string|max:1000',
            'portfolio_link' => 'nullable|url|max:255',
            'social_links' => 'nullable|string|max:1000',

            // Job Experiences
            'job_experiences' => 'array',
            'job_experiences.*.id' => 'nullable|exists:job_experience,id',
            'job_experiences.*.company_name' => 'required|string|max:255',
            'job_experiences.*.job_title' => 'required|string|max:255',
            'job_experiences.*.start_date' => 'required|date',
            'job_experiences.*.end_date' => 'nullable|date|after_or_equal:job_experiences.*.start_date',
            'job_experiences.*.job_description' => 'nullable|string|max:1000',

            // Job Educations
            'job_educations' => 'array',
            'job_educations.*.id' => 'nullable|exists:job_education,id',
            'job_educations.*.institution_name' => 'required|string|max:255',
            'job_educations.*.degree' => 'required|string|max:255',
            'job_educations.*.field_of_study' => 'nullable|string|max:255',
            'job_educations.*.start_date' => 'required|date',
            'job_educations.*.end_date' => 'nullable|date|after_or_equal:job_educations.*.start_date',
        ];
    }
}