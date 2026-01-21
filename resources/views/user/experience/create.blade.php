@extends('user.layout')
@section('title','Add Experience : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','Experience'=>'user/experience']])
    @slot('title') Add Experience @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Experience @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="addExperience"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Experience Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Designation <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="title" placeholder="Designation">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Company Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="company" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-4">
                                        <label>From Year <small class="text-danger">*</small></label>
                                        <input type="month" class="form-control fromYear" name="from_year">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-4">
                                        <label>To Year <small class="text-danger">*</small></label>
                                        <input type="month" min="" class="form-control toYear" name="to_year" disabled placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4">
                                        <label>Current</label>
                                        <br>
                                        <input type="checkbox" checked name="current" class="current">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Detail</label>
                                        <textarea type="text" class="form-control" rows="10" name="des"></textarea>
                                    </div>
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
@stop
@section('pageJsScripts')
<script type="text/javascript">
    $(document).on('change','.fromYear',function(){
        var month = $(this).val();
        $('.toYear').attr('min',month);
    })

    $('.current').change(function(){
        if ($(this).prop('checked')==true){ 
            $('.toYear').attr('disabled',true);
        }else{
            $('.toYear').attr('disabled',false);
        }
    })
</script>
@endsection