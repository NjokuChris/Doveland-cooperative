@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Member Termination</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Member Termination</li>
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
                    <h3 class="card-title">Member Termination Form</h3>
                </div>
                <form method="post" action="{{ route('member_terminate.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Member's Name </label>
                                    <input type="text" class="form-control" name="member_name" value="{{$member->member_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Member No.</label>
                                    <input type="text" class="form-control" name="member_id" value="{{$member->member_id}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Reason.</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Reason..." name="reason"></textarea>
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
