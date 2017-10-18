<?php

namespace App\Http\Controllers;

use function dump;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function addItem(Request $request)
    {
        dump($request);
    }
}
