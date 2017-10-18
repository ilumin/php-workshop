{{-- location: resources/views/admin/product/form.blade.php --}}

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="pull-left">Product Form</h4>
                    </div>
                    <div class="panel-body">

                        <form action="@isset($product){{ url('/admin/product/' . $product->id) }}@else{{ url('/admin/product') }}@endisset" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="product-name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" id="product-name" placeholder="Name" name="name" value="@isset($product){{ $product->name }}@endisset">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product-price" class="col-sm-2 col-form-label col-form-label-lg">Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" id="product-price" placeholder="Price" name="price" value="@isset($product){{ $product->price }}@endisset">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product-detail" class="col-sm-2 col-form-label col-form-label-lg">Detail</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control form-control-lg" id="product-detail" placeholder="Detail" name="detail" rows="8" cols="80">@isset($product){{ $product->detail }}@endisset</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product-thumbnail" class="col-sm-2 col-form-label col-form-label-lg">Thumbnail</label>
                                <div class="col-sm-10">
                                    <input type="file" id="product-thumbnail" name="thumbnail">
                                    @isset($product)
                                        <img src="{{ Storage::url($product->thumbnail) }}" class="img-responsive img-thumbnail">
                                    @endisset
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">@isset($product) Update @else Save @endisset</button>
                                    <a href="{{ url('/admin/product') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
