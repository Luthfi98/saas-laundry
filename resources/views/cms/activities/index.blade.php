@extends('layouts.cms')

@section('title'){{ $title }}@endsection



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div>
                            <button class="btn btn-sm btn-outline-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                                Filter
                            </button>
                              <div class="collapse" id="filter">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <label for="type">Type</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="">All</option>
                                                <option>Login</option>
                                                <option>Create</option>
                                                <option>Edit</option>
                                                <option>Delete</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <br>
                                            <button class="btn btn-sm btn-primary" id="search-button">Search</button>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                    <div class="table-responsive">

                        <table class="display table" id="data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>URL</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>TimeStamp</th>
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
          ajax: {
                url: "{{ route('report-activity-user') }}",
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.type = $('#type').val();
                }
            },
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
              {data: 'user', name: 'user'},
              {data: 'url', name: 'url'},
              {data: 'description', name: 'description'},
              {data: 'type', name: 'type'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
          ],
          language: {
			paginate: {
			   next: '<i class="fa-solid fa-angle-right"></i>',
			  previous: '<i class="fa-solid fa-angle-left"></i>'
			},
		  },
      });


    $("#search-button").click(function(){
        table.ajax.reload();
      })
    });


  </script>



@endsection
