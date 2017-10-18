<?php

namespace App\Http\Controllers;

use function abort;
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

    public function showProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Product not found.');
        }

        return view('shop.show-product', [
            'product' => $product
        ]);
    }
}
