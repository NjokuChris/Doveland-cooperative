@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Create Customer</li>
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
                    <h3 class="card-title">Customer registration Form</h3>
                </div>
                <form method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Customer Name </label>
                                    <input type="text" class="form-control" name="customer_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">phone Number</label>
                                    <input type="text" class="form-control" name="phone_no">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email Address </label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Location</label>
                                    <select class="form-control select2" id="state_id" style="width: 100%;" name="state_id">
                                        <option value="">Select Location</option>
                                        @foreach ($states as $s)
                                            <option value="{{$s->id}}">{{$s->st_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Address.</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Address..." name="address"></textarea>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p class="bmd-label-floating">Status</p>
                                    <input type="radio" id="html" name="status" value="Active">
                                    <label for="html" class="bmd-label-floating">Active</label>
                                    <input type="radio" id="css" name="status" value="In-Active">
                                    <label for="css" class="bmd-label-floating">In-Active</label>
                                </div>

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
