@extends('layouts.admin')

@section('content')

   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
              <li class="breadcrumb-item">Customers</li>
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
                <a href="{{route('customer.create')}}" class="btn btn-primary">Create New Customer</a>
                </p>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Member ID</th>
                        <th>Customer Name</th>
                        <th>Customer Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach($customer as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->customer_name}}</td>
                        <td>{{$c->customer_code}}</td>
                        <td>{{$c->status}}</td>
                        <td><a href="{{route('customer.edit',$c->id) }}" class="btn btn-info">Edit</a>  <a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </section>
    @endsection
