<?php

namespace App\Http\Controllers;

use function abort;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function array_filter;
use function count;

class ShoppingCartController extends Controller
{
    private $shoppingCart;

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getShoppingCart($currentUserId)
    {
        $this->shoppingCart = ShoppingCart::where('status', 'pending')->where('user_id', $currentUserId)->with(['items.product'])->first();
        if (!$this->shoppingCart) {
            $this->shoppingCart = new ShoppingCart();
            $this->shoppingCart->user_id = $currentUserId;
            $this->shoppingCart->total = 0;
            $this->shoppingCart->status = 'pending';
            $this->shoppingCart->save();
        }
    }

    private function shoppingCartHasProduct($productId)
    {
        return array_filter($this->shoppingCart->items->toArray(), function ($item) use ($productId) {
            return $item['product_id'] === $productId;
        });
    }

    private function shoppingCartHasItems()
    {
        return count($this->shoppingCart->items) > 0;
    }

    private function updateShoppingCartTotal($total)
    {
        $this->shoppingCart->total = $total;
        $this->shoppingCart->save();
    }

    private function updateShoppingCartItem($item, $qty)
    {
        $item->qty += $qty;
        $item->total = $item->price * $item->qty;
        $item->save();
    }

    private function newShoppingCartItem($productId, $productPrice, $productQty)
    {
        $newItem = new ShoppingCartItem();
        $newItem->shopping_cart_id = $this->shoppingCart->id;
        $newItem->product_id = $productId;
        $newItem->price = $productPrice;
        $newItem->qty = $productQty;
        $newItem->total = $newItem->price * $newItem->qty;
        $newItem->save();
        return $newItem;
    }

    public function addItem(Request $request)
    {
        $currentUserId = Auth::user()->id;
        $productId = (int) $request->get('product_id');
        $productPrice = (float) $request->get('price', 0);
        $productQty = (int) $request->get('qty', 1);

        $this->getShoppingCart($currentUserId);

        if ($this->shoppingCartHasItems()) {
            if ($this->shoppingCartHasProduct($productId)) {
                $totalPrice = 0;
                foreach ($this->shoppingCart->items as $item) {
                    if ($item->product_id === $productId) {
                        $this->updateShoppingCartItem($item, $productQty);
                    }
                    $totalPrice += $item->total;
                }
                $this->updateShoppingCartTotal($totalPrice);
            }
            else {
                $newItem = $this->newShoppingCartItem($productId, $productPrice, $productQty);
                $this->updateShoppingCartTotal($this->shoppingCart->total + $newItem->total);
            }
        }
        else {
            $newItem = $this->newShoppingCartItem($productId, $productPrice, $productQty);
            $this->updateShoppingCartTotal($this->shoppingCart->total + $newItem->total);
        }

        return redirect('/cart');
    }

    public function showDetail(Request $request)
    {
        $currentUserId = Auth::user()->id;
        $this->getShoppingCart($currentUserId);
        return view('shopping-cart.detail', [
            'shoppingCart' => $this->shoppingCart
        ]);
    }

    public function checkout(Request $request)
    {
        $currentUserId = Auth::user()->id;
        $this->getShoppingCart($currentUserId);
        if (!$this->shoppingCartHasItems()) {
            abort('403', 'Cannot checkout empty shopping cart.');
        }

        $this->shoppingCart->status = 'checkout';
        $this->shoppingCart->save();
        return view('shopping-cart.thankyou');
    }
}
