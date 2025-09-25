<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $api_service_token_type_id
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Account newModelQuery()
 * @method static Builder<static>|Account newQuery()
 * @method static Builder<static>|Account query()
 * @method static Builder<static>|Account whereApiServiceTokenTypeId($value)
 * @method static Builder<static>|Account whereCompanyId($value)
 * @method static Builder<static>|Account whereCreatedAt($value)
 * @method static Builder<static>|Account whereId($value)
 * @method static Builder<static>|Account whereName($value)
 * @method static Builder<static>|Account whereToken($value)
 * @method static Builder<static>|Account whereUpdatedAt($value)
 * @property-read \App\Models\ApiServiceTokenType $apiServiceTokenType
 * @mixin Eloquent
 */
class Account extends Model
{
    protected $fillable = [
        'name',
        'company_id',
        'api_service_token_type_id',
        'token',
    ];

    public function apiServiceTokenType(): BelongsTo
    {
        return $this->belongsTo(ApiServiceTokenType::class);
    }
}
