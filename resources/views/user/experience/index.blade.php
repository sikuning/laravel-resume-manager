@extends('user.layout')
@section('title','Experience : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Experience @endslot
        @slot('add_btn') <a href="{{url('user/experience/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Experience  @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('user.components.data-table',['thead'=>
        ['S NO.','Designation','Company Name','Duration','Status','Action']
    ])
        @slot('table_id') experience-list @endslot
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
    var table = $("#experience-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "experience",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'designation', name: 'designation'},
            {data: 'company', name: 'company'},
            {data: 'from_year', name: 'duration'},
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
