@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mt-3 row">
                            <label for="fullname" class="col-sm-2 col-form-label">Fullname:</label>
                            <div class="col-sm-10">
                                <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname', $user->fullname) }}" placeholder="Enter fullname" required>
                                @error('fullname')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="username" class="col-sm-2 col-form-label">Username:</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" placeholder="Enter username" required>
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Enter email" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Re-Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter re-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="roles" class="col-sm-2 col-form-label">Assign Roles:</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    @foreach ($roles as $item)
                                        <div class="col-lg-2 col-6">
                                            @php
                                                $checked = in_array($item->id, old('roles', $user->roles->pluck('role_id')->toArray())) ? 'checked' : '';
                                            @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" {{ $checked }} name="roles[]" value="{{ $item->id }}" id="roles-{{ $item->id }}">
                                                <label class="form-check-label" for="roles-{{ $item->id }}" id="text-is-label">{{ $item->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <div class="col-sm-10 offset-sm-2">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection

