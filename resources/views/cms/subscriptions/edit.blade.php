@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="{{ route('subscriptions.update', $subscription->id) }}">
                <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $subscription->name) }}" placeholder="Enter name" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $subscription->price) }}" placeholder="Enter price" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="branch_limit">Branch Limit</label>
                            <input type="number" name="branch_limit" id="branch_limit" value="{{ old('branch_limit', $subscription->branch_limit) }}" placeholder="Enter branch limit" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="user_limit">User Limit</label>
                            <input type="number" name="user_limit" id="user_limit" value="{{ old('user_limit', $subscription->user_limit) }}" placeholder="Enter user limit" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="features">Features</label>
                            <textarea name="features" class="form-control" id="features" cols="30" rows="10" placeholder="Enter features">{{ old('features', $subscription->features) }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="duration_in_days">Duration in Days</label>
                            <input type="number" name="duration_in_days" id="duration_in_days" value="{{ old('duration_in_days', $subscription->duration_in_days) }}" placeholder="Enter duration in days" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="active" {{ old('status', $subscription->status) == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">{{ old('status', $subscription->status) == 'active' ? 'Active' : 'Inactive' }}</label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
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

