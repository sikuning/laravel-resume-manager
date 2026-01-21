@extends('admin.layout')
@section('title','Add New Blog : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Blog'=>'admin/blogs']])
    @slot('title') Add Blog @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Blog @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="addBlog"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Blog Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Title Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Blog Title Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Category <small class="text-danger">*</small></label>
                                        <select class="form-control agent" name="category">
                                            <option disabled selected value="" >Select Category Name</option>
                                            @if(!empty($category))
                                                @foreach($category as $types)
                                                <option value="{{$types->id}}">{{$types->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Meta Tags</label>
                                        <input id="tokenfield" type="text" class="form-control" name="tags" placeholder="Type and hit enter to add a tag">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_des" class="form-control" placeholder="Place some text here"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="textarea form-control" name="des" placeholder="Place some text here" style=""></textarea>
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
                                    <img id="image" src="{{asset('public/blog/default.png')}}" alt=""  width="80px" height="80px">
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
@section('pageJsScripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
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

    $('#tokenfield').tokenfield({
        autocomplete: {
            delay: 100
        },
        showAutocompleteOnFocus: false
    });
</script>
@stop