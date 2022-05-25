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
            <h1>Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permissions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <p>
            <a href="{{route('permissions.create')}}" class="btn btn-primary">Create New Permission</a>
        </p>
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Permissions</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Permissions</th>
                    <th>Slug</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $r)
                    <tr>
                        <td>{{$r['id']}}</td>
                        <td>{{$r['name']}}</td>
                        <td>{{$r['slug']}}</td>
                        <td>
                            <a href="/admin/Permissions/{{ $r['id']}}"><i class="fa fa-eye"></i></a>
                            <a href="/admin/Permissions/{{ $r['id']}}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal1" data-Permissionsid="{{$r['id']}}"><i class="fa fa-user-times"></i></a>
                        </td>

                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <tr>
                        <th>ID</th>
                        <th>Permissions</th>
                        <th>Slug</th>
                        <th>Permissions</th>
                        <th>Action</th>
                      </tr>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->

              <!-- delete Modal -->
              <div class="modal fade" id="deleteModal1" tabindex="1" Permissions="dialog">
                <div class="modal-dialog" Permissions="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Are you shure you want to delete this user.</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Selete delete if you want to delete this user.&hellip;</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <form method="POST" action="">
                        @method('DELETE')
                        @csrf
                       {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                        <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
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

<script>
    $('#deleteModal1').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var Permissions_id = button.data('Permissionsid') // Extract info from data-* attributes

  var modal = $(this)
  // modal.find('.modal-footer' #user_id).val(user_id)
  modal.find('form').attr('action','/admin/Permissions/' + Permissions_id);
})
</script>

@endpush
