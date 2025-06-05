<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property $id
 * @property $category_id
 * @property $name
 * @property $description
 * @property $price
 * @property $images
 *
 * @property-read $default_image
 *
 * @property-read Category $category
 */
class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Get category
     *
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get default_image attribute
     *
     * @return Attribute
     */
    public function defaultImage(): Attribute
    {
        return Attribute::get(fn () => $this->images[0] ?? null);
    }
}
