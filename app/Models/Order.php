<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $g_number
 * @property Carbon|null $date
 * @property Carbon|null $last_change_date
 * @property string|null $supplier_article
 * @property string|null $tech_size
 * @property int|null $barcode
 * @property string|null $total_price
 * @property int|null $discount_percent
 * @property string|null $warehouse_name
 * @property string|null $oblast
 * @property int|null $income_id
 * @property string|null $odid
 * @property int|null $nm_id
 * @property string|null $subject
 * @property string|null $category
 * @property string|null $brand
 * @property bool|null $is_cancel
 * @property Carbon|null $cancel_dt
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereBarcode($value)
 * @method static Builder<static>|Order whereBrand($value)
 * @method static Builder<static>|Order whereCancelDt($value)
 * @method static Builder<static>|Order whereCategory($value)
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereDate($value)
 * @method static Builder<static>|Order whereDiscountPercent($value)
 * @method static Builder<static>|Order whereGNumber($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereIncomeId($value)
 * @method static Builder<static>|Order whereIsCancel($value)
 * @method static Builder<static>|Order whereLastChangeDate($value)
 * @method static Builder<static>|Order whereNmId($value)
 * @method static Builder<static>|Order whereOblast($value)
 * @method static Builder<static>|Order whereOdid($value)
 * @method static Builder<static>|Order whereSubject($value)
 * @method static Builder<static>|Order whereSupplierArticle($value)
 * @method static Builder<static>|Order whereTechSize($value)
 * @method static Builder<static>|Order whereTotalPrice($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @method static Builder<static>|Order whereWarehouseName($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    protected $fillable = [
        'g_number',
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'barcode',
        'total_price',
        'discount_percent',
        'warehouse_name',
        'oblast',
        'income_id',
        'odid',
        'nm_id',
        'subject',
        'category',
        'brand',
        'is_cancel',
        'cancel_dt',
    ];

    protected $casts = [
        'date' => 'datetime',
        'last_change_date' => 'date',
        'is_cancel' => 'boolean',
        'cancel_dt' => 'datetime',
    ];
}
