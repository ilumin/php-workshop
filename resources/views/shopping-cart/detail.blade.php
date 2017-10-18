{{-- location: resources/views/shopping-cart/detail.blade.php --}}

@extends('layouts.app')

@section('content')

    <div class="container">

        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active">Shopping Cart</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="pull-left">Shopping Cart</h4>
                    </div>
                    <div class="panel-body">

                        @if(count($shoppingCart->items) > 0)
                            <table class="table table-hover table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th class="col-sm-2">Thumbnail</th>
                                    <th>Product Name</th>
                                    <th class="col-sm-1">Price</th>
                                    <th class="col-sm-1">Qty</th>
                                    <th class="col-sm-1">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shoppingCart->items as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ Storage::url($item->product->thumbnail) }}" class="img-thumbnail img-responsive">
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td>{{ $shoppingCart->total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <form action="{{ url('/cart/checkout') }}" method="post" class="clearfix">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary pull-right">Checkout</button>
                                        </form>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="text-center">no item in shopping cart</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
