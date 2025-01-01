<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Important for guards
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Ensure the table name is explicitly set (if not following Laravel's default conventions)
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

}