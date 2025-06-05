<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property $id
 * @property $user_id
 * @property $product_id
 * @property $order_id
 * @property $status
 *
 * @property-read Product $product
 */
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'status',
    ];

    /**
     * Get product
     *
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
