@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Members Registration</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item">Register Members</li>
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
                <h3 class="card-title">Member registration Form</h3>
            </div>

            <form onsubmit="return confirm('Click OK Submit Record to Database');" method="post" action="{{route('members.store')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- SELECT2 EXAMPLE -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1">
                            <div style="position: relative; cursor: pointer; text-align: center;">
                                <div style="width: 106px; height: 106px;
                                              background-color: #999999;
                                              border: 4px solid #CCCCCC;
                                              color: #FFFFFF;
                                              border-radius: 50%;
                                              margin: 5px auto;
                                              overflow: hidden;
                                              transition: all 0.2s;">
                                    <img src="{{ asset('img/default-avatar.png') }}" style="width: 100%;" id="wizardPicturePreview" title="" />
                                    <input type="file" name="photo" id="wizard-picture" style="cursor: pointer;
                                                    display: block;
                                                    height: 100%;
                                                    left: 0;
                                                    opacity: 0 !important;
                                                    position: absolute;
                                                    top: 0;
                                                    width: 100%;">
                                </div>
                                <h6>Choose Picture</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <select class="form-control select2" name="title" style="width: 100%;">
                                    <option value="">Select Title</option>
                                    @foreach ($title as $t)
                                        <option value="{{$t->title}}">{{$t->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    <!--    <div class="col-md-3">
                            <div class="form-group">
                                <label class="bmd-label-floating">Members No:</label>
                                <input type="text" class="form-control" name="member_no" required>
                            </div>
                        </div>-->

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Fist Name</label>
                                <input type="text" class="form-control" name="firstName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Sur Name</label>
                                <input type="text" class="form-control" name="surName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Other Names</label>
                                <input type="text" class="form-control" name="middleName">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control select2" style="width: 100%;" required name="company_id">
                                    <option value="">Select Company</option>
                                    @foreach ($company as $c)
                                        <option value="{{$c->company_id}}">{{$c->company_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">employee No.</label>
                                <input type="text" class="form-control" name="employee_no">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Saving Amount</label>
                                <input type="text" class="form-control" name="savings_amount">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Location:</label>
                                <select class="form-control select2" name="Location">
                                    <option value="">Select Branch</option>
                                    @foreach ($branch as $b)
                                        <option value="{{$b->id}}">{{$b->branch}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone Number </label>
                                <input type="text" class="form-control" name="phoneNo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email address</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Location</label>
                                <input type="text" class="form-control" name="Home_location">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender:</label>
                                <select class="form-control select2" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Date of Birth:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="date_birth" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Address.</label>
                                <textarea class="form-control" rows="3" placeholder="Enter Address..." name="H_address"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Date Joined:</label>
                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                <input type="text" name="joined_date" class="form-control datetimepicker-input" required data-target="#reservationdate1" />
                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bank:</label>
                                <select class="form-control select2" name="BankID">
                                    <option value="">Select Bank</option>
                                    @foreach ($bank as $b)
                                        <option value="{{$b->id}}">{{$b->account_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Account Number</label>
                                <input type="text" class="form-control" name="BankAcc_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="bmd-label-floating">Referees Name</label>
                            <input type="text" class="form-control" name="referee">

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" onclick="callsweetalert(e);" class="btn btn-info" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
