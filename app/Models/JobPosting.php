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
        'package_id',
        'subcategory_id',
        'location',
        'country',
        'salary_range',
        'image',
        'requirements',
        'employer_id',
        'admin_id',
        'closing_date',
        'approved_date',
        'rejected_date',
        'status',
        'rejection_reason',
        'job_id',
        'is_active',
        'creator_id',
        'payment_method',
        'country_id',
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_posting_id');
    }
    public function flaggedByUsers()
    {
        return $this->belongsToMany(User::class, 'flagged_jobs', 'job_posting_id', 'user_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}