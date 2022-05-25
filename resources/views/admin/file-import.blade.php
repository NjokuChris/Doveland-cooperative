@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection


@section('content')


<body>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Upload Monthly Contribution
        </h2>

        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Year</label>
                        <select class="form-control select2" required id="year_id" style="width: 100%;" name="year_id">
                            <option value="">Select Year</option>
                            @foreach ($years as $y)
                                <option value="{{$y->id}}">{{$y->year_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Payroll Month</label>
                        <select class="form-control select2" style="width: 100%;" id="month_id" name="month_id">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
        </form>
    </div>
</body>
@endsection
@push('scripts')
<script type=text/javascript>
    $('#year_id').change(function(){
    var yearID = $(this).val();
    if(yearID){
      $.ajax({
        type:"GET",
        url:"{{url('getMonth')}}?year_id="+yearID,
        success:function(res){
        if(res){
          $("#month_id").empty();
          $("#month_id").append('<option>Select Month</option>');
          $.each(res,function(key,value){
            $("#month_id").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#month_id").empty();
        }
        }
      });
    }else{
      $("#month_id").empty();
    }
    });

  </script>
@endpush

