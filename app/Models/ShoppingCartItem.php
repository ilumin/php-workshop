<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed        shopping_cart_id
 * @property mixed        product_id
 * @property mixed        price
 * @property mixed        qty
 * @property mixed        total
 */
class ShoppingCartItem extends Model
{
    protected $fillable = ['shopping_cart_id', 'product_id', 'price', 'qty', 'total'];

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }
}
