<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'subcategory_id',
        'location',
        'salary_range',
        'image',
        'requirements',
        'employer_id',
        'closing_date',
        'status',
        'job_id',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}