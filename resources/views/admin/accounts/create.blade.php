@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Create Account</li>
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
                    <h3 class="card-title">Account Creation Form</h3>
                </div>
                <form method="post" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Account Name </label>
                                    <input type="text" class="form-control" name="account_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Account Code</label>
                                    <input type="text" class="form-control" name="accountcode">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Account Class</label>
                                    <select class="form-control select2" id="acc_class" style="width: 100%;" name="account_class_id">
                                        <option value="">Select Acc Class</option>
                                        @foreach ($account_class as $a)
                                            <option value="{{$a->id}}">{{$a->account_class}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Group</label>
                                    <select class="form-control select2" style="width: 100%;" id="acc_group" name="account_group_id">
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Type</label>
                                <select class="form-control select2" id="acc_type" style="width: 100%;" name="account_type_id">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Transaction Type</label>
                                <select class="form-control select2" id="acc_trans_type" style="width: 100%;" name="acc_trans_type_id">

                                </select>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6">
                            <label class="bmd-label-floating">Status</label>
                            &nbsp;&nbsp;&nbsp; Active <input type="radio" name="status" value="Active" id="yesCheck"> In-Active <input type="radio" value="In-Active" name="status"><br>
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

@push('scripts')
<script>

$('#acc_class').change(function(){
    var acc_classID = $(this).val();
    if(acc_classID){
      $.ajax({
        type:"GET",
        url:"{{url('getAccGroup')}}?account_class_id="+acc_classID,
        success:function(res){
        if(res){
          $("#acc_group").empty();
          $("#acc_group").append('<option>Select Account Group</option>');
          $.each(res,function(key,value){
            $("#acc_group").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#acc_group").empty();
        }
        }
      });
    }else{
      $("#acc_group").empty();
    }
    });

    $('#acc_group').change(function(){
    var acc_groupID = $(this).val();
    if(acc_groupID){
      $.ajax({
        type:"GET",
        url:"{{url('getAccType')}}?account_group_id="+acc_groupID,
        success:function(res){
        if(res){
          $("#acc_type").empty();
          $("#acc_type").append('<option>Select Account Type</option>');
          $.each(res,function(key,value){
            $("#acc_type").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#acc_type").empty();
        }
        }
      });
    }else{
      $("#acc_type").empty();
    }
    });

    $('#acc_type').change(function(){
    var acc_typeID = $(this).val();
    if(acc_typeID){
      $.ajax({
        type:"GET",
        url:"{{url('getAccTransType')}}?account_type_id="+acc_typeID,
        success:function(res){
        if(res){
          $("#acc_trans_type").empty();
          $("#acc_trans_type").append('<option>Select Account Transaction Type</option>');
          $.each(res,function(key,value){
            $("#acc_trans_type").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#acc_trans_type").empty();
        }
        }
      });
    }else{
      $("#acc_trans_type").empty();
    }
    });

    </script>

@endpush
