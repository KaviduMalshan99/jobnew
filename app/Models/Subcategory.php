<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'status'];

    // Define the relationship with the parent category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}