<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(8);
        return view('admin.order.list', [
            'orders' => $orders
        ]);
    }

    public function showDetail($id)
    {

    }
}
