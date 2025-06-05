<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id
 * @property $name
 * @property $description
 *
 * @property-read Product[] $products
 */
class Category extends Model
{
    public $timestamps = false;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get products
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
