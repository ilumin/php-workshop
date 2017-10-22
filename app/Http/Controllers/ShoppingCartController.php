<?php

namespace App\Http\Controllers;

use function abort;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use function array_pull;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function array_filter;
use function count;

class ShoppingCartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem(Request $request)
    {
        $userId = Auth::user()->id;
        $productId = (int) $request->get('product_id');
        $productQty = (int) $request->get('qty', 1);

        // get product
        $product = Product::find($productId);
        if (!$product) {
            abort(404, 'Product not found.');
        }

        // SELECT * FROM shopping_carts WHERE status = 'pending' AND user_id = $userId LIMIT 0, 1
        $shoppingCart = ShoppingCart::where('status', 'pending')
            ->where('user_id', $userId)
            ->first();
        if (!$shoppingCart) {
            $shoppingCart = new ShoppingCart();
            $shoppingCart->user_id = $userId;
            $shoppingCart->total = 0;
            $shoppingCart->status = 'pending';
            $shoppingCart->save();
        }

        // shopping cart has items ?
        $shoppingCartItems = $shoppingCart->items;

        if (count($shoppingCartItems) <= 0) {
            $hasProduct = array_filter($shoppingCartItems->toArray(), function ($item) use ($product) {
                return $item['product_id'] == $product->id;
            });
            if ($hasProduct) {
                $totalPrice = 0;
                foreach ($shoppingCartItems as $item) {
                    if ($item->product_id == $product->id) {
                        // update product qty and total price
                        $item->qty += $productQty;
                        $item->total = $item->price * $item->qty;
                        $item->save();
                    }
                    $totalPrice += $item->total;
                }

                // update shopping cart total price
                $shoppingCart->total = $totalPrice;
                $shoppingCart->save();
            }
            else {
                // create new shopping cart item
                $newItem = new ShoppingCartItem();
                $newItem->shopping_cart_id = $shoppingCart->id;
                $newItem->product_id = $product->id;
                $newItem->price = $product->price;
                $newItem->qty = $productQty;
                $newItem->total = $newItem->price * $newItem->qty;
                $newItem->save();

                // update shopping cart total price
                $shoppingCart->total += $newItem->total;
                $shoppingCart->save();
            }
        }
        else {
            // create new shopping cart item
            $newItem = new ShoppingCartItem();
            $newItem->shopping_cart_id = $shoppingCart->id;
            $newItem->product_id = $product->id;
            $newItem->price = $product->price;
            $newItem->qty = $productQty;
            $newItem->total = $newItem->price * $newItem->qty;
            $newItem->save();

            // update shopping cart total price
            $shoppingCart->total += $newItem->total;
            $shoppingCart->save();
        }

        return redirect('/cart');
    }

    public function showDetail(Request $request)
    {
        $userId = Auth::user()->id;
        $shoppingCart = ShoppingCart::where('status', 'pending')
            ->where('user_id', $userId)
            ->first();
        if (!$shoppingCart) {
            $shoppingCart = new ShoppingCart();
            $shoppingCart->user_id = $userId;
            $shoppingCart->total = 0;
            $shoppingCart->status = 'pending';
            $shoppingCart->save();
        }
        return view('shopping-cart.detail', [
            'shoppingCart' => $shoppingCart
        ]);
    }

    public function checkout(Request $request)
    {
        $userId = Auth::user()->id;
        $shoppingCart = ShoppingCart::where('status', 'pending')
            ->where('user_id', $userId)
            ->first();
        if (!$shoppingCart) {
            abort(403, 'Shopping cart not exists.');
        }

        $shoppingCartItems = $shoppingCart->items;
        if (count($shoppingCartItems) <= 0) {
            abort(403, 'Cannot checkout empty shopping cart.');
        }

        $order = new Order();
        $order->user_id = $shoppingCart->user_id;
        $order->shopping_cart_id = $shoppingCart->id;
        $order->total = $shoppingCart->total;
        $order->save();

        foreach ($shoppingCartItems as $shoppingCartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $shoppingCartItem->product_id;
            $orderItem->price = $shoppingCartItem->price;
            $orderItem->qty = $shoppingCartItem->qty;
            $orderItem->total = $shoppingCartItem->total;
            $orderItem->save();
        }

        $shoppingCart->status = 'checkout';
        $shoppingCart->save();

        return view('shopping-cart.thankyou');
    }
}
