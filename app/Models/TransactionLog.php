<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'username','cred_deb', 'type','time','status','reason','amount','currency','transaction_id','inter_details','local_details',
    ];

    protected $casts = [
        'inter_details' => 'array',
        'local_details' => 'array',
    ];
}
