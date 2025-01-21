<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_lkr_7days',
        'price_usd_7days',
        'price_lkr_21days',
        'price_usd_21days',
    ];
}