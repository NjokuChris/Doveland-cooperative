@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- checkbox -->
                            <div class="row">
                                <div class="form-group center">

                                    <label>Is Member:</label> <input type="checkbox" id="myCheck" name="is_member" value="1"
                                        onclick="myFunction()">

                                </div>
                            </div>

                            <div id="text" style="display:none">
                                <div class="form-group row">
                                    <div class="input-field">
                                        <label class="bmd-label-floating">Members Name</label>
                                        <input type="text" id="autocomplete-input" name="name" class="autocomplete">
                                    </div>
                                    <div class="col-md-1">
                                        <input id="member_id" type="text" class="form-control" readonly name="member_id">

                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="f_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="f_name" type="text"
                                        class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                                        value="{{ old('f_name') }}" required autocomplete="f_name" autofocus>

                                    @error('f_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="s_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('SurName') }}</label>

                                <div class="col-md-6">
                                    <input id="s_name" type="text"
                                        class="form-control @error('s_name') is-invalid @enderror" name="s_name"
                                        value="{{ old('s_name') }}" id="s_name" required autocomplete="s_name" autofocus>

                                    @error('s_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="m_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Other Name') }}</label>

                                <div class="col-md-6">
                                    <input id="m_name" type="text"
                                        class="form-control" name="m_name"
                                        value="{{ old('m_name') }}" autocomplete="m_name">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text"
                                        class="form-control @error('location') is-invalid @enderror" name="location"
                                        value="{{ old('location') }}"  autocomplete="location" autofocus>

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
                                    <option>Select Role</option>
                                    @foreach ($roles as $role)
                                   <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option>

                                @endforeach
                                </select>

                            </div>

                            <div id="permissions_box">
                                <label for="roles"> Select Permissions</label>
                                <div id="permissions_checkbox_list">
                                </div>
                            </div>
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
<script src="{{ asset('js/Autocomplete.js') }}"></script>
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
                text1.value = "";
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_checkbox_list = $('#permissions_checkbox_list');

            permissions_box.hide();// hide all boxes

            $('#role').on('change', function(){
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                permissions_checkbox_list.empty();

                $.ajax({
                    url: "/admin/users/create",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                  //  console.log(data);

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

            $.ajax({
                type: 'get',
                url: "{{ url('findMembers') }}",
                success: function(response) {
                    console.log(response);
                    var MembArray = response;
                    var dataMemb = {};
                    var dataMemb2 = {};
                    for (var i = 0; i < MembArray.length; i++) {
                        dataMemb[MembArray[i].member_name] = null;
                        dataMemb2[MembArray[i].member_name] = MembArray[i];
                    }
                    console.log("dataMemb2");
                    console.log(dataMemb2);
                    $('input#autocomplete-input').autocomplete({
                        data: dataMemb,
                        onAutocomplete: function(reqdata) {
                            console.log(reqdata);
                            $('#member_id').val(dataMemb2[reqdata]['member_id']);
                            $('#f_name').val(dataMemb2[reqdata]['firstName']);
                            $('#s_name').val(dataMemb2[reqdata]['surName']);
                        }
                    });
                }
            })

        });
    </script>
@endpush
