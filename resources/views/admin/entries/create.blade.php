@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cooperative Monthly Processes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Monthly Deductions</li>
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
                    <h3 class="card-title">Cash Receipts Form</h3>
                </div>
                <form method="post" action="{{ route('coop_process.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Year</label>
                                    <select class="form-control select2" id="year_id" style="width: 100%;" name="year_id">
                                        <option value="">Select Year</option>
                                        @foreach ($year as $p)
                                            <option value="{{$p->year_id}}">{{$p->year_description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Payroll Month</label>
                                    <select class="form-control select2" style="width: 100%;" id="payroll_id" name="payroll_id">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                            <label class="bmd-label-floating">Processed Date:  {{  now()}} </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                            <label class="bmd-label-floating">Processed By:  {{ Auth::user()->name }} </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Process">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
<script type=text/javascript>
    $('#year_id').change(function(){
    var yearID = $(this).val();
    if(yearID){
      $.ajax({
        type:"GET",
        url:"{{url('getPayrollMonth')}}?year_id="+yearID,
        success:function(res){
        if(res){
          $("#payroll_id").empty();
          $("#payroll_id").append('<option>Select Payroll Month</option>');
          $.each(res,function(key,value){
            $("#payroll_id").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#payroll_id").empty();
        }
        }
      });
    }else{
      $("#payroll_id").empty();
    }
    });

  </script>
@endpush
