@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cash Withdrawer Adjustment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Cash Withdrawer Adjustment</li>
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
                    <h3 class="card-title">Cash Withdrawer Adjustment Form</h3>
                </div>
                <div id="error"></div>
                <form method="POST" action="{{route('withdrawers.update', $withdrawer->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Withdrawer ID</label>
                                    <input type="text" readonly value="{{$withdrawer->withdrawer_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="col-md-5">
                                    <div class="input-field form-group">
                                        <label class="bmd-label-floating">Members Name</label>
                                        <input type="text" id="autocomplete-input" readonly value="{{$withdrawer->members->member_name}}" class="autocomplete">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-2">
                                    <div class="">
                                        <label class="">code</label>
                                        <input type="text" readonly id="member_id" value="{{$withdrawer->member_id}}" required name="member_id">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Current Balance</label>
                                    <input type="text" name="current_balance" required readonly value="{{$withdrawer->members->current_balance}}" class="form-control" id="current_balance_id" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Withdrawer Amount</label>
                                    <input type="text" name="amount" required class="form-control" value="{{$withdrawer->amount}}" id="amount_id" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Withdrawer Date:</label>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text" required name="withdrawer_date" class="form-control datetimepicker-input" value="{{$withdrawer->withdrawer_date}}" data-target="#reservationdate1" />
                                    <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Bank Name</label>
                                    <input type="text" name="bank_name" required value="{{$withdrawer->bank_name}}" class="form-control"  value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Account Number</label>
                                    <input type="text" name="acc_no" required  class="form-control"  value="{{$withdrawer->acc_no}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Narration.</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Naration..." name="naration">{{$withdrawer->naration}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/Autocomplete.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script>
    // Wait for the DOM to be ready

    jQuery(document).ready(function ($) {

$.validator.addMethod('le', function (value, element, param) {
    return this.optional(element) || parseInt(value) <= parseInt($(param).val());
}, 'Invalid value');


$('#bid_form_id').validate({
    errorElement: "small",
    rules: {
        current_balance: {
            required: true,
            number: true

        },
        amount: {
            required: true,
            number: true,
            le: '#current_balance_id'
        }
    },
    messages: {
        amount: {
            le: '<span style="background-color:red;color:white;padding:2%;">Withdrawal Amount Must be less than Current Balance.</span>'
        }
    }
});

$('[name="current_balance"]').on('change blur keyup', function() {
    $('[name="amount"]').valid();
});

});

</script>


    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: "{{ url('findMembers') }}",
                success: function(response) {
                  //  console.log(response);
                    var MembArray = response;
                    var dataMemb = {};
                    var dataMemb2 = {};
                    for (var i = 0; i < MembArray.length; i++) {
                        dataMemb[MembArray[i].member_name] = null;
                        dataMemb2[MembArray[i].member_name] = MembArray[i];
                    }
                   // console.log("dataMemb2");
                   // console.log(dataMemb2);
                    $('input#autocomplete-input').autocomplete({
                        data: dataMemb,
                        onAutocomplete: function(reqdata) {
                           // console.log(reqdata);
                            var balance =parseInt(dataMemb2[reqdata]['current_balance']);
                           // console.log(balance);
                            $('#member_id').val(dataMemb2[reqdata]['member_id']);
                            $('#current_balance_id').val(balance);
                        }
                    });
                }
            })
        });
    </script>

@endpush
