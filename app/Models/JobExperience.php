<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;

    protected $table = 'job_experience';

    protected $fillable = [
        'job_seeker_id',
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'job_description',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

}