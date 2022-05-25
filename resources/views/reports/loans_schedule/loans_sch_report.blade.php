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
            <h1>LOANS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">LOANS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <p>
            <a href="{{route('loans.create')}}" class="btn btn-primary">Back to Search Form.</a>
          </p>
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">LOANS Reports</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table-bordered table-striped compact">
                  <thead>
                  <tr>
                    <th>LOAN ID</th>
                    <th>MEMBERS NAME</th>
                    <th>LOANS DATE</th>
                    <th>LOANS TYPE</th>
                    <th>LOAN AMOUNT</th>
                    <th>Margin %</th>
                    <th>Margin AMOUNT</th>
                    <th>Total Paid</th>
                    <th>running Balance</th>
                    <th>POSTED BY</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($loans as $l)
                    <tr>
                        <td>{{$l->id}}</td>
                        <td>
                            @if ($l->members != null)
                            {{ $l->members->member_name }}

                            @else

                            {{"Record Not Found"}}

                            @endif

                        </td>
                        <td>{{$l->created_at}}</td>
                        <td>{{$l->loans_type->salary_group}}</td>
                        <td>&#8358;{{ number_format($l->loanamount) }}</td>
                        <td>{{$l->interest_rate}}</td>
                        <td>&#8358;{{number_format($l->interestamount)}}</td>
                        <td>&#8358;{{number_format($l->total_amount_paid)}}</td>
                        <td>&#8358;{{number_format($l->loanamount - $l->total_amount_paid)}}</td>
                        <td>
                            @if($l->posted_by != null)
                            {{ $l->postedby->name }}</td>
                            @endif

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
      "responsive": true, "lengthChange": true, "autoWidth": false,"ordering": false,
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
