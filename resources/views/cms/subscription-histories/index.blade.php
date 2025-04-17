@extends('layouts.cms')

@section('title'){{ $title }}@endsection



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <!-- Add your buttons here -->
                            </div>
                            <div>
                                @if ($general->canAccess('module-subscription-history-create', true))
                                    <a href="{{ route('subscription-histories.create') }}" class="btn btn-primary btn-sm" title="Create"><span class="fa fa-plus"></span> {{__("Add Subscription History")}}</a>
                                @endif
                            </div>
                        </div>
                        <table class="display table" id="data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Tenant</th>
                                    <th>Subscription</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th width="105px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<!-- Datatable -->
<link href="{{ asset('cms/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('cms/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('js')
<!-- Datatable -->
<script src="{{ asset('cms/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cms/js/plugins-init/datatables.init.js') }}"></script>


<script type="text/javascript">
    $(function () {

      var table = $('#data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('subscription-histories.index') }}",
          columns: [
              {
            data: 'id',
            name: 'id', orderable: false,
            render: function(data, type, row, meta) {
                // Calculate the continuous index across all pages
                var continuousIndex = meta.row + meta.settings._iDisplayStart + 1;
                return continuousIndex;
            }
        },
              {data: 'code', name: 'code'},
              {data: 'tenant_name', name: 'tenant.name'},
              {data: 'subscription_name', name: 'subscription.name'},
              {
                data: 'start_date', 
                name: 'start_date',
                render: function(data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        var dayOfWeek = date.toLocaleString('default', { weekday: 'short' });
                        var day = date.getDate();
                        var month = date.toLocaleString('default', { month: 'short' });
                        var year = date.getFullYear();
                        return dayOfWeek + ', ' + day + ' ' + month + ' ' + year;
                    }
                    return '';
                }
              },
              {
                data: 'end_date', 
                name: 'end_date',
                render: function(data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        var dayOfWeek = date.toLocaleString('default', { weekday: 'short' });
                        var day = date.getDate();
                        var month = date.toLocaleString('default', { month: 'short' });
                        var year = date.getFullYear();
                        return dayOfWeek + ', ' + day + ' ' + month + ' ' + year;
                    }
                    return '';
                }
              },
              {data: 'price', name: 'price'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
          ],
          language: {
			paginate: {
			   next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			},
		  },
      });

    });
  </script>
@endsection 