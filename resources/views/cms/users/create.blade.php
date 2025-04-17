@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group mt-3 row">
                            <label for="fullname" class="col-sm-2 col-form-label">Fullname:</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Enter fullname" value="{{ old('fullname', '') }}" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" required>
                                @error('fullname')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="username" class="col-sm-2 col-form-label">Username:</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Enter username" value="{{ old('username', '') }}" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required>
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" placeholder="Enter email" value="{{ old('email', '') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Enter phone" value="{{ old('phone', '') }}" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" placeholder="Enter password" value="" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Re-Password:</label>
                            <div class="col-sm-10">
                                <input type="password" placeholder="Enter re-password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
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
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" name="roles[]" value="{{ $item->id }}" id="roles-{{ $item->id }}" {{ in_array($item->id, old('roles', [])) ? 'checked' : '' }}>
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
@endsection

@section('js')
@endsection

