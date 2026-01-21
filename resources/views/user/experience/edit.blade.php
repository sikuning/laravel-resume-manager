@extends('user.layout')
@section('title','Edit Experience : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','Experience'=>'user/experience']])
    @slot('title') Edit Experience @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Experience @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updateExperience"  method="POST" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            @if($experience)
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('user/experience/'.$experience->id)}}" >
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Experience Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <div class="form-group">
                                            <label>Experience Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="title" value="{{$experience->designation}}" placeholder="Enter Experience Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Company Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="company" value="{{$experience->company}}" placeholder="Enter Comapany Name">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-4">
                                        <label>From Year <small class="text-danger">*</small></label>
                                        <input type="month" value="{{$experience->from_year}}" class="form-control fromYear" name="from_year">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-4">
                                        <label>To Year <small class="text-danger">*</small></label>
                                        <input type="month" min="{{$experience->from_year}}" value="{{$experience->to_year}}" @if($experience->to_year == 'current') disabled @endif class="form-control toYear" name="to_year" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-4">
                                        <label>Current</label>
                                        <br>
                                        <input type="checkbox" name="current" @if($experience->to_year == 'current') checked @endif class="current">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" rows="10" name="des">{{$experience->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1" {{($experience->status == "1" ? "selected":"") }}>Show</option>
                                            <option value="0" {{($experience->status == "0" ? "selected":"") }}>Hide</option>
                                        </select>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            @endif
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