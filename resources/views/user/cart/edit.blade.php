@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Adjust Cart</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item">Adjust Cart Record</li>
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
                <h3 class="card-title">Cart Adjustment Form</h3>
            </div>
            <form method="post" action="{{route('user.cart.update', $cart->id)}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method('PUT')
                <!-- SELECT2 EXAMPLE -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Product Name </label>
                                <input type="text" class="form-control" readonly name="product_name" value="{{$cart->product_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Quantity</label>
                                <input type="text" class="form-control" name="quantity" value="{{$cart->quantity}}">
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
