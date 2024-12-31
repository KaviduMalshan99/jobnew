<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'resume_file',
        'address',
        'linkedin',
        'summary',
        'experience', // me tynne wenma user table eke tyna nikm colum ekak eka experince table ekat ekka sambndayak nha
        'education', //me tynne wenma user table eke tyna nikm colum ekak eka education table ekat ekka sambndayak nha
        'skills',
        'certifications',
        'portfolio_link',
        'social_links',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // In User model
    public function jobExperiences()
    {
        return $this->hasMany(JobExperience::class, 'job_seeker_id');
    }

    public function jobEducations()
    {
        return $this->hasMany(JobEducation::class, 'job_seeker_id');
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }
    public function flaggedJobs()
    {
        return $this->belongsToMany(JobPosting::class, 'flagged_jobs', 'user_id', 'job_posting_id');
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

}