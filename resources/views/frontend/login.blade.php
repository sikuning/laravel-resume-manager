@extends('frontend.layout')
@section('title','Login : ')
@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Login</h3>
            <form  class="form-horizontal" id="userLogin" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Username</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-2">LogIn</button>
                <a href="{{url('forgot-password')}}" class="forgot align-items-end">Forgot Password?</a>
                <!-- <input type="submit" class="btn btn-primary" value="Login"> -->
            </form>
        </div>
    </div>
</div> --}}
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Login @endslot
    @slot('active') Login  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form id="userLogin" class="position-relative" method="POST">
                <h3>Welcome Back!</h3>
                @csrf
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="d-flex justify-content-between">
                    <input type="submit" class="btn btn-default" value="Login"/>
                    <a href="{{url('forgot-password')}}" class="forgot align-items-end">Forgot Password?</a>
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