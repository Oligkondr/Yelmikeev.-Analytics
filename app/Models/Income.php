<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $income_id
 * @property string|null $number
 * @property Carbon|null $date
 * @property Carbon|null $last_change_date
 * @property string|null $supplier_article
 * @property string|null $tech_size
 * @property int|null $barcode
 * @property int|null $quantity
 * @property string|null $total_price
 * @property Carbon|null $date_close
 * @property string|null $warehouse_name
 * @property int|null $nm_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Income newModelQuery()
 * @method static Builder<static>|Income newQuery()
 * @method static Builder<static>|Income query()
 * @method static Builder<static>|Income whereBarcode($value)
 * @method static Builder<static>|Income whereCreatedAt($value)
 * @method static Builder<static>|Income whereDate($value)
 * @method static Builder<static>|Income whereDateClose($value)
 * @method static Builder<static>|Income whereId($value)
 * @method static Builder<static>|Income whereIncomeId($value)
 * @method static Builder<static>|Income whereLastChangeDate($value)
 * @method static Builder<static>|Income whereNmId($value)
 * @method static Builder<static>|Income whereNumber($value)
 * @method static Builder<static>|Income whereQuantity($value)
 * @method static Builder<static>|Income whereSupplierArticle($value)
 * @method static Builder<static>|Income whereTechSize($value)
 * @method static Builder<static>|Income whereTotalPrice($value)
 * @method static Builder<static>|Income whereUpdatedAt($value)
 * @method static Builder<static>|Income whereWarehouseName($value)
 * @mixin Eloquent
 */
class Income extends Model
{
    protected $fillable = [
        'income_id',
        'number',
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'barcode',
        'quantity',
        'total_price',
        'date_close',
        'warehouse_name',
        'nm_id',
    ];

    protected $casts = [
        'date' => 'date',
        'last_change_date' => 'date',
        'date_close' => 'date',
    ];
}
