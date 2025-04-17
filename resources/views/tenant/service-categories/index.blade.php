@extends('layouts.tenant')

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
                            @if($general->canAccess('module-service-category-create', true))
                            <a href="{{ route('tenant.service-categories.create', ['code' => request()->route('code')]) }}" class="btn btn-primary btn-sm" title="Create">
                                <span class="fa fa-plus"></span> Add Service Category
                            </a>
                            @endif
                        </div>
                    </div>
                    <table class="display table" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Branch</th>
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
            ajax: "{{ route('tenant.service-categories.index', ['code' => request()->route('code')]) }}",
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'branch_name', name: 'branch_name'},
                {data: 'is_active', name: 'is_active'},
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

    function showConfirm(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection 