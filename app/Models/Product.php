<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed        name
 * @property mixed        detail
 * @property mixed        price
 * @property false|string thumbnail
 */
class Product extends Model
{
    protected $fillable = ['name', 'price', 'detail', 'thumbnail'];
}
