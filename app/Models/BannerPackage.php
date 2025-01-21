<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'duration',
        'price_lkr',
        'price_usd',
    ];
}