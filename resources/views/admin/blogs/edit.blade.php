@extends('admin.layout')
@section('title','Edit Blog : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Blog'=>'admin/blogs']])
    @slot('title') Edit Blog @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Blog @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updateBlog"  method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/blogs/'.$blog->id)}}" >
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
                                        <label>Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="title" value="{{$blog->title}}" placeholder="Enter Blog Title">
                                        <input type="text" hidden name="id" value="{{$blog->id}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Slug <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="slug" value="{{$blog->slug}}" placeholder="Enter Blog Slug">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Category <small class="text-danger">*</small></label>
                                        <select class="form-control agent" name="category">
                                            <option disabled selected value="" >Select Category Name</option>
                                            @if(!empty($category))
                                                @foreach($category as $types)
                                                    @if($blog->category == $types->id)
                                                        <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                        @else
                                                        <option value="{{$types->id}}">{{$types->title}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Meta Tags</label>
                                        <input id="tokenfield" type="text" class="form-control" name="tags"  value="{{$blog->tags}}" placeholder="Type and hit enter to add a tag">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1" {{($blog->status == "1" ? "selected":"")}}>Publish</option>
                                            <option value="0" {{($blog->status == "0" ? "selected":"")}}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_des" class="form-control" placeholder="Place some text here">{!!htmlspecialchars_decode($blog->short_desc)!!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="textarea" name="des" class="form-control" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!htmlspecialchars_decode($blog->description)!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Image </label>
                                <div class="custom-file col-md-7">
                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$blog->image}}" />
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-3 text-right">
                                    @if($blog->image != '')
                                    <img id="image" src="{{asset('public/blog/'.$blog->image)}}" alt="" width="80px" height="80px">
                                    @else
                                    <img id="image" src="{{asset('public/blog/default.png')}}" alt="" width="80px" height="80px">
                                    @endif
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