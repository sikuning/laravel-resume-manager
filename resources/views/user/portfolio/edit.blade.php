@extends('user.layout')
@section('title','Edit Portfolio : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','Portfolio'=>'user/portfolio']])
    @slot('title') Edit Portfolio @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Portfolio @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updatePortfolio"  method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" class="url" value="{{url('user/portfolio/'.$portfolio->id)}}" >
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Portfolio Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <div class="form-group">
                                            <label>Portfolio Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="title" value="{{$portfolio->title}}" placeholder="Enter Portfolio Name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Category <small class="text-danger">*</small></label>
                                        <select class="form-control" name="category">
                                            <option disabled selected value="" >Select Category</option>
                                            @foreach($category as $cat)
                                            @php $checked = ($cat->id == $portfolio->category) ? 'selected' : '';  @endphp
                                            <option value="{{$cat->id}}" {{$checked}} >{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Project Link <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" value="{{$portfolio->link}}" name="link" placeholder="Enter Project Link Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1" @if($portfolio->status == '1') selected @endif>Show</option>
                                            <option value="0" @if($portfolio->status == '0') selected @endif>Hide</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group mb-4">
                                        <label>Details</label>
                                        <textarea type="text" class="form-control" row="5" name="des">{{$portfolio->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Image </label>
                                <input type="text" hidden name="old_img" value="{{$portfolio->image}}">
                                <div class="custom-file col-md-7">
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-3 text-right">
                                    @if($portfolio->image != '')
                                        <img id="image" src="{{asset('public/portfolio/'.$portfolio->image)}}" alt="" width="80px" height="80px">
                                    @else
                                        <img id="image" src="{{asset('public/portfolio/default.png')}}" alt="" width="80px" height="80px">
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