<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * @property mixed order_id
 * @property mixed product_id
 * @property mixed price
 * @property mixed qty
 * @property mixed total
 * @package App\Models
 */
class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'qty', 'total'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
