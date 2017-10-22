{{-- location: resources/views/shop/show-product.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active">{{ $product->name }}</li>
        </ol>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="thumbnail">
                    <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <h2 class="panel-heading">{{ $product->name }}</h2>
                    <div class="panel-body">
                        <h4>Price: {{ $product->price }} THB</h4>
                        <form action="{{ url('/cart/add-item') }}" method="post">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <select class="form-control" name="qty">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Detail</div>
                    <div class="panel-body">{{ $product->detail }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
