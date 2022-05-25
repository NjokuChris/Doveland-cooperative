@extends('layouts.admin')

@section('css')

@endsection


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cooperative Loan Lump Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Loan Lump Payment</li>
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
                    <h3 class="card-title">Loans Lump Payment Form</h3>
                </div>
                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <form method="post" action="{{ route('loans_pay.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="">Loans ID</label>
                                        <input type="text" readonly id="member_id" value="{{$loans->loans_id}}"  class="form-control" required name="loans_id">
                                        <input type="text" readonly id="l_id" value="{{$loans->id}}"  class="form-control" required name="l_id">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Member Name</label>
                                        <input type="text" readonly  class="form-control" value="{{$loans->members->member_name}}" name="member_name">
                                    </div>
                                </div>


                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Loan Type</label>
                                    <input type="text" readonly  class="form-control" value="{{$loans->loans_type->salary_group}}" name="member_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Loan Amount</label>
                                    <input type="text" id="amount" readonly data-type="currency" value="&#8358;{{number_format($loans->total_payable_amount)}}" class="form-control" name="loan_amount" required>
                                    <input type="hidden" readonly id="amount1" name="amount1" required>
                                </div>
                            </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Running Balance</label>
                                        <input type="number" min="0" readonly id="run_balance" value="{{$loans->balance}}" class="form-control" required name="loan_balance">
                                    </div>
                                </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label class="bmd-label-floating"></label>
                                    &nbsp;&nbsp;&nbsp; <label for="html" class="bmd-label-floating">Full Payment</label>
                                    <input type="radio" onclick="javascript:paytype();" value="1" name="paymenttype" id="yesCheck" >
                                    <label for="html" class="bmd-label-floating">Patial Payment</label>
                                    <input type="radio" onclick="javascript:paytype();" name="paymenttype" value="2" id="noCheck"><br>
                                    <div>
                                        <label for="html" class="bmd-label-floating"></label>
                                     {{--    <input type='text' id='yes' name='membership_charges' value="{{$member->membership_charges}}"><br> --}}

                                    </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Amount to Pay</label>
                                    <input type="number" min="0" id="pay_amount" class="form-control" placeholder="100,000" name="amount_pay">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Balance</label>
                                    <input type="number" min="0" id="balance" class="form-control" placeholder="100,000" readonly  name="new_balance">
                                </div>
                            </div>
                        </div>

                        <div id="ifYes">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tenor</label>
                                    <input type="number" min="0" id="tenor" class="form-control" name="tenor">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Monthly Deduction</label>
                                    <input type="number" id="monthly_deduction" class="form-control" name="monthlydeduction" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Payment Start Month</label>
                                    <select class="form-control select2" style="width: 100%;" name="paystartmonth_id">
                                        <option value="">Select Payment Start Month</option>
                                        @foreach ($payrollheaders as $p)
                                            <option value="{{ $p->payroll_id }}">{{ $p->period_description }}</option>
                                        @endforeach
                                   </select>
                                </div>
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
    <script>
        $(document).ready(function() {

            $('#pay_amount').on('keyup change', function() {
                calc_total();
            });

            $('#tenor').on('keyup change', function() {
                calc_total();
            });


            function calc_total() {

                amount = $('#pay_amount').val();
                amount1 =parseFloat(amount.replace(/\D/g, ""));
                tenor = parseInt($('#tenor').val());
                run_balance = parseFloat($('#run_balance').val());
                paidamount = parseFloat($('#pay_amount').val());
                balance = run_balance - paidamount


                console.log(amount1)
                console.log(amount)
                //console.log(paidamount)
                //console.log(parseFloat($('#amount').val().replace(/\D/g, "")))
                console.log(tenor)


               // interest_amount = amount1 / 100 * parseFloat($('#interest_rate').val());
                monthly_deduction = (balance) / tenor
                //total_amount = (interest_amount + amount1)


                $('#monthly_deduction').val(monthly_deduction);
                $('#balance').val(balance);
               // $('#interest_amount').val(interest_amount);
              //  $('#total_amount').val(total_amount);

                //console.log(formatNumber($('#total_amount').val());
               //tax_sum = total / 100 * $('#tax').val();
                //$('#tax_amount').val(tax_sum.toFixed(2));
                //$('#total_amount').val((tax_sum + total).toFixed(2));
            }

        });

       function paytype() {
            var balance = document.getElementById('run_balance').value
    if (document.getElementById('noCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
        document.getElementById('pay_amount').value = '';

    }
    else document.getElementById('ifYes').style.visibility = 'hidden';
    document.getElementById('ifYes').value = "";

    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'hidden';
        document.getElementById('pay_amount').value = balance;
    document.getElementById('ifYes').value = '';
    }


   }
    </script>

@endpush
