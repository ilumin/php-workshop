{{-- location: resources/views/shop/show-product.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">name</li>
        </ol>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="thumbnail">
                    <img src="thumbnail" alt="name">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <h2 class="panel-heading">name</h2>
                    <div class="panel-body">
                        Price: price
                        <form action="#" method="post">
                            <div class="input-group">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Detail</div>
                    <div class="panel-body">detail</div>
                </div>
            </div>
        </div>
    </div>
@endsection
