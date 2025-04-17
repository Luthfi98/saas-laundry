@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="{{ route('tenants.update', $tenant->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group mt-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email" value="{{ old('email', $tenant->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $tenant->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30" rows="10">{{ old('address', $tenant->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                @if($tenant->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $tenant->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                                @error('logo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3 row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" id="status" name="status" value="active" {{ old('status', $tenant->status) == 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">{{ old('status', $tenant->status) == 'active' ? 'Active' : 'Inactive' }}</label>
                                </div>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
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

