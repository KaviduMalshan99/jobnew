<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'company_name',
        'email',
        'password',
        'contact_details',
        'business_info',
        'job_posting_settings',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'job_posting_settings' => 'array',
    ];

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'employer_id');
    }
}
