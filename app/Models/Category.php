<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    // Define the relationship with subcategories
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}