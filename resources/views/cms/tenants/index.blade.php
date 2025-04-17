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
                                @if ($general->canAccess('module-tenant-create', true))
                                    <a href="{{ route('tenants.create') }}" class="btn btn-primary btn-sm" title="Create"><span class="fa fa-plus"></span> {{__("Add Tenant")}}</a>
                                @endif
                            </div>
                        </div>
                        <table class="display table" id="data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Logo</th>
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
          ajax: "{{ route('tenants.index') }}",
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
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'address', name: 'address'},
              {data: 'logo', name: 'logo'},
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

