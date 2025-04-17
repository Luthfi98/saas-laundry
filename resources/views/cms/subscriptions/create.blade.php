@extends('layouts.cms')

@section('title'){{ $title }}@endsection



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="{{ route('subscriptions.store') }}">
                <div class="card-body">
                        @csrf

                        <div class="form-group mt-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter subscription name" class="form-control" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="price">Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-text">Rp</div>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="Enter subscription price" class="form-control" required min="0">
                            </div>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="branch_limit">Branch Limit</label>
                            <input type="number" name="branch_limit" id="branch_limit" value="{{ old('branch_limit') }}" placeholder="Enter subscription branch limit" min="1" class="form-control" required>
                            @error('branch_limit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="user_limit">User Limit</label>
                            <input type="number" name="user_limit" id="user_limit" value="{{ old('user_limit') }}" placeholder="Enter subscription user limit" min="1" class="form-control" required>
                            @error('user_limit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="features">Features</label>
                            <textarea name="features" class="form-control" id="features" cols="30" rows="10" placeholder="Enter subscription features">{{ old('features') }}</textarea>
                            @error('features')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="duration_in_days">Duration in Days</label>
                            <input type="number" name="duration_in_days" id="duration_in_days" value="{{ old('duration_in_days') }}" placeholder="Enter subscription duration in days" min="1" class="form-control" required>
                            @error('duration_in_days')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="active" {{ old('status') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">{{ old('status') == 'active' ? 'Active' : 'Inactive' }}</label>
                            </div>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')

@endsection

