@extends('layouts.admin')
@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Statement of Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account Statement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <p>
            <a href="{{route('statement_acc_search')}}" class="btn btn-primary">Back to Search Form.</a>
          </p>
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Account Name:</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table-bordered table-striped compact">
                  <thead>
                    <tr class="group" style="background-color:#00e6e6;">
                        <td colspan="3">Member Name: {{$members->member_name}}</td>
                        <td colspan="4">Current Balance: &#8358;{{number_format($members->current_balance)}}</td>


                    </tr>
                  <tr>
                    <th>Trans Date</th>
                    <th>Reference</th>
                    <th>Value DATE</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                    <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($transaction as $t)
                    <tr>
                        <td>{{$t['transaction_date']}}</td>
                        <td>{{$t['id']}}</td>
                        <td>{{$t['transaction_date']}}</td>
                        <td>{{$t['debit']}}</td>
                        <td>{{$t['credit']}}</td>
                        <td>&#8358;{{number_format($t['balance'])}}</td>
                        <td>
                            {{$t->naration}}
                        </td>

                    </tr>
                    @endforeach


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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

@endsection

@push('scripts')

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false,"displayLength": 500, "autoWidth": false,"ordering": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-sm-12:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush
