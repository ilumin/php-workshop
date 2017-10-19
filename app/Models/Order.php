<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @property mixed       user_id
 * @property mixed       shopping_cart_id
 * @property mixed       total
 * @package App\Models
 */
class Order extends Model
{
    protected $fillable = ['user_id', 'shopping_cart_id', 'total'];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shoppingCart()
    {
        return $this->belongsTo('App\Models\ShoppingCart');
    }
}
