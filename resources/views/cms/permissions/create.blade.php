@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf

                        <div class="form-group mt-3 row">
                            <label for="menu_id" class="col-sm-2 col-form-label">Menu:</label>
                            <div class="col-sm-10">
                                <select name="menu_id" id="menu_id" class="form-control select2 @error('menu_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select Menu</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" data-module="{{ $menu->module }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                                @error('menu_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="access" class="col-sm-2 col-form-label">List Access:</label>
                            <div class="col-sm-10">
                                <select name="access" id="access" class="form-control select2-tags @error('access') is-invalid @enderror" required>
                                    <option value="" disabled>Select Access</option>
                                    @foreach ($listAccess as $access)
                                        <option value="{{ $access }}">{{ $access }}</option>
                                    @endforeach
                                </select>
                                @error('access')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="permission_name" class="col-sm-2 col-form-label">Permission Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="permission_name" readonly id="permission_name" value="{{ old('permission_name') }}" placeholder="Enter permission name" class="form-control @error('permission_name') is-invalid @enderror" required>
                                @error('permission_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <div class="col-sm-10 offset-sm-2">
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('cms/vendor/select2/css/select2.min.css') }} ">
@endsection
@section('js')
<script src="{{ asset('cms/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('cms/vendor/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2();
        $(".select2-tags").select2({
            tags:true
        });
        $('#menu_id, #access').on('change', function() {
            var selectedModule = $('#menu_id').find(':selected').data('module');
            var access = $('#access').val() || '';
            var permissionName = access ? selectedModule + '-' + access : selectedModule;
            $('#permission_name').val(permissionName);
        });
    })
</script>
@endsection
