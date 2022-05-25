@extends('layouts.admin')

@section('content')

   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
              <li class="breadcrumb-item">Branch</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <p>
                <a href="{{route('branch.create')}}" class="btn btn-primary">Create New Branch</a>
                </p>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Branch ID</th>
                        <th>Branch Name</th>
                        <th>Branch Code</th>
                        <th>Branch Cordinator</th>
                        <th>Action</th>
                    </tr>

                    @foreach($branch as $b)
                    <tr>
                        <td>{{$b->id}}</td>
                        <td>{{$b->branch}}</td>
                        <td>{{$b->branch_code}}</td>
                        <td>{{$b->cordinator_id}}</td>

                        <td><a href="{{route('branch.edit',$b->id) }}" class="btn btn-info">Edit</a>  <a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </section>
    @endsection
