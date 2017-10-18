{{-- location: resources/views/shop.list-product.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach($products as $product)
            <div class="col-sm-6 col-md-4">
                <a href="{{ url('/product/' . $product->id) }}" class="thumbnail">
                    <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                    <div class="caption">
                        <h3>{{ $product->name }}</h3>
                     /div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
