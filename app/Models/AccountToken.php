<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountToken extends Model
{
    protected $fillable = [
        'account_id',
        'api_service_token_type_id',
        'token',
    ];
}
