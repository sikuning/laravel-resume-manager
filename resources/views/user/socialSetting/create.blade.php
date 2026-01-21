@extends('user.layout')
@section('title','Add Social Link : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile','SocialSetting'=>'user/social-settings']])
    @slot('title') Add Social Link @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Social Link @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="addUserSocial" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Social Setting Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Social Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Social Setting Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Social Url</label>
                                        <input type="text" name="url" class="form-control" placeholder="Social Setting Url Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <div class="input-group">
                                            <input type="text" name="icon" class="form-control" id="icon" value="">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="target" data-icon="fas fa-home" role="iconpicker"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop