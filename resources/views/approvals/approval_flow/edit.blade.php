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
                <form method="post" action="{{ route('approval_flow.update', $approval_flow->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approval Process Module</label>
                                    <select class="form-control select2" name="process_module_id" value="{{$approval_flow->process_module_id}}">
                                        <option value="">Select Process Module</option>
                                        @foreach ($process_module as $id => $process_module)
                                            <option value="{{$id}}" {{ ($id == $approval_flow->process_module_id) ? 'selected' : '' }}>{{$process_module}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approval Stage</label>
                                    <select class="form-control select2" name="approval_stage_id" value="{{$approval_flow->approval_stage_id}}">
                                        <option value="">Select Process Stage</option>
                                        @foreach ($approval_stages as $id => $approval_stage)
                                            <option value="{{$id}}" {{($id == $approval_flow->approval_stage_id) ? 'selected' : '' }}>{{$approval_stage}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Process Flow</label>
                                    <select class="form-control select2" name="process_no">
                                        <option value="">Select Process Flow</option>
                                            <option value="1">First Approval</option>
                                            <option value="2">Second Approval</option>
                                            <option value="3">Third Approval</option>
                                            <option value="4">Fourth Approval</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="bmd-label-floating">Status</p>
                                    <input type="radio" id="html" name="active_id" value="1">
                                    <label for="html" class="bmd-label-floating">Active</label>
                                    <input type="radio" id="css" name="active_id" value="0">
                                    <label for="css" class="bmd-label-floating">In-Active</label>
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
