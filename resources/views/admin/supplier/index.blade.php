@extends('layouts.admin')

@section('content')

   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Companies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
              <li class="breadcrumb-item">Companies</li>
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
                <a href="{{route('company.create')}}" class="btn btn-primary">Create New Company</a>
                </p>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Member ID</th>
                        <th>Company Name</th>
                        <th>Company Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach($companies as $c)
                    <tr>
                        <td>{{$c->company_id}}</td>
                        <td>{{$c->company_name}}</td>
                        <td>{{$c->company_code}}</td>
                        <td>{{$c->status}}</td>
                        <td><a href="{{route('company.edit',$c->company_id) }}" class="btn btn-info">Edit</a>  <a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </section>
    @endsection
