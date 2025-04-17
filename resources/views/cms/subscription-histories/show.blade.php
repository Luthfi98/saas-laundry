@extends('layouts.cms')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title mb-0">Subscription History: {{ $subscriptionHistory->code }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Tenant</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->tenant->name ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Subscription</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->subscription->name ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Code</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->code }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Price</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->price }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Start Date</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->start_date->format('Y-m-d') }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>End Date</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->end_date->format('Y-m-d') }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Payment Method</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->payment_method ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <h6 class="mb-1"><strong>Status</strong></h6>
                            <p class="text-muted mb-0">
                                @if($subscriptionHistory->status == 'active')
                                    <span class="badge badge-sm bg-success">Active</span>
                                @elseif($subscriptionHistory->status == 'expired')
                                    <span class="badge badge-sm bg-danger">Expired</span>
                                @elseif($subscriptionHistory->status == 'cancelled')
                                    <span class="badge badge-sm bg-warning text-dark">Cancelled</span>
                                @else
                                    <span class="badge badge-sm bg-secondary">Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="border-top pt-3">
                            <h6 class="mb-1"><strong>Notes</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->notes ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="border-top pt-3">
                            <h6 class="mb-1"><strong>Created At</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border-top pt-3">
                            <h6 class="mb-1"><strong>Updated At</strong></h6>
                            <p class="text-muted mb-0">{{ $subscriptionHistory->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('subscription-histories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    @if ($general->canAccess('module-subscription-history-update', true))
                        <a href="{{ route('subscription-histories.edit', $subscriptionHistory->id) }}" class="btn btn-warning">
                            <i class="fas fa-pencil me-1"></i> Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 