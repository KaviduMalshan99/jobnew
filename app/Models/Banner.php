<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'package_id',
        'payment_method',
        'placement',
        'status',
    ];

    /**
     * Relationship with the Category model.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with the BannerPackage model.
     */
    public function package()
    {
        return $this->belongsTo(BannerPackage::class, 'package_id');
    }
}