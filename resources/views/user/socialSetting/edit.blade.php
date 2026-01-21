@extends('user.layout')
@section('title','Edit Social Link : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','Social Setting'=>'user/social-settings']])
    @slot('title') Edit Social Link @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Social Link @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="updateUsersocial"  method="POST" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            @if($social)
            <div class="row">
                <!-- column -->
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('user/social-settings/'.$social->id)}}" >
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Social Setting Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Social Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Social Setting Name" value="{{$social->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Social Url Name</label>
                                        <input type="text" name="url" class="form-control" placeholder="Enter Social Setting Url Name" value="{{$social->url}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <div class="input-group">
                                            <input type="text" name="icon" class="form-control" id="icon" value="{{$social->icon}}">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="target" data-icon="{{$social->icon}}" role="iconpicker"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$social->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$social->status == '0' ? "selected":""}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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