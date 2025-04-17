@extends('layouts.cms')

@section('title'){{ $title }}@endsection

@section('content')

<div class="row">
    <div class="col-xl-4 col-xxl-4 col-lg-4 col-md-6 col-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card my-calendar">
                    <div class="card-body schedules-cal p-2">
                        <div class="events">
                            <h6>Monitoring Setting</h6>
                            <div class="dz-scroll event-scroll" style="height: 250px !important">
                                <div class="event-media">
                                    <div class="d-flex align-items-center">
                                        <div class="event-box">
                                            <br>
                                            <h5 class="mb-0">{{ $permissions }}</h5>
                                        </div>
                                        <div class="event-data ms-2">
                                            <h5 class="mb-0"><a target="_BLANK" href="{{ route('permissions.index') }}">Total Permissions</a></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-media">
                                    <div class="d-flex align-items-center">
                                        <div class="event-box">
                                            <br>
                                            <h5 class="mb-0">{{ $roles }}</h5>
                                        </div>
                                        <div class="event-data ms-2">
                                            <h5 class="mb-0"><a target="_BLANK" href="{{ route('roles.index') }}">Total Role</a></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-media">
                                    <div class="d-flex align-items-center">
                                        <div class="event-box">
                                            <br>
                                            <h5 class="mb-0">{{ $users }}</h5>
                                        </div>
                                        <div class="event-data ms-2">
                                            <h5 class="mb-0"><a target="_BLANK" href="{{ route('users.index') }}">Total Users</a></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-media">
                                    <div class="d-flex align-items-center">
                                        <div class="event-box">
                                            <br>
                                            <h5 class="mb-0">{{ $menus }}</h5>
                                        </div>
                                        <div class="event-data ms-2">
                                            <h5 class="mb-0"><a target="_BLANK" href="{{ route('menus.index') }}">Total Menus</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-6 col-12">
        <div class="card overflow-hidden">
            <div class="card-header border-1 pb-3 flex-wrap">
                <h4 class="heading mb-3">Monitoring Activities</h4>
                <div>
                    <a href="{{ route('report-activity-user') }}" class="btn btn-sm btn-primary">View All Activities</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive active-projects">
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Type</th>
                            <th>URL</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->user?->fullname }}</td>
                                <td>{{ $activity->ip }}</td>
                                <td>{{ $activity->type }}</td>
                                <td>{{ $activity->url }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($activity->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

