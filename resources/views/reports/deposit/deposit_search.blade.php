@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Search Cash Deposit Report.</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Cash Deposit</li>
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
                    <h3 class="card-title">Cooperative Cash Deposit Report Search Form</h3>
                </div>
                <form method="post" action="{{ route('deposit_report')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @method('GET')
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div>
                                <div class="col-md-5">
                                    <div class="input-field form-group">
                                        <label class="bmd-label-floating">Members Name</label>
                                        <input type="text" id="autocomplete-input" class="autocomplete" name="member_name">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-1">
                                    <div class="">
                                        <label class="">code</label>
                                        <input type="text"  id="member_id"  name="member_no">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label class="">Deposit ID</label>
                                        <input type="text" name="deposit_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Deposit Amount (Greater Than)</label>
                                    <input type="text" class="form-control" name="amount">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Date From</label>
                                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" name="date_from" class="form-control datetimepicker-input" data-target="#reservationdate1" />
                                        <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Date To</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="date_to" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Search Report">
                        </div>


                    </div>


                </form>
            </div>


        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/Autocomplete.js') }}"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                type: 'get',
                url: "{{ url('findMembers') }}",
                success: function(response) {
                   // console.log(response);
                    var MembArray = response;
                    var dataMemb = {};
                    var dataMemb2 = {};
                    for (var i = 0; i < MembArray.length; i++) {
                        dataMemb[MembArray[i].member_name] = null;
                        dataMemb2[MembArray[i].member_name] = MembArray[i];
                    }
                    //console.log("dataMemb2");
                    //console.log(dataMemb2);
                    $('input#autocomplete-input').autocomplete({
                        data: dataMemb,
                        onAutocomplete: function(reqdata) {
                          //  console.log(reqdata);
                            $('#member_id').val(dataMemb2[reqdata]['member_id']);
                        }
                    });
                }
            })
        });
    </script>

@endpush
