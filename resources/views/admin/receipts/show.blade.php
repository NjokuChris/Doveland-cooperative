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
            <button id="pdf" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
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

                            Media Trust Staff Multipurpose Cooperative Society Ltd.

                        </h2>
                        <div>20 P.O.W Mafemi Crescent, off Solomon Lar Way,</div>
                        <div>Utako District, Abuja.</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">RECEIPTS</div>

                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">receipts ID # {{$receipts->receipts_id}}</h1>
                        <div class="date">Receipts Date: {{$receipts->created_at}}</div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Receipts Records</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                                <tr>
                                    <th>Customer Name</th>
                                    <td colspan="3">{{$receipts->Subaccount->subaccount_name}}</td>
                                </tr>

                                <tr>
                                  <th>Received From</th>
                                  <td colspan="3">{{$receipts->paid_by}}</td>
                                </tr>
                                <tr>
                                  <th>Amount:</th>
                                  <td>{{number_format($receipts->amount_paid)}}</td>
                                  <th>Receiptd By</th>
                                  <td>{{$receipts->Posted_by->name}}</td>
                                </tr>
                                <tr>
                                    <th>Naration</th>
                                    <td colspan="3">{{$receipts->naration}}</td>
                                </tr>
                                <tr>
                                  <td colspan="4">{{$receip->word}} Only</td>
                                </tr>

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
               <!-- Receipts was created on a computer and is valid without the signature and seal.-->
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

        $('#pdf').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
</script>

@endpush


