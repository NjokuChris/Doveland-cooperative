@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Create Product</li>
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
                    <h3 class="card-title">Product Creation Form</h3>
                </div>
                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Name </label>
                                    <input type="text" class="form-control" required name="product_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Code</label>
                                    <input type="text" class="form-control" name="product_code">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Category </label>
                                    <select class="form-control select2" name="category">
                                        <option value="">Select Category</option>
                                        @foreach ($prod_category as $p)
                                            <option value="{{$p->id}}">{{$p->category}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Cost Price</label>
                                    <input type="number" min="0" class="form-control" name="rate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Selling Price</label>
                                    <input type="number" min="0" required class="form-control" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Description.</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Address..." name="descp"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="file" name="file">
                                </div>
                            </div>
                        </div>


                        <div class="form-group" style="padding-top: 20px">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>


                    </div>


                </form>
            </div>


        </div>
    </section>
@endsection
