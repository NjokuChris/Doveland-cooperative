@extends('layouts.admin')

@section('css')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

@endsection
@section('content')
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="{{ asset('img/coop_logo.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"
                            data-holder-rendered="true"  width="90"
                            height="100" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                            MTL Cooperative
                            </a>
                        </h2>
                        <div>20 P.W.O Mafemi Crescent, off Solomon Lar Way,</div>
                        <div>Utako District, Abuja.</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">LOAN TO:</div>
                        <h2 class="to">{{$loans->members->member_name}}</h2>
                        <div class="address">796 Silver Harbour, TX 79273, US</div>
                        <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">LOANS ID # {{$loans->loans_id}}</h1>
                        <div class="date">Date of Loan: {{$loans->created_at}}</div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Loan Application Records</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
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
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Loans Approval History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Date Approved</th>
                                <th>Approved By</th>
                                <th>Approval type</th>
                                <th>Comment</th>
                                <th>Current Stage</th>
                                <th>Next Approver</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($approvals as $l)
                                <tr>
                                    <td>{{$l->approval_date}}</td>
                                    <td>{{$l->name}}</td>
                                    <td>{{$l->name}}</td>
                                    <td>{{$l->comments}}</td>
                                    <td>{{$l->approval_stage}}</td>
                                    <td>{{$l->approval_stage}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->

                      </div>
                      <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
            </main>
            <footer>
                Loan was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
@endsection

@push('scripts')

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
     $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
</script>

@endpush


