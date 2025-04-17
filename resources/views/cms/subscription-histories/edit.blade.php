@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <form action="{{ route('subscription-histories.update', $subscriptionHistory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3 row">
                            <label for="tenant_id" class="col-sm-2 col-form-label">Tenant <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="tenant_id" id="tenant_id" class="form-control select2 @error('tenant_id') is-invalid @enderror" required>
                                    <option value="">Select Tenant</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" {{ old('tenant_id', $subscriptionHistory->tenant_id) == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="subscription_id" class="col-sm-2 col-form-label">Subscription <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="subscription_id" id="subscription_id" class="form-control select2 @error('subscription_id') is-invalid @enderror" required>
                                    <option value="">Select Subscription</option>
                                    @foreach($subscriptions as $subscription)
                                        <option value="{{ $subscription->id }}" {{ old('subscription_id', $subscriptionHistory->subscription_id) == $subscription->id ? 'selected' : '' }}>{{ $subscription->name }}</option>
                                    @endforeach
                                </select>
                                @error('subscription_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="code" class="col-sm-2 col-form-label">Code <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $subscriptionHistory->code) }}" placeholder="Enter Code" required>
                                @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="price" class="col-sm-2 col-form-label">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $subscriptionHistory->price) }}" placeholder="Enter Price" required>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="start_date" class="col-sm-2 col-form-label">Start Date <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $subscriptionHistory->start_date->format('Y-m-d')) }}" required>
                                @error('start_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="end_date" class="col-sm-2 col-form-label">End Date <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $subscriptionHistory->end_date->format('Y-m-d')) }}" required>
                                @error('end_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control select2 @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status', $subscriptionHistory->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('status', $subscriptionHistory->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="expired" {{ old('status', $subscriptionHistory->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="cancelled" {{ old('status', $subscriptionHistory->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="payment_method" class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-10">
                                <input type="text" name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" value="{{ old('payment_method', $subscriptionHistory->payment_method) }}" placeholder="Enter Payment Method">
                                @error('payment_method')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                            <div class="col-sm-10">
                                <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Enter Notes">{{ old('notes', $subscriptionHistory->notes) }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3 row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('subscription-histories.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('cms/vendor/select2/css/select2.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('cms/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('cms/vendor/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection 