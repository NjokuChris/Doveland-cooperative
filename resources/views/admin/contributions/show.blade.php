
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
