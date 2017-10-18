<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function listProduct(Request $request)
    {
        return view('shop.list-product');
    }
}
