<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'contact',
        'description_one',
        'description_two',
    ];
}