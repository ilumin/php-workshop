<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function listProduct(Request $request)
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(8);
        return view('shop.list-product', [
            'products' => $products
        ]);
    }
}
