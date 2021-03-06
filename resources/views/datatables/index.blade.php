@extends('layouts.master')

@section('content')
  <table class="table table-bordered table-striped" id="users-table">
    <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Created At</th>
      <th>Updated At</th>
    </tr>
    </thead>

  </table>
@stop

@push('scripts')
<script>
  $(function () {
    $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      lengthMenu: [[15, 25, 50, -1], [15, 25, 50, "All"]],
      iDisplayLength: 50,
      ajax: '{!! route('datatables.data') !!}',
      columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'}
      ]
    });
  });
</script>
@endpush