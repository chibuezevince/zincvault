<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'username',
        'pound_balance',
        'dollar_balance',
        'euro_balance',
        'account_number',
        'account_type',
        'currency',
        'date_of_birth',
        'address',
        'country',
        'gender',
        'profile_image',
        'tac',
        'tax',
        'imf',
    ];
}
