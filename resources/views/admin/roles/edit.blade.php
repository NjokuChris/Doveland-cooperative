@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Roles') }}</div>

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
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">

                        {{ csrf_field() }} {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-5">
                                    <input id="name" type="text" id="name" class="form-control" name="name" value="{{$role->name}}">

                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="slug" class="col-md-4 col-form-label text-md-right">{{ __('Role slug') }}</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" id="slug" tag="slug" class="form-control @error('slug') is-invalid @enderror" readonly value="{{$role->slug}}" name="slug" required autocomplete="slug" autofocus>

                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                            <label for="permissions">{{ trans('permissions') }}*
                                <span class="btn btn-info btn-xs select-all">{{ trans('select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all">{{ trans('deselect_all') }}</span></label>
                                <div class="select2-blue">
                            <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                                @foreach($permissions as $id => $permissions)
                                    <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                @endforeach
                            </select>
                                </div>
                            @if($errors->has('permissions'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('permissions') }}
                                </em>
                            @endif

                        </div>

                            <div class="form-group row">
                                <label for="role_permissions" class="col-md-4 col-form-label text-md-right">{{ __('Add Approval Stage') }}</label>
                                <div class="col-md-6">
                                    <div class="select2-blue">
                                <select class="form-control select2" name="approval_stage_id">
                                    <option value="">Select Approval Stage</option>
                                    @foreach ($approval_stage as $b)
                                          <option value="{{$b->id}}" {{( $id == $b->id) ? 'selected' : ''}}>{{$b->approval_stage}}</option>
                                      @endforeach
                                </select>
                                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){


        $('.select2').select2();

        $('.select-all').click(function () {
            $("#permissions > option").prop("selected","selected");
        $("#permissions").trigger("change");
  })
  $('.deselect-all').click(function () {
    $("#permissions > option").prop("selected",'');
        $("#permissions").trigger("change");
  })

        $("#checkbox").click(function(){
    if($("#checkbox").is(':checked') ){
        $("#permissions > option").prop("selected","selected");
        $("#permissions").trigger("change");
    }else{
        $("#permissions > option").prop("selected",'');
        $("#permissions").trigger("change");
     }
});

        $('#name').keyup(function(e){
            var str = $('#name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//replace space with dash
            $('#slug').val(str);
            $('slug').atrr('placeholder', str);
        });
    });
</script>
@endpush


