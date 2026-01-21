@extends('user.layout')
@section('title','Hero Section : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Hero Section @endslot
          @slot('add_btn')  @endslot
        @slot('active') Hero Section  @endslot
    @endcomponent
    <!-- /.content-header -->
    <section class="content card">
        <div class="container-fluid card-body">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Hero Section</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form class="form-horizontal" id="updateHeroSection" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pre Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="pre_title" placeholder="Text Before Title" value="{{$data->pre_title}}">
                                                    <small>(Leave empty if you wanna hide this.)</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="title"  placeholder="Title" value="{{$data->title}}">
                                                    <small>(Leave empty if you wanna hide this.)</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Sub Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="sub_title" placeholder="Sub Title" value="{{$data->sub_title}}">
                                                    <small>(Leave empty if you wanna hide this.)</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Show Contact Button</label>
                                                <div class="col-sm-3">
                                                    <div class="page-checkbox mt-2">
                                                        @php $contactCheck = ($data->show_contact_btn == '1') ? 'checked' : '';  @endphp
                                                        <input type="checkbox" name="contact_btn" id="contactBtn" {{$contactCheck}}>
                                                        <label for="contactBtn"></label>
                                                    </div>
                                                </div>
                                                <label class="col-sm-3 col-form-label">Show Portfolio Button</label>
                                                <div class="col-sm-3">
                                                    <div class="page-checkbox mt-2">
                                                        @php $portfolioCheck = ($data->show_contact_btn == '1') ? 'checked' : '';  @endphp
                                                        <input type="checkbox" name="portfolio_btn" id="portfolioBtn" {{$portfolioCheck}}>
                                                        <label for="portfolioBtn"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2">Image </label>
                                                <div class="custom-file col-md-7">
                                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$data->image}}" />
                                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <div class="col-md-1 text-right">
                                                    @if($data->image != '')
                                                    <img id="image" src="{{asset('public/hero-section/'.$data->image)}}" alt="" width="80px" height="80px">
                                                    @else
                                                    <img id="image" src="{{asset('public/hero-section/default.png')}}" alt="" width="80px" height="80px">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <input type="submit" class="btn btn-primary" value="Update" />
                                                </div>
                                            </div>
                                        </form>
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
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    
    
</div>
@stop

@section('pageJsScripts')
    <script>
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