
@extends('layouts.admin')

@section('content')

   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contributions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
              <li class="breadcrumb-item">Contributions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form method="post" action="{{ route('contributions.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <p>
                    <input type="hidden" class="form-control" name="month_id" value="{{$month_id}}">

                </p>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Save Data">
                </div>
                </form>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Month</th>
                        <th>Amount</th>
                    </tr>

                    @foreach($contribution as $c)
                    <tr>
                        <td>{{$c->member_id}}</td>
                        <td>@if ($c->Members !=null)
                            {{$c->Members->member_name}}
                        @endif</td>
                        <td>@if ($c->months != null)
                            {{$c->months->month_name}}
                        @endif</td>
                        <td>{{$c->amount}}</td>

                    @endforeach

                </table>
            </div>
        </section>
    @endsection
