@extends('admin.layout')
@section('title','Users : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') User @endslot
          @slot('add_btn')  @endslot
        @slot('active') User  @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S.No.','Image','Name','Designation','Email','Country','Join','Status','Action']
    ])
        @slot('table_id') user-list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#user-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "users",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'user_image'},
            {data: 'username', name: 'username'},
            {data: 'designation', name: 'designation'},
            {data: 'email', name: 'email'},
            {data: 'country', name: 'country'},
            {data: 'join', name: 'join'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '90px'
            }
        ]
    });
</script>
@stop