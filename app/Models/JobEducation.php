<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobEducation extends Model
{
    use HasFactory;

    protected $table = 'job_education';

    protected $fillable = [
        'job_seeker_id',
        'institution_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

}