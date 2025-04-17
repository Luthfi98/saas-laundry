@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('menus.store') }}">
                        @csrf

                        <div class="form-group mt-3 row">
                            <label for="parent" class="col-sm-2 col-form-label">Parent Menu:</label>
                            <div class="col-sm-10">
                                <select name="parent" id="parent" class="form-control select2 @error('parent') is-invalid @enderror">
                                    <option value="">Select Parent</option>
                                    @foreach ($parents as $parentMenu)
                                        <option {{ old('parent', '') == $parentMenu->id ? 'selected' : '' }} value="{{ $parentMenu->id }}">{{ $parentMenu->name }}</option>
                                        @foreach ($parentMenu->child as $childMenu)
                                            <option {{ old('parent', '') == $childMenu->id ? 'selected' : '' }} value="{{ $childMenu->id }}">- {{ $childMenu->name }}</option>
                                            @foreach ($childMenu->child as $subChildMenu)
                                                <option {{ old('parent', '') == $subChildMenu->id ? 'selected' : '' }} value="{{ $subChildMenu->id }}">-- {{ $subChildMenu->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('parent')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('name', '') }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="module" class="col-sm-2 col-form-label">Module:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('module', '') }}" name="module" id="module" class="form-control @error('module') is-invalid @enderror" required>
                                @error('module')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="path" class="col-sm-2 col-form-label">Path:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('path', '') }}" name="path" id="path" class="form-control @error('path') is-invalid @enderror" required>
                                @error('path')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="icon" class="col-sm-2 col-form-label">Icon:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><span id="show-icon"></span></div>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" value="{{ old('icon', '') }}" name="icon" required>
                                </div>
                                @error('icon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="type" class="col-sm-2 col-form-label">Type:</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('type') is-invalid @enderror" {{ old('type', 'cms', ) == 'cms' ? 'checked' : '' }} type="radio" name="type" id="cms" value="cms">
                                    <label class="form-check-label" for="cms">CMS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('type') is-invalid @enderror" type="radio" {{ old('type', '') == 'landing' ? 'checked' : '' }} name="type" id="landing" value="landing">
                                    <label class="form-check-label" for="landing">Landing</label>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="is_label" class="col-sm-2 col-form-label">Is Label:</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('is_label') is-invalid @enderror" type="checkbox" {{ old('is_label', '') ? 'checked' : '' }} name="is_label" id="is_label">
                                    <label class="form-check-label" for="is_label" {{ old('is_label', '') ? 'checked' : '' }} id="text-is-label">No</label>
                                </div>
                                @error('is_label')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="permissions[]" class="col-sm-2 col-form-label">Permissions:</label>
                            <div class="col-sm-10">
                                <select name="permissions[]" id="permissions[]" multiple class="form-control select2-multiple @error('permissions') is-invalid @enderror">
                                    <option value="" disabled>Select Permissions</option>
                                    @foreach ($listAccess as $access)
                                        <option {{ in_array($access, old('permissions', [])) ? 'selected' : '' }} value="{{ $access }}" >{{ $access }}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <div class="col-sm-10 offset-sm-2">
                                <a href="{{ route('menus.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
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
<script type="text/javascript">
    $(".select2").select2();
    $(".select2-multiple").select2();

    $("#icon").change(function(){
        var icon = $(this).val()
        $("#show-icon").addClass(icon)
    })

    $("#is_label").on("change", function() {
        if ($(this).prop("checked")) {
            $("#text-is-label").text("Yes");
        } else {
            $("#text-is-label").text("No");
        }
    });

    $("#name").keyup(function(){
        var name = $(this).val();
        name = name.toLowerCase();
        name = name.replace('module', '');
        name = name.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#module").val(`module-${name}`)
    })
</script>
@endsection
