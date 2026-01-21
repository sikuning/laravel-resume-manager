@extends('admin.layout')
@section('title','Blogs : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Blogs @endslot
        @slot('add_btn') <a href="{{url('admin/blogs/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Blogs  @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Image','Category','Status','Action']
    ])
        @slot('table_id') blog-list @endslot
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
    var table = $("#blog-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "blogs",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'image'},
            {data: 'category_name', name: 'category'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '100px'
            }
        ]
    });
</script>
@stop
