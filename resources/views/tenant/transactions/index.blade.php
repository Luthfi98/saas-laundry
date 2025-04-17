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
                            @if($general->canAccess('module-transaction-tenant-create', true))
                            <a href="{{ route('tenant.transactions.create', ['code' => request()->route('code')]) }}" class="btn btn-primary btn-sm" title="Create">
                                <span class="fa fa-plus"></span> Add Transaction
                            </a>
                            @endif
                        </div>
                    </div>
                    <table class="display table" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Branch</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Pickup Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Paid</th>
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
            ajax: "{{ route('tenant.transactions.index', ['code' => request()->route('code')]) }}",
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'invoice_number', name: 'invoice_number'},
                {data: 'code', name: 'code'},
                {data: 'customer_name', name: 'customer.name'},
                {data: 'branch_name', name: 'branch.name'},
                {data: 'user_name', name: 'user.name'},
                {data: 'transaction_date', name: 'transaction_date', render: function(data) {
                    return moment(data).format('DD/MM/YYYY');
                }},
                {data: 'pickup_date', name: 'pickup_date', render: function(data) {
                    return data ? moment(data).format('DD/MM/YYYY') : '-';
                }},
                {data: 'status_badge', name: 'status'},
                {data: 'total', name: 'total', render: function(data) {
                    return 'Rp ' + parseFloat(data).toLocaleString('id-ID');
                }},
                {data: 'paid', name: 'paid', render: function(data) {
                    return 'Rp ' + parseFloat(data).toLocaleString('id-ID');
                }},
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