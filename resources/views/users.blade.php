@extends('layouts.admin')
@section('css')






<title>Install DataTables in Laravel - Tutsmake.com</title>

<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">



@endsection

@section('content')

         <div class="container">
               <h2>Laravel DataTable - Tuts Make</h2>
            <table class="table table-striped" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Created at</th>
                     <th>Action</th>
                  </tr>
               </thead>
            </table>
         </div>

         @endsection
@push('scripts')

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   <script>
   $(document).ready( function () {
    $('#laravel_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('users-list') }}",
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    {
                data: 'action',
                name: 'action',
            },

                 ]
        });
     });

  </script>

@endpush


