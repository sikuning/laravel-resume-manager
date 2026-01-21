@extends('admin.layout')
@section('title','Edit Page : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','All Pages'=>'admin/pages']])
    @slot('title') Edit Page @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Page @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updatePage" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                   <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Page Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Page Title</span>
                                    </div>
                                    {{method_field('PUT')}}
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="title" value="{{$page->page_title}}" placeholder="Enter Page Title">
                                        <input type="text" hidden class="url" value="{{url('admin/pages/'.$page->id)}}">
                                        <input type="text" hidden name="id" value="{{$page->id}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Page Slug</span>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="slug" value="{{$page->page_slug}}" placeholder="Enter Page Slug">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Description</span>
                                    </div>
                                    <div class="col-md-10">
                                        <textarea id="summernote" class="form-control" name="des" rows="5" placeholder="Place some text here">{!!$page->description!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Status</span>
                                    </div>
                                    <div class="col-md-10">
                                        <select name="status" class="form-control">
                                            <option value="1" @if($page->status == '1') selected @endif>Active</option>
                                            <option value="0" @if($page->status == '0') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12"> 
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </div>
        </form> <!-- /.form start -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop
@section('pageJsScripts')
<script type="text/javascript">
$('#summernote').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['pic', ['picture', 'link', 'table','hr']],
    ['screen', ['fullscreen', 'codeview', 'help']],
    ]
});
</script>
@endsection