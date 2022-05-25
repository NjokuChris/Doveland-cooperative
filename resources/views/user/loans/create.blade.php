@extends('layouts.admin')

@section('css')

@endsection


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cooperative Loan Application</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Loan Application</li>
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
                    <h3 class="card-title">Loan Application Form</h3>
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
                <form method="post" action="{{ route('user.loans.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Loan Type</label>
                                    <select class="form-control select2" style="width: 100%;" required name="loan_type_id">
                                        <option value="">Select Loans Type</option>
                                        @foreach ($loans_type as $l)
                                            <option value="{{ $l->id }}">{{ $l->loans_type }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Loan Amount</label>
                                    <input type="text" id="amount" data-type="currency" placeholder="NGN1,000,000.00" value="" pattern="^\NGN\d{1,3}(,\d{3})*(\.\d+)?NGN" class="form-control" name="loan_amount" required>
                                    <input type="hidden" readonly id="amount1" name="amount1" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tenor</label>
                                    <input type="number" min="0" id="tenor" class="form-control" required name="tenor">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Intrest</label>
                                    <input type="number" id="interest_rate" value="10" readonly class="form-control" placeholder="%" required name="interest_rate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Monthly Deduction</label>
                                    <input type="number" id="monthly_deduction" class="form-control" name="monthlydeduction" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Intrest Amount</label>
                                    <input type="number" id="interest_amount" class="form-control" name="interestamount" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Payable Amount</label>
                                    <input type="number" id="total_amount" class="form-control" readonly name="total_amount" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Payment Start Month</label>
                                    <select class="form-control select2" required style="width: 100%;" name="paystartperiod_id">
                                        <option value="">Select Payment Start Month</option>
                                        @foreach ($months as $m)
                                            <option value="{{ $m->id }}">{{ $m->month_name }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Approving officer</label>
                                    <select class="form-control select2" required style="width: 100%;" name="first_approver">
                                        <option value="">Select Approving Officer</option>
                                        @foreach ($approving_officer as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Bank Name</label>
                                    <input type="text" class="form-control" required name="bank_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Account Number</label>
                                    <input type="text" class="form-control" required name="acc_no">
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

            $('#amount').on('keyup change', function() {
                $('#amount1').val($('#amount').val().replace(/\D/g, ""));
                calc_total();
            });
            $('#tenor').on('keyup change', function() {
                calc_total();
            });
            $('#interest_rate').on('keyup change', function() {
                calc_total();
            });

            function calc_total() {

                amount = $('#amount').val();
                interest = parseFloat($('#interest_rate').val());
                amount1 =parseFloat(amount.replace(/\D/g, ""));

               // console.log(amount1)
                //console.log(amount)
                //console.log(parseFloat($('#amount').val().replace(/\D/g, "")))
                //console.log(interest_amount)
                //console.log(tenor)
                //console.log(interest)
                tenor = parseInt($('#tenor').val());

                interest_amount = amount1 / 100 * parseFloat($('#interest_rate').val());
                monthly_deduction = (amount1+interest_amount) / tenor
                total_amount = (interest_amount + amount1)


                $('#monthly_deduction').val(monthly_deduction);
                $('#interest_amount').val(interest_amount);
                $('#total_amount').val(total_amount);

                //console.log(formatNumber($('#total_amount').val());
               //tax_sum = total / 100 * $('#tax').val();
                //$('#tax_amount').val(tax_sum.toFixed(2));
                //$('#total_amount').val((tax_sum + total).toFixed(2));
            }
        });
    </script>

@endpush
