<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'transactionID';

    protected $fillable = [
        'transactionID',
        'reference',
        'description',
        'totalAmount',
        'status',
        'user_id',
    ];
}
