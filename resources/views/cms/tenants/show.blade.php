@extends('layouts.cms')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title mb-0">Tenant Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-4">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Code</strong></h6>
                            <p class="text-muted mb-0">{{ $tenant->code }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Name</strong></h6>
                            <p class="text-muted mb-0">{{ $tenant->name }}</p>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-4">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Email</strong></h6>
                            <p class="text-muted mb-0">{{ $tenant->email }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Phone</strong></h6>
                            <p class="text-muted mb-0">{{ $tenant->phone }}</p>
                        </div>
                    </div>

                    <!-- Column 3 -->
                    <div class="col-md-4">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Address</strong></h6>
                            <p class="text-muted mb-0">{{ $tenant->address }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-1"><strong>Logo</strong></h6>
                            <img src="{{ asset($tenant->logo) }}" alt="Logo" class="img-fluid border rounded shadow-sm mt-1" style="max-height: 100px;">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="border-top pt-3">
                            <h6 class="mb-1"><strong>Status</strong></h6>
                            <p class="text-muted mb-0">
                                @if(strtolower($tenant->status) === 'active')
                                    <span class="badge badge-sm bg-success">{{ $tenant->status }}</span>
                                @elseif(strtolower($tenant->status) === 'inactive')
                                    <span class="badge badge-sm bg-secondary">{{ $tenant->status }}</span>
                                @else
                                    <span class="badge badge-sm bg-warning text-dark">{{ $tenant->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('tenants.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
