@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="pull-left">Order List</h4>
                    </div>
                    <div class="panel-body">

                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                            <tr>
                                <th class="col-sm-1">ID</th>
                                <th>Detail</th>
                                <th class="col-sm-2">User</th>
                                <th class="col-sm-1">Total</th>
                                <th class="col-sm-1">Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <ul class="list-group">
                                            @foreach($order->items as $item)
                                            <li class="list-group-item clearfix">
                                                <a href="{{ url('/product/' . $item->product->id) }}">{{ $item->product->name }}</a>
                                                <label class="btn btn-default btn-sm pull-right">total: {{ $item->total }}</label>
                                                <label class="btn btn-default btn-sm pull-right">qty: {{ $item->qty }}</label>
                                                <label class="btn btn-default btn-sm pull-right">price: {{ $item->price }}</label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $orders->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
