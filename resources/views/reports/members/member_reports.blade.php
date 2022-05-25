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
            <h1>Cooperative Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cooperative Members</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <p>
            <a href="{{url()->previous()}}" class="btn btn-primary">Back to Search</a>
            </p>
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Cooperatives Member</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table-bordered table-striped compact" style="width:100%">
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Employee No.</th>
                    <th>Company:</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Savings Amount</th>
                    <th>Current Balance</th>
                    <th>email</th>
                    <th>Date joined</th>
                    <th>Account Number</th>
                    <th>Referees Name</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach($members as $m)
                    <tr>
                        <td>{{$m->member_id}}</td>
                        <td>{{$m->title}}</td>
                        <td>{{$m->member_name}}</td>
                        <td>{{$m->employee_no}}</td>
                        <td>
                            @if ($m->Company != null)
                            {{$m->Company->company_name}}

                            @else

                            {{"Record Not Found"}}

                            @endif
                            </td>
                        <td>{{$m->phoneNo}}</td>
                        <td>{{$m->gender}}</td>
                        <td>{{number_format($m->savings_amount)}}</td>
                        <td>{{number_format($m->current_balance)}}</td>
                        <td>{{$m->email}}</td>
                        <td>{{$m->joined_date}}</td>
                        <td>{{$m->bankAcc_no}}</td>
                        <td>{{$m->referee}}</td>


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
      "responsive": false, "lengthChange": false, "autoWidth": true,"bPaginate" : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-sm-12:eq(0)');
    $('#example2').DataTable({
     /* "paging": false, */
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "bPaginate" : false,
    });
  });
</script>
@endpush
