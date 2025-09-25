<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon|null $date
 * @property Carbon|null $last_change_date
 * @property string|null $supplier_article
 * @property string|null $tech_size
 * @property int|null $barcode
 * @property int|null $quantity
 * @property bool|null $is_supply
 * @property bool|null $is_realization
 * @property int|null $quantity_full
 * @property string|null $warehouse_name
 * @property int|null $in_way_to_client
 * @property int|null $in_way_from_client
 * @property int|null $nm_id
 * @property string|null $subject
 * @property string|null $category
 * @property string|null $brand
 * @property int|null $sc_code
 * @property string|null $price
 * @property string|null $discount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Stock newModelQuery()
 * @method static Builder<static>|Stock newQuery()
 * @method static Builder<static>|Stock query()
 * @method static Builder<static>|Stock whereBarcode($value)
 * @method static Builder<static>|Stock whereBrand($value)
 * @method static Builder<static>|Stock whereCategory($value)
 * @method static Builder<static>|Stock whereCreatedAt($value)
 * @method static Builder<static>|Stock whereDate($value)
 * @method static Builder<static>|Stock whereDiscount($value)
 * @method static Builder<static>|Stock whereId($value)
 * @method static Builder<static>|Stock whereInWayFromClient($value)
 * @method static Builder<static>|Stock whereInWayToClient($value)
 * @method static Builder<static>|Stock whereIsRealization($value)
 * @method static Builder<static>|Stock whereIsSupply($value)
 * @method static Builder<static>|Stock whereLastChangeDate($value)
 * @method static Builder<static>|Stock whereNmId($value)
 * @method static Builder<static>|Stock wherePrice($value)
 * @method static Builder<static>|Stock whereQuantity($value)
 * @method static Builder<static>|Stock whereQuantityFull($value)
 * @method static Builder<static>|Stock whereScCode($value)
 * @method static Builder<static>|Stock whereSubject($value)
 * @method static Builder<static>|Stock whereSupplierArticle($value)
 * @method static Builder<static>|Stock whereTechSize($value)
 * @method static Builder<static>|Stock whereUpdatedAt($value)
 * @method static Builder<static>|Stock whereWarehouseName($value)
 * @property int $account_id
 * @method static Builder<static>|Stock whereAccountId($value)
 * @mixin Eloquent
 */
class Stock extends Model
{
    protected $fillable = [
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'barcode',
        'quantity',
        'is_supply',
        'is_realization',
        'quantity_full',
        'warehouse_name',
        'in_way_to_client',
        'in_way_from_client',
        'nm_id',
        'subject',
        'category',
        'brand',
        'sc_code',
        'price',
        'discount',
        'account_id',
    ];

    protected $casts = [
        'date' => 'date',
        'last_change_date' => 'date',
        'is_supply' => 'boolean',
        'is_realization' => 'boolean',
    ];
}
