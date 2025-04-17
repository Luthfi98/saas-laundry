@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group mt-3 row">
                    <label for="role" class="col-sm-2 col-form-label"><b>Name</b>:</label>
                    <div class="col-sm-10">
                        <span>{{ $role->name }}</span>
                    </div>
                </div>
                <div class="form-group mt-3 row">
                    <label for="role" class="col-sm-2 col-form-label"><b>Role Description</b>:</label>
                    <div class="col-sm-10">
                        <span>{{ $role->description }}</span>
                    </div>
                </div>
                <hr>
                <div class="form-group mt-3 row">
                    <label for="permissions" class="col-sm-2 col-form-label">Assigned for Permissions:</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="all" value="all" id="select-all">
                            <label class="form-check-label" for="select-all" id="text-is-label">Select All</label>
                        </div>
                    </div>
                </div>
                <form action="{{ route('roles.storePermission') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">Menu</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td><span>{{ $menu['name'] }}</span></td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($menu['permissions'] as $permission)
                                                <div class="mr-2 mb-2">
                                                    @php
                                                        $checked = $role->permissions->contains('permission_id', $permission['id']) ? 'checked' : '';
                                                        $name = str_replace($menu['module'].'-', '', $permission['name']);
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input permission" {{ $checked }} type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" id="permissions-{{ $permission['id'] }}">
                                                        <label class="form-check-label" for="permissions-{{ $permission['id'] }}" id="text-is-label">{{ ucfirst($name) }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($menu['child'] as $submenu)
                                <tr>
                                    <td><span style="margin-left: 20px !important">{{ $submenu['name'] }}</span></td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($submenu['permissions'] as $permission)
                                                <div class="mr-2 mb-2">
                                                    @php
                                                        $checked = $role->permissions->contains('permission_id', $permission['id']) ? 'checked' : '';
                                                        $name = str_replace($submenu['module'].'-', '', $permission['name']);
                                                    @endphp
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input permission" {{ $checked }} type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" id="permissions-{{ $permission['id'] }}">
                                                        <label class="form-check-label" for="permissions-{{ $permission['id'] }}" id="text-is-label">{{ ucfirst($name) }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                    @foreach ($submenu['child'] as $subsubmenu)
                                    <tr>
                                        <td><span style="margin-left: 40px !important">{{ $subsubmenu['name'] }}</span></td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($subsubmenu['permissions'] as $permission)
                                                    <div class="mr-2 mb-2">
                                                        @php
                                                            $checked = $role->permissions->contains('permission_id', $permission['id']) ? 'checked' : '';
                                                            $name = str_replace($subsubmenu['module'].'-', '', $permission['name']);
                                                        @endphp
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input permission" {{ $checked }} type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" id="permissions-{{ $permission['id'] }}">
                                                            <label class="form-check-label" for="permissions-{{ $permission['id'] }}" id="text-is-label">{{ ucfirst($name) }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="form-group mt-3 row">
                        <label for="users" class="col-sm-2 col-form-label">Assigned For User:</label>
                        <div class="col-sm-10">
                            <div class="row">
                                @foreach ($users as $item)
                                    <div class="col-auto">
                                        @php
                                            $checked = $role->users->contains('user_id', $item['id']) ? 'checked' : '';
                                        @endphp
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" {{ $checked }} name="users[]" value="{{ $item->id }}" id="users-{{ $item->id }}">
                                            <label class="form-check-label" for="users-{{ $item->id }}" id="text-is-label">{{ $item->fullname }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">{{ __("Back") }}</a>
                            <button class="btn btn-primary" type="submit">{{ __("Save") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    checkedAll()
    $('#select-all').on('change', function() {
        $('.permission').prop('checked', $(this).prop('checked'));
    });

    $('body').on('change', '.permission', function() {
        checkedAll()
    });

    function checkedAll() {
        if ($('.permission:checked').length === $('.permission').length) {
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }
    }
</script>
@endsection


