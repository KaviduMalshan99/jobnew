<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlaggedJob extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_posting_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the JobPosting model
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_posting_id');
    }
}