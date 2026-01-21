@extends('user.layout')
@section('title','Skill : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'admin/my_profile']])
        @slot('title') Skill @endslot
        @slot('add_btn') <button type="button" data-toggle="modal" data-target="#modal-default" class="align-top btn btn-sm btn-primary d-inline-block">Add New</button> @endslot
        @slot('active') Skill @endslot
    @endcomponent
    <!-- /.content-header -->

    <!-- show data table component -->
    @component('admin.components.data-table',['thead'=>
        ['S NO.','Skill Name','Percent(%)','Status','Action']
    ])
        @slot('table_id') skill-list @endslot
    @endcomponent

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Skill Add</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="addSkill" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Skill Name</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Skill Name">
                        </div>
                        <div class="form-group">
                            <label>Percentage (%) Between 0 to 100</label>
                            <input type="number" min="0" max="100" class="form-control" name="percent" placeholder="Percentage">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --> 
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Skill Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editSkill" method="POST">
                    <div class="modal-body">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label>Skill</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Skill Name">
                            <input type="hidden" name="id" >
                        </div>
                        <div class="form-group">
                            <label>Percentage (%) Between 0 to 100</label>
                            <input type="number" min="0" max="100" class="form-control" name="percent" placeholder="Percentage">
                        </div>
                        <div class="form-group ">
                            <label> Status </label>
                            <select name="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
@stop

@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#skill-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "skill",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'skill'},
            {data: 'percent', name: 'percent'},
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