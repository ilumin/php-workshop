{{-- location: resources/views/admin/product/list.blade.php --}}

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Product List</div>
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
                                <tr>
                                    <td>id</td>
                                    <td>thumbnail</td>
                                    <td>name</td>
                                    <td>price</td>
                                    <td>
                                        <a href="#" class="btn btn-warning">Edit</a>
                                        <form action="#" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
