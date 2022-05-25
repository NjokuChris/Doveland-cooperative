@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Adjust Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item">Adjust Product Record</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Product Adjustment Form</h3>
            </div>
            <form method="post" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method('PUT')
                <!-- SELECT2 EXAMPLE -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Product Name </label>
                                <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Product Code</label>
                                <input type="text" class="form-control" name="product_code" value="{{$product->product_code}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Product Category </label>
                                <select class="form-control select2" name="category">
                                    <option value="">Select Category</option>
                                    @foreach ($prod_category as $p)
                                    <option value="{{ $p->id }}"
                                        @if($p->id == $product->category_id)
                            selected
                            @endif>{{ $p->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bmd-label-floating">Cost Price</label>
                                <input type="number" min="0" class="form-control" name="rate" value="{{$product->rate}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bmd-label-floating">Selling Price</label>
                                <input type="number" min="0" required class="form-control" name="price" value="{{$product->price}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Description.</label>
                                <input type="text"  class="form-control" name="descp" value="{{$product->descp}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="padding: 15px;">

                            <img height="100" width="100" src="/productimage/{{$product->image}}">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Change Image</label>
                                <input type="file" name="file">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>


                </div>


            </form>
        </div>


    </div>
</section>
@endsection
