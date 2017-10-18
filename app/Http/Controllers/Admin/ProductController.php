<?php

namespace App\Http\Controllers\Admin;

use function abort;
use App\Models\Product;
use function dump;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use function redirect;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(8);
        return view('admin.product.list', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product                   $product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $product->name = $request->get('name');
        $product->detail = $request->get('detail');
        $product->price = $request->get('price');
        $thumbnail = $request->file('thumbnail', false);
        if ($thumbnail) {
            $product->thumbnail = $thumbnail->store('thumbnail', 'public');
        }
        $product->save();
        return redirect('/admin/product');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Product not exist.');
        }

        return view('admin.product.form', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     * @internal param Product $product
     *
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Product not exist.');
        }

        $product->name = $request->get('name');
        $product->detail = $request->get('detail');
        $product->price = $request->get('price');
        $thumbnail = $request->file('thumbnail', false);
        if ($thumbnail) {
            if ($product->thumbnail) {
                Storage::delete($product->thumbnail);
            }
            $product->thumbnail = $thumbnail->store('thumbnail', 'public');
        }
        $product->save();
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
