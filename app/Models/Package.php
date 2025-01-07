<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Define the table name (optional if it matches the model name in plural)
    protected $table = 'packages';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
        'package_size',
        'duration_days',
        'lkr_price',
        'usd_price',
    ];
}