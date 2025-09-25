<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|TokenType newModelQuery()
 * @method static Builder<static>|TokenType newQuery()
 * @method static Builder<static>|TokenType query()
 * @method static Builder<static>|TokenType whereCreatedAt($value)
 * @method static Builder<static>|TokenType whereId($value)
 * @method static Builder<static>|TokenType whereName($value)
 * @method static Builder<static>|TokenType whereUpdatedAt($value)
 * @property-read Collection<int, ApiService> $apiService
 * @property-read int|null $api_service_count
 * @mixin Eloquent
 */
class TokenType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function apiService(): HasManyThrough
    {
        return $this->hasManyThrough(
            ApiService::class,
            ApiServiceTokenType::class,
            'token_type_id',
            'id',
            'id',
            'api_service_id',
        );
    }
}
