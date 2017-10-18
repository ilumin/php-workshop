{{-- location: resources/views/admin/product/list.blade.php --}}

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="pull-left">Product List</h4>
                        <a href="{{ url('/admin/product/create') }}" class="btn btn-primary pull-right">Add new product</a>
                    </div>
                    <div class="panel-body">

                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                            <tr>
                                <th class="col-sm-1">ID</th>
                                <th class="col-sm-2">Thumbnail</th>
                                <th>Name</th>
                                <th class="col-sm-2">Price</th>
                                <th class="col-sm-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ Storage::url($product->thumbnail) }}" class="img-responsive thumbnail">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{ url('/admin/product/' . $product->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ url('/admin/product/' . $product->id) }}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
