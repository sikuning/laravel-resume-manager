@extends('frontend.layout')
@section('title','Forgot Password : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Forgot Password @endslot
    @slot('active') Forgot Password  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form class="form-horizontal position-relative" id="user-forgotPassword" method="POST">
                <h3>Enter your email</h3>
                @csrf
                <div class="message"></div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="d-flex justify-content-between">
                    <input type="submit" class="btn btn-primary btn-block mb-2" value="Submit">
                    <span class="create-new"><a href="{{url('login')}}">Back to Login</a></span>
                </div>
            </form>
        </div>
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