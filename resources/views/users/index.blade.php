@extends('layouts.master')



@section('Users')
  class="active"
@stop
@section('users-bar')
  active
@stop
@section('users')
  class="active"
@stop

@section('heading')
  <h1>All Users</h1>
@stop

@section('content')

  <table class="table table-hover table-striped" id="users-table">
    <thead>
    <tr>

      <th>Name</th>
      <th>Email</th>
      <th>Work number</th>
      <th></th>
      <th></th>
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
      ajax: '{!! route('users.data') !!}',
      columns: [

        {data: 'namelink', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'work_number', name: 'work_number'},
          @ifUserCan('user.update')
        {
          data: 'edit', name: 'edit', orderable: false, searchable: false
        },
          @endif
          @ifUserCan('user.delete')
        {
          data: 'delete', name: 'delete', orderable: false, searchable: false
        },
        @endif
      ]
    });
  });
</script>
@endpush
