@extends('user.layout')
@section('title','Testimonial : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Testimonial @endslot
        @slot('add_btn') <a href="{{url('user/testimonial/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Testimonial @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('user.components.data-table',['thead'=>
        ['S NO.','Client','Status','Action']
    ])
        @slot('table_id') testimonial-list @endslot
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
    var table = $("#testimonial-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "testimonial",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'image'},
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
