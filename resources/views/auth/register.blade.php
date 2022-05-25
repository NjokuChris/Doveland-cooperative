@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- checkbox -->
                        <div class="row">
                            <div class="form-group center">

                           <label>Is Member:</label> <input type="checkbox" id="myCheck" onclick="myFunction()">

                            </div>
                        </div>

                        <div id="text" style="display:none">
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Members Name') }}</label>

                                <div class="col-md-5">
                                    <input id="full_name" type="text" class="form-control" name="f_name" value="{{ old('f_name') }}">

                                </div>
                                <div class="col-md-1">
                                    <input id="member_no" type="text" class="form-control" name="member_no">

                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="f_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="f_name" type="text" class="form-control @error('name') is-invalid @enderror" name="f_name" value="{{ old('f_name') }}" required autocomplete="f_name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_name" class="col-md-4 col-form-label text-md-right">{{ __('SurName') }}</label>

                            <div class="col-md-6">
                                <input id="f_name" type="text" class="form-control @error('name') is-invalid @enderror" name="f_name" value="{{ old('s_name') }}" required autocomplete="s_name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="m_name" class="col-md-4 col-form-label text-md-right">{{ __('Other Name') }}</label>

                            <div class="col-md-6">
                                <input id="m_name" type="text" class="form-control @error('name') is-invalid @enderror" name="m_name" value="{{ old('m_name') }}" required autocomplete="m_name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
<script>
function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("text");
    var text1 = document.getElementById("member_no");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
      text.style.display = "none";
      text1.value = "";
    }
  }
    </script>
@endpush
