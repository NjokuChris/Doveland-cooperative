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
            <h1>Cooperative Members</h1>
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
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Cooperative members</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Savings Amount</th>
                    <th>Location</th>
                    <th>Company</th>
                    <th>Date joined</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($members as $m)
                    <tr>
                        <td>{{$m->member_id}}</td>
                        <td>{{$m->title}}</td>
                        <td>{{$m->member_name}}</td>
                        <td>{{ number_format($m->savings_amount) }}</td>
                        <td>
                            @if($m->branch_location != null)
                            {{$m->branch_location->branch}}
                            @endif
                        </td>
                        <td>
                            @if($m->company != null)
                            {{$m->company->company_name}}
                            @endif
                        </td>
                        <td>{{$m->joined_date}}</td>
                        <td>
                            <div class="dropdown show">
                                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="/admin/members/{{ $m['member_id']}}"><i class="fa fa-eye"></i></a>
                                    {{--<a href="{{route('members.show',$m->member_id) }}" class="dropdown-item">--}}
                                        <i class="nav-icon fas fa-eye" style="color: blue"></i>
                                        Vieww</a>
                                    <a href="{{route('members.edit',$m->member_id) }}" class="dropdown-item">
                                        <i class="nav-icon fas fa-copy" style="color: blpue"></i>
                                        Edit</a>
                                    <a href="{{route('member_terminate.edit',$m->member_id) }}" class="dropdown-item">
                                        <i class="nav-icon fas fa-cut" style="color: red"></i>
                                        Terminate</a>
                                </div>
                              </div>
                        </td>

                    </tr>
                    @endforeach



                  </tbody>
                  <tfoot>
                  <tr>
                    <<th>Member ID</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Savings Amount</th>
                    <th>Location</th>
                    <th>Company</th>
                    <th>Date joined</th>
                    <th>Action</th>
                  </tr>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
