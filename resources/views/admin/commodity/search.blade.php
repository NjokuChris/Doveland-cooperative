@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Commodity Period</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Create Commodity Perid</li>
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
                    <h3 class="card-title">Commodity Period Creation Form</h3>
                </div>
                <form method="post" action="{{ route('commperiod.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Commodity Period</label>
                                    <select class="form-control js-example-basic-single" style="width: 100%;" name="member_id">
                                        <option value="">Select Period</option>
                                        @foreach ($comm_period as $c)
                                            <option value="{{$c->id}}">{{$c->comm_period}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Users Name</label>
                                    <select class="form-control js-example-basic-single" style="width: 100%;" name="member_id">
                                        <option value="">Select user</option>
                                        @foreach ($users as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-control js-example-basic-single" style="width: 100%;" name="member_id">
                                        <option value="">Select Company</option>
                                        @foreach ($company as $c)
                                            <option value="{{$c->company_id}}">{{$c->company_name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Date From:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="date_birth" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Date TO:</label>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text" name="joined_date" class="form-control datetimepicker-input" required data-target="#reservationdate1" />
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 20px">
                            <input type="submit" class="btn btn-info" value="Submit">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
