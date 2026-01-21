@extends('user.layout')
@section('title','Change Password : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Change Password @endslot
          @slot('add_btn')  @endslot
        @slot('active') Change Password  @endslot
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
                                <h3 class="card-title">Set New Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form class="form-horizontal" id="updateUserPassword" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Current Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control"  name="password" placeholder="Current Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">New Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="password" name="new"  placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="new_confirm" placeholder="Confirm Password">
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

@stop