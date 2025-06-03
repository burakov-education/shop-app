<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $description
 */
class Category extends Model
{
    public $timestamps = false;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];
}
