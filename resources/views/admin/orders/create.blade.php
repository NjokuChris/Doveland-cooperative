@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cooperative Commodity Sales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                    <li class="breadcrumb-item">Commodity Sales</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Commodidities Sales Form</h3>
            </div>
            <form action="{{ route("orders.store") }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Customer Name </label>
                            <input type="text" class="form-control" name="customer_name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="bmd-label-floating">Customer Code</label>
                            <input type="text" class="form-control" name="company_code">
                        </div>
                    </div>
                </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> # </th>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Total </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td class="input-field form-group"><input type="text" name="products[]"  placeholder="Enter Product Name" class="autocomplete form-control"/></td>
            <td><input type="number" name="quantities[]" placeholder="Enter Qty" class="form-control qty" step="0" min="0"/></td>
            <td><input type="number" name="price[]" placeholder="Enter Unit Price" id="price" class="form-control price" step="0.00" min="0"/></td>
            <td><input type="number" name="total[]" placeholder="0.00" class="form-control total" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-outline-primary pull-left">Add Row</button>
      <button id='delete_row' class="pull-right btn btn-outline-warning">Delete Row</button>
    </div>
  </div>
  <div class="row clearfix" style="margin-top:20px">
    <div class="pull-right col-md-4">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <th class="text-center">Sub Total</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Tax</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="tax" placeholder="0">
                <div class="input-group-addon">%</div>
              </div></td>
          </tr>
          <tr>
            <th class="text-center">Tax Amount</th>
            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div>
    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
</div>
</form>
</div>


</div>
</section>
@endsection

@push('scripts')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
<script src="{{ asset('js/Autocomplete.js') }}"></script>
<script>
    $(document).ready(function() {
        var i = 1;
        $("#add_row").click(function(e) {
            e.preventDefault();
            var clone_row = $('#tab_logic tbody tr:last-child').clone();
            $('#tab_logic tbody').append(clone_row);
            clone_row.children(':nth-child(1)').html( parseInt(clone_row.children(':nth-child(1)').html())+1);
            clone_row.children(':nth-child(2)').children('input').val('');
            clone_row.children(':nth-child(3)').children('input').val('');
            clone_row.children(':nth-child(4)').children('input').val('');
            clone_row.children(':nth-child(5)').children('input').val('');

            clone_row.children(':nth-child(2)').children('input').autocomplete({
                data: window.dataProd,
                onAutocomplete: function(reqdata) {
                   // console.log(reqdata);
                    clone_row.children(':nth-child(4)').children('input').val(window.dataProd2[reqdata]['price']);
                }
            });
        });

        $("#delete_row").click(function(e) {
            e.preventDefault();
            $('#tab_logic tbody tr:last-child').remove();
            calc();
        });

        $('#tab_logic tbody').on('keyup change', function() {
            calc();
        });
        $('#tax').on('keyup change', function() {
            calc_total();
        });


    });

    function calc() {
        $('#tab_logic tbody tr').each(function(i, element) {
            var html = $(this).html();
            if (html != '') {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty * price);

                calc_total();
            }
        });
    }

    function calc_total() {
        total = 0;
        $('.total').each(function() {
            total += parseInt($(this).val());
        });
        $('#sub_total').val(total.toFixed(2));
        tax_sum = total / 100 * $('#tax').val();
        $('#tax_amount').val(tax_sum.toFixed(2));
        $('#total_amount').val((tax_sum + total).toFixed(2));
    }
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            type: 'get',
            url:"{{url('getProduct')}}",
            success: function(response) {
                console.log(response);
                var ProdArray = response;
                var dataProd = {};
                var dataProd2 = {};
                for (var i = 0; i < ProdArray.length; i++) {
                    dataProd[ProdArray[i].product_name] = null;
                    dataProd2[ProdArray[i].product_name] = ProdArray[i];
                }
               // console.log("dataProd2");
              //  console.log(dataProd2);
                window.dataProd =dataProd;
                window.dataProd2 =dataProd2;
                $('input.autocomplete').autocomplete({
                    data: dataProd,
                    onAutocomplete: function(reqdata) {
                        console.log(reqdata);
                        $('#price').val(dataProd2[reqdata]['price']);
                    }
                });
            }
        })
    });
</script>


@endpush


