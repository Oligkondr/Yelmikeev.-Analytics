<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $api_service_id
 * @property int $token_type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ApiServiceTokenType newModelQuery()
 * @method static Builder<static>|ApiServiceTokenType newQuery()
 * @method static Builder<static>|ApiServiceTokenType query()
 * @method static Builder<static>|ApiServiceTokenType whereApiServiceId($value)
 * @method static Builder<static>|ApiServiceTokenType whereCreatedAt($value)
 * @method static Builder<static>|ApiServiceTokenType whereId($value)
 * @method static Builder<static>|ApiServiceTokenType whereTokenTypeId($value)
 * @method static Builder<static>|ApiServiceTokenType whereUpdatedAt($value)
 * @property-read ApiService $apiService
 * @property-read TokenType $tokenType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account> $accounts
 * @property-read int|null $accounts_count
 * @mixin Eloquent
 */
class ApiServiceTokenType extends Model
{
    protected $fillable = [
        'api_service_id',
        'token_type_id',
    ];

    public function apiService(): BelongsTo
    {
        return $this->belongsTo(ApiService::class);
    }

    public function tokenType(): BelongsTo
    {
        return $this->belongsTo(TokenType::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
