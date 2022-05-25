@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Approval Stages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Create Approval Stages</li>
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
                    <h3 class="card-title">Approval Stage Creation Form</h3>
                </div>
                <form method="post" action="{{ route('approval_master.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approve Description</label>
                                    <input type="text" class="form-control" name="approve_desc">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approval Type</label>
                                    <select class="form-control select2" name="approval_type_id">
                                        <option value="">Select Approve Type</option>
                                        @foreach ($approval_type as $p)
                                            <option value="{{$p->id}}">{{$p->approve_type}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approval Approval Stage</label>
                                    <select class="form-control select2" name="approval_stage_id">
                                        <option value="">Select Approval Type</option>
                                        @foreach ($approval_stage as $p)
                                            <option value="{{$p->id}}">{{$p->approval_stage}}</option>

                                        @endforeach
                                    </select>
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
