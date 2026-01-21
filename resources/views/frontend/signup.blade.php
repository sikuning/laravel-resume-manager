@extends('frontend.layout')
@section('title','Create Profile : ')
@section('content')
@component('frontend.partials.page-header',['breadcrumb'=>['Home'=>'/']])
    @slot('title') Create Profile @endslot
    @slot('active') Create Profile  @endslot
@endcomponent
<div id="main-content" class="container py-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form id="user-signup" class="position-relative" method ="POST">
                <h3>Create Your Profile</h3>
                @csrf
                <div class="form-group mb-3">
                    <label for="">UserName</label>
                    <input type="text" class="form-control" name="username" placeholder="Your Name">
                </div>
                <div class="form-group mb-3">
                    <label for="">Designation</label>
                    <input type="text" class="form-control" name="designation" placeholder="Your Designation">
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone</label>
                    <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                </div>
                <div class="form-group mb-3">
                    <label for="">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country Name">
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="con_password" placeholder="Re-enter Password">
                </div>
                {{-- <button type="submit" class="btn btn-primary btn-block mb-2">Signup</button> --}}
                <input type="submit" class="btn btn-primary" value="Signup"> 
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
    <input type="hidden" class="site-url" value="{{url('/')}}"></input>
@endsection