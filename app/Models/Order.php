<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'date' => 'datetime',
        'last_change_date' => 'date',
        'is_cancel' => 'boolean',
        'cancel_dt' => 'datetime',
    ];
}
