<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_no',
        'bank_code',
        'branch_code',
        'branch_name', // Add this line
        'swift_code',
        'currency',
    ];
}
