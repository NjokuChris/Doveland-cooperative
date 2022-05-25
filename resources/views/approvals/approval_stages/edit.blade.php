@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Adjust Approval Stage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item">Adjust Approval Stage</li>
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
                <h3 class="card-title">Approval Stages Adjustment Form</h3>
            </div>
            <form method="post" action="{{route('approval_stages.update', $approval_stages->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method('PUT')
                <!-- SELECT2 EXAMPLE -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Approval Stages</label>
                                <input type="text" class="form-control" name="approval_stage" value="{{ $approval_stages->approval_stage}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Approval Process Type</label>
                                <select class="form-control select2" style="width: 100%;" name="process_type_id" value="{{$approval_stages->process_type_id}}">
                                    <option value="">Select Approval Process Type</option>
                                    @foreach ($process_type as $id => $process_type)
                                        <option value="{{$id}}"{{($id == $approval_stages->process_type_id) ? 'selected' : ''}}>{{$process_type}}</option>
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
