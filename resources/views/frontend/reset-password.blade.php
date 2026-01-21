@extends('frontend.layout')
@section('title',' Reset Password : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Reset Password @endslot
    @slot('active') Reset Password  @endslot
@endcomponent
<div class="container py-5" id="main-content">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form class="form-horizontal" id="user-resetPassword" method="POST">
                <h3>Enter New Password</h3>
                @csrf
                <div class="message"></div>
                <div class="form-group mb-3">
                    <label>New Password</label>
                    <input type="hidden" name="id"  class="url" value="{{$user[0]['id']}}">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                </div>
                <input type="submit" class="btn btn-primary btn-block mb-2" value="Reset Password">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection
@section('pageStyleLinks')
<link rel="stylesheet" href="{{asset('public/assets/css/sweetalert-bootstrap-4.min.css')}}">
@endsection
@section('pageJsScripts')
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
     <!-- SweetAlert -->
    <script src="{{asset('public/assets/js/sweetalert2.min.js')}}"></script>
    <!-- user.js -->
    <script src="{{asset('public/frontend/js/action.js')}}"></script>
@endsection