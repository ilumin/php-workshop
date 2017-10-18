<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed        total
 * @property mixed        status
 */
class ShoppingCart extends Model
{
    protected $fillable = ['total', 'status'];

    public function items()
    {
        return $this->hasMany('App\Models\ShoppingCartItem');
    }
}
