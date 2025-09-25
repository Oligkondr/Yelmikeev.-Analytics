<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ApiService newModelQuery()
 * @method static Builder<static>|ApiService newQuery()
 * @method static Builder<static>|ApiService query()
 * @method static Builder<static>|ApiService whereCreatedAt($value)
 * @method static Builder<static>|ApiService whereId($value)
 * @method static Builder<static>|ApiService whereName($value)
 * @method static Builder<static>|ApiService whereUpdatedAt($value)
 * @property-read Collection<int, ApiServiceTokenType> $apiServiceTokenTypes
 * @property-read int|null $api_service_token_types_count
 * @property-read Collection<int, TokenType> $tokenTypes
 * @property-read int|null $token_types_count
 * @property string $url
 * @method static Builder<static>|ApiService whereUrl($value)
 * @mixin Eloquent
 */
class ApiService extends Model
{
    protected $fillable = [
        'name',
        'url',
    ];

    public function tokenTypes(): HasManyThrough
    {
        return $this->hasManyThrough(
            TokenType::class,
            ApiServiceTokenType::class,
            'api_service_id',
            'id',
            'id',
            'token_type_id',
        );
    }

    public function apiServiceTokenTypes(): HasMany
    {
        return $this->hasMany(ApiServiceTokenType::class);
    }
}
