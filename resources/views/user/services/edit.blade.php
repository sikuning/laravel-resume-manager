@extends('user.layout')
@section('title','Edit Service : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','Services'=>'user/services']])
    @slot('title') Edit Services @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Services @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updateService"  method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($service)
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('user/services/'.$service->id)}}" >
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Service Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <div class="form-group">
                                            <label>Title <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="title" placeholder="Name" value="{{$service->title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1" {{($service->status == "1" ? "selected":"")}}>Show</option>
                                            <option value="0" {{($service->status == "0" ? "selected":"")}}>Hide</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" rows="5" name="des">{!!htmlspecialchars_decode($service->description)!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Image <small class="text-danger">*</small></label>
                                <div class="custom-file col-md-3">
                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$service->image}}" />
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-1 text-right">
                                    @if($service->image != '')
                                    <img id="image" src="{{asset('public/user_service/'.$service->image)}}" alt="" width="80px" height="80px">
                                    @else
                                    <img id="image" src="{{asset('public/user_service/default.png')}}" alt="" width="80px" height="80px">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Icon </label>
                                <div class="input-group col-md-4">
                                    <input type="text" name="icon" class="form-control" value="{{$service->icon}}" id="icon" value="">
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="target" data-icon="{{$service->icon}}" role="iconpicker"></button>
                                    </span>
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