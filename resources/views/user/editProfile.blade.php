@extends('user.layout')
@section('title','Edit Profile : ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('user.components.content-header',['breadcrumb'=>['MyProfile'=>'user/my_profile']])
        @slot('title') Edit Profile @endslot
          @slot('add_btn')  @endslot
        @slot('active') Edit Profile  @endslot
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
                                <h3 class="card-title">Edit Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form class="form-horizontal" id="updateUserProfile" method="POST">
                                            {{ csrf_field() }}
                                            @if($user)
                                            <input type="hidden" class="url" value="{{url('user/my-profile/'.$user->id)}}" >
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Full Name<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Enter Full Name">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Personal Slug<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control user-link" name="slug" value="{{$user->user_slug}}" placeholder="Personal Link">
                                                <div class="exist"></div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Designation<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="designation" value="{{$user->designation}}" placeholder="Enter User Designation">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Gender<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <select name="gender" class="form-control">
                                                        <option value="" @if($user->gender == '') selected disabled @endif>Not Selected</option>
                                                        <option value="M" @if($user->gender == 'M') selected  @endif>Male</option>
                                                        <option value="F" @if($user->gender == 'F') selected  @endif>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Date of Birth<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" name="dob" value="{{$user->dob}}" placeholder="DOB">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-4">
                                                    <input type="email" class="form-control" disabled value="{{$user->email}}" placeholder="Enter User Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Phone<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Enter User Phone Number">
                                                </div>
                                                <label class="col-sm-2 col-form-label">City</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="city" value="{{$user->city}}" placeholder="Enter User City Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pincode</label>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control" name="pincode" value="{{$user->pincode}}" placeholder="City Pincode">
                                                </div>
                                                <label class="col-sm-2 col-form-label">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="state" value="{{$user->state}}" placeholder="Enter User State Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Country<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="country" value="{{$user->country}}" placeholder="Enter User Country Name">
                                                </div>
                                                <label class="col-md-2">Photo </label>
                                                <div class="custom-file col-md-3">
                                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$user->image}}" />
                                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                                <div class="col-md-1 text-right">
                                                    @if($user->image != '')
                                                    <img id="image" src="{{asset('public/user_profile/'.$user->image)}}" alt="" width="80px" height="80px">
                                                    @else
                                                    <img id="image" src="{{asset('public/user_profile/default.png')}}" alt="" width="80px" height="80px">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2">Show Gender </label>
                                                <div class="col-md-4">
                                                    <div class="page-checkbox">
                                                        <input type="checkbox" name="show_gender" id="show_gender" @if($user->show_gender == '1') checked @endif>
                                                        <label for="show_gender"></label>
                                                    </div>
                                                </div>
                                                <label class="col-md-2">Show DOB </label>
                                                <div class="col-md-3">
                                                    <div class="page-checkbox">
                                                        <input type="checkbox" name="show_dob" id="show_dob" @if($user->show_dob == '1') checked @endif>
                                                        <label for="show_dob"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2">About Me </label>
                                                <div class="col-md-10">
                                                    <textarea name="about_me" class="form-control" cols="30" rows="5">{{$user->about_me}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            @endif
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