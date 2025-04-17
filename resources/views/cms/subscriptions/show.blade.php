@extends('layouts.cms')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title mb-0">Subscription: {{ $subscription->code }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Name</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->name }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Price</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->price }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Branch Limit</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->branch_limit }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>User Limit</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->user_limit }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Features</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->features }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Duration (in days)</strong></h6>
                            <p class="text-muted mb-0">{{ $subscription->duration_in_days }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="border-top pt-3">
                            <h6 class="mb-1"><strong>Status</strong></h6>
                            <p class="text-muted mb-0">
                                @if(strtolower($subscription->status) === 'active')
                                    <span class="badge badge-sm bg-success">{{ $subscription->status }}</span>
                                @elseif(strtolower($subscription->status) === 'inactive')
                                    <span class="badge badge-sm bg-secondary">{{ $subscription->status }}</span>
                                @else
                                    <span class="badge badge-sm bg-warning text-dark">{{ $subscription->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <a href="{{ route('subscriptions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
