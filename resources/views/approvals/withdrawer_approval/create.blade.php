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
            <div class="col-md-6 mb-5">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Cash Withdrawer Records</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">

                            <tr>
                              <th>Withdrawer ID:</th>
                              <td>{{$withdrawer->withdrawer_id}}</td>
                              <th>Withdrawer Date:</th>
                              <td>{{$withdrawer->withdrawer_date}}</td>
                            </tr>
                            <tr>
                              <th>Member Name</th>
                              <td>{{$withdrawer->members->member_name}}</td>
                              <th>Withdrawer Amount:</th>
                              <td>&#8358;{{number_format($withdrawer->amount)}}</td>
                            </tr>

                            <tr>
                              <th>Naration:</th>
                              <td colspan="3">{{$withdrawer->naration}}</td>
                            </tr>

                      </table>
                    </div>
                    <!-- /.card-body -->

                  </div>
                  <!-- /.card -->
            </div>
            <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Withdrawer Approval Form</h3>
                    </div>
                    <form method="post" action="{{ route('withdrawerapproval.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="text" class="form-control" readonly name="withdrawer_id" value="{{$withdrawer->withdrawer_id}}">
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
                    <div class="row">
                        <div class="col-5">
                          <!-- /.card -->
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">PENDING WITHDRAWER APPLICATIONS</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                      <th>WITHDRAWER ID</th>
                                      <th>Approved By</th>
                                      <th>Approved Stage</th>
                                      <th>Approved Date</th>
                                      <th>Approve Type</th>
                                      <th>Comment</th>
                                      <th>Current level</th>

                                  </tr>
                                </thead>
                                <tbody>

                              {{--    @foreach($withdrawer as $l)
                                  <tr>
                                      <td>{{$l->id}}</td>
                                      <td>
                                          @if ($l->members != null)
                                          {{ $l->members->member_name }}

                                          @else

                                          {{"Record Not Found"}}

                                          @endif

                                      </td>
                                      <td>{{$l->created_at}}</td>
                                      <td>&#8358;{{ number_format($l->amount) }}</td>

                                      <td>&#8358;{{number_format($l->members->current_balance)}}</td>
                                      <td>
                                          @if($l->posted_by != null)
                                          {{ $l->postedby->name }}</td>
                                          @endif

                                  </tr>
                                  @endforeach --}}
                                </tbody>
                                <tfoot>
                                </tfoot>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.col -->
                      </div>

                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
@endsection
