@extends('user.layout')
@section('title','Social Links : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Social Setting @endslot
        @slot('add_btn') <a href="{{url('user/social-settings/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Social Setting  @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('user.components.data-table',['thead'=>
        ['S NO.','Title','Icon','Status','Action']
    ])
        @slot('table_id') social_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#social_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "social-settings",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'icon', name: 'icon'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }
        ]
    });
</script>
@stop