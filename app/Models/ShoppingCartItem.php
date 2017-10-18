<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed        name
 * @property mixed        detail
 * @property mixed        price
 * @property false|string thumbnail
 */
class ShoppingCartItem extends Model
{
    protected $fillable = ['shopping_cart_id', 'product_id', 'price', 'qty', 'total'];

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }
}
