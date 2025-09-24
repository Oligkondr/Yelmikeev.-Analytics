<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiServiceTokenType extends Model
{
    protected $fillable = [
        'token_type_id',
        'api_service_id',
    ];
}
