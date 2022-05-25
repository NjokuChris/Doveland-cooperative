@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Loan Application Records</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">

                            <tr>
                              <th>Loans ID:</th>
                              <td>{{$loans->loans_id}}</td>
                              <th>Loans Date:</th>
                              <td>{{$loans->created_at}}</td>
                            </tr>
                            <tr>
                              <th>Member Name</th>
                              <td>{{$loans->members->member_name}}</td>
                              <th>Tenor</th>
                              <td>{{$loans->tenor}}</td>
                            </tr>
                            <tr>
                              <th>Loan Amount:</th>
                              <td>{{number_format($loans->loanamount)}}</td>
                              <th>Margin:</th>
                              <td>{{$loans->interest_rate}}</td>
                            </tr>
                            <tr>

                              <th>Margin Amount:</th>
                              <td>{{number_format($loans->interestamount)}}</td>
                              <th>Total Amount Payable:</th>
                              <td>{{number_format($loans->total_payable_amount)}}</td>
                            </tr>

                      </table>
                    </div>
                    <!-- /.card-body -->

                  </div>
                  <!-- /.card -->
            </div>
            <div class="col-md-7">
              <div class="card mb-4">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Loan Approval Form</h3>
                    </div>
                    <form method="post" action="{{ route('loanapprovalbin.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="text" class="form-control" readonly name="loans_id" value="{{$loans->loans_id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Approval Date </label>
                                <input type="text" class="form-control" readonly name="approval_date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Approving Officer</label>
                                <input type="text" readonly class="form-control" name="approval_name" value="{{Auth::user()->name}}">
                                <input type="hidden" class="form-control" name="approve_by" value="{{Auth::user()->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <p class="bmd-label-floating">Action</p>
                                @foreach ($approval_type as $p)
                                <input type="radio" id="html" name="approve_id" value="{{$p->id}}">
                                <label for="html" class="bmd-label-floating">{{$p->approve_type}}</label>
                            @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Comment.</label>
                                <textarea class="form-control" rows="3" placeholder="Enter Comment..." name="comments"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Submit">
                    </div>

                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
@endsection
