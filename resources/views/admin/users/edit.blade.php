@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" value="{{ $user->email }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <!-- checkbox -->
                        <div class="row">
                            <div class="form-group center">

                           <label>Is Member:</label> <input type="checkbox" id="myCheck" name="is_member" {{  ($user->is_member == 1 ? ' checked' : '') }} value="1" onclick="myFunction()">

                            </div>
                        </div>

                        <div id="text" style="display:none">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Members Name') }}</label>

                                <div class="col-md-5">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name }}">

                                </div>
                                <div class="col-md-1">
                                    <input id="member_no" type="text" class="form-control" name="member_no" value="{{ $user->member_id }}">

                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="f_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name" value="{{ $user->f_name }}" required autocomplete="f_name" autofocus>

                                @error('f_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_name" class="col-md-4 col-form-label text-md-right">{{ __('SurName') }}</label>

                            <div class="col-md-6">
                                <input id="s_name" type="text" class="form-control @error('s_name') is-invalid @enderror" name="s_name" value="{{ $user->s_name }}" required autocomplete="s_name" autofocus>

                                @error('s_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="m_name" class="col-md-4 col-form-label text-md-right">{{ __('Other Name') }}</label>

                            <div class="col-md-6">
                                <input id="m_name" type="text" class="form-control @error('m_name') is-invalid @enderror" name="m_name" value="{{ $user->m_name }}" autocomplete="m_name" autofocus>

                                @error('m_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $user->location_id }}" autocomplete="location" autofocus>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Select Role</label>

                            <select name="role" id="role" class="role form-control">
                            @foreach ($roles as $role)
                               <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>
                            @endforeach
                            </select>

                        </div>

                        <div id="permissions_box">
                            <label for="roles">Select Permissions</label>
                            <div id="permissions_checkbox_list">
                            </div>

                        </div>

                        @if($user->permissions->isNotEmpty())
                            @if($rolePermission != null)
                            <div id="user_permissions_box">
                                <label for="roles"> User Permissions</label>
                                <div class="user_permissions_checkbox_list">
                                    @foreach ($rolePermission as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked' : '' }}>
                                        <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function myFunction() {
            // Get the checkbox
            var checkBox = document.getElementById("myCheck");
            // Get the output text
            var text = document.getElementById("text");
            var text1 = document.getElementById("member_no");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
              //  text1.value = "";
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_checkbox_list = $('#permissions_checkbox_list');
            var user_permissions_box = $('#user_permissions_box');
            var user_permissions_checkbox_list = $('#user_permissions_checkbox_list')

            permissions_box.hide();// hide all boxes

            $('#role').on('change', function(){
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                permissions_checkbox_list.empty();
                user_permissions_box.empty();

                $.ajax({
                   // url: "/admin/users/create",
                    url: "{{ url('/admin/users/create') }}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    console.log(data);

                   permissions_box.show();
                //   permissions_checkbox_list.empty();

                    $.each(data, function(index, element){
                       $(permissions_checkbox_list).append(
                           '<div class="custom-control custom-checkbox">'+
                               '<input class="custom-control-input" type="checkbox" name="permissions[]" id= "'+ element.slug +'" value="'+ element.id +'" >'+
                               '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'

                        );
                    });
                });

            });

        });
    </script>
@endpush
