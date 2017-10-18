<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $name;
    public $price;
    public $detail;
    public $thumbnail;

    protected $fillable = ['name', 'price', 'detail', 'thumbnail'];
}
