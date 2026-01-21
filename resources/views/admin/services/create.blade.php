@extends('admin.layout')
@section('title','Add New Service : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Services'=>'admin/services']])
    @slot('title') Add Services @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Services @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="addService"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Service Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Service Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Service Title Name">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" rows="5" name="des"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Image </label>
                                <div class="custom-file col-md-7">
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-3 text-right">
                                    <img id="image" src="{{asset('public/admin_service/default.png')}}" alt=""  width="80px" height="80px">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form> <!-- /.form start -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop