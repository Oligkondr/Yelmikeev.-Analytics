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
 * @property string|null $discount_percent
 * @property bool|null $is_supply
 * @property bool|null $is_realization
 * @property string|null $promo_code_discount
 * @property string|null $warehouse_name
 * @property string|null $country_name
 * @property string|null $oblast_okrug_name
 * @property string|null $region_name
 * @property int|null $income_id
 * @property string|null $sale_id
 * @property string|null $odid
 * @property string|null $spp
 * @property string|null $for_pay
 * @property string|null $finished_price
 * @property string|null $price_with_disc
 * @property int|null $nm_id
 * @property string|null $subject
 * @property string|null $category
 * @property string|null $brand
 * @property bool|null $is_storno
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Sale newModelQuery()
 * @method static Builder<static>|Sale newQuery()
 * @method static Builder<static>|Sale query()
 * @method static Builder<static>|Sale whereBarcode($value)
 * @method static Builder<static>|Sale whereBrand($value)
 * @method static Builder<static>|Sale whereCategory($value)
 * @method static Builder<static>|Sale whereCountryName($value)
 * @method static Builder<static>|Sale whereCreatedAt($value)
 * @method static Builder<static>|Sale whereDate($value)
 * @method static Builder<static>|Sale whereDiscountPercent($value)
 * @method static Builder<static>|Sale whereFinishedPrice($value)
 * @method static Builder<static>|Sale whereForPay($value)
 * @method static Builder<static>|Sale whereGNumber($value)
 * @method static Builder<static>|Sale whereId($value)
 * @method static Builder<static>|Sale whereIncomeId($value)
 * @method static Builder<static>|Sale whereIsRealization($value)
 * @method static Builder<static>|Sale whereIsStorno($value)
 * @method static Builder<static>|Sale whereIsSupply($value)
 * @method static Builder<static>|Sale whereLastChangeDate($value)
 * @method static Builder<static>|Sale whereNmId($value)
 * @method static Builder<static>|Sale whereOblastOkrugName($value)
 * @method static Builder<static>|Sale whereOdid($value)
 * @method static Builder<static>|Sale wherePriceWithDisc($value)
 * @method static Builder<static>|Sale wherePromoCodeDiscount($value)
 * @method static Builder<static>|Sale whereRegionName($value)
 * @method static Builder<static>|Sale whereSaleId($value)
 * @method static Builder<static>|Sale whereSpp($value)
 * @method static Builder<static>|Sale whereSubject($value)
 * @method static Builder<static>|Sale whereSupplierArticle($value)
 * @method static Builder<static>|Sale whereTechSize($value)
 * @method static Builder<static>|Sale whereTotalPrice($value)
 * @method static Builder<static>|Sale whereUpdatedAt($value)
 * @method static Builder<static>|Sale whereWarehouseName($value)
 * @property int $account_id
 * @method static Builder<static>|Sale whereAccountId($value)
 * @mixin Eloquent
 */
class Sale extends Model
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
        'is_supply',
        'is_realization',
        'promo_code_discount',
        'warehouse_name',
        'country_name',
        'oblast_okrug_name',
        'region_name',
        'income_id',
        'sale_id',
        'odid',
        'spp',
        'for_pay',
        'finished_price',
        'price_with_disc',
        'nm_id',
        'subject',
        'category',
        'brand',
        'is_storno',
        'account_id',
    ];

    protected $casts = [
        'date' => 'date',
        'last_change_date' => 'date',
        'is_supply' => 'boolean',
        'is_realization' => 'boolean',
        'is_storno' => 'boolean',
    ];
}
