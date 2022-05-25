@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
@endsection

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
                    <form method="POST" action="{{ route('permissions.store') }}">

                        {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-5">
                                    <input id="name" type="text" id="name" class="form-control" name="name">

                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="slug" class="col-md-4 col-form-label text-md-right">{{ __('permission slug') }}</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" id="slug" tag="slug" readonly class="form-control @error('slug') is-invalid @enderror" name="slug" required autocomplete="slug" autofocus>

                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#name').keyup(function(e){
            var str = $('#name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//replace space with dash
            $('#slug').val(str);
            $('slug').atrr('placeholder', str);
        });
    });
</script>
@endpush


