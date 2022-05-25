@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cooperative Cash Receipts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item">Cash Receipts</li>
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
                    <h3 class="card-title">Cash Receipts Form</h3>
                </div>
                <form onsubmit="return confirm('Click OK Submit Record to Database');" method="post" action="{{ route('receipt.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="card-body">

                        <div class="row">
                            <div>
                                <div class="col-md-5">
                                    <div class="input-field form-group">
                                        <label class="bmd-label-floating">Customer Name</label>
                                        <input type="text" id="autocomplete-input" class="autocomplete">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-2">
                                    <div class="">
                                        <label class="">code</label>
                                        <input type="text" readonly id="customer_id" name='customer_id'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Amount Paid</label>
                                    <input type="text" class="form-control"  name="amount_paid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Paid By</label>
                                    <input type="text" class="form-control"  name="paid_by">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Method of Payment</label>
                                    <select class="form-control select2" id="pay_method" style="width: 100%;" name="method_pay">
                                        <option value="">Select Method of Payment</option>
                                        @foreach ($pay_method as $p)
                                            <option value="{{$p->id}}">{{$p->pay_method}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Receiving Account</label>
                                    <select class="form-control select2" style="width: 100%;" id="accounts" name="account_no">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Receipts Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Receipts Description..." name="naration"></textarea>
                                </div>
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

@push('scripts')
<script src="{{ asset('js/Autocomplete.js') }}"></script>
<script type=text/javascript>

        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: "{{ url('findCustomers') }}",
                success: function(response) {
                    //console.log(response);
                    var MembArray = response;
                    var dataMemb = {};
                    var dataMemb2 = {};
                    for (var i = 0; i < MembArray.length; i++) {
                        dataMemb[MembArray[i].subaccount_name] = null;
                        dataMemb2[MembArray[i].subaccount_name] = MembArray[i];
                    }
                    //console.log("dataMemb2");
                    //console.log(dataMemb2);
                    $('input#autocomplete-input').autocomplete({
                        data: dataMemb,
                        onAutocomplete: function(reqdata) {
                      //      console.log(reqdata);
                            $('#customer_id').val(dataMemb2[reqdata]['id']);

                        }
                    });
                }
            })
        });


    $('#pay_method').change(function(){
    var pay_methodID = $(this).val();
    if(pay_methodID){
      $.ajax({
        type:"GET",
        url:"{{url('getAccounts')}}?pay_method_id="+pay_methodID,
        success:function(res){
        if(res){
          $("#accounts").empty();
          $("#accounts").append('<option>Select Account</option>');
          $.each(res,function(key,value){
            $("#accounts").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
          $("#accounts").empty();
        }
        }
      });
    }else{
      $("#accounts").empty();
    }
    });

  </script>
@endpush
