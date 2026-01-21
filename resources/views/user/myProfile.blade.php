@extends('user.layout')
@section('title','My Profile : ')
@section('content')
<!-- Main content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">My Profile</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="d-flex flex-column">
                                    @if($data->image != '')
                                    <img class="img-circle user-img mb-3 border p-2" src="{{asset('public/user_profile/'.$data->image)}}" alt="User profile picture">
                                    @else
                                    <img class="img-circle user-img mb-3 border p-2" src="{{asset('public/user_profile/default.png')}}" alt="User profile picture">
                                    @endif
                                    <a href="{{url('user/edit-profile')}}" class="btn btn-primary">Edit Profile <i class="fa fa-edit"></i></a>
                                </div>
                                <div class="ml-3 flex-grow-1">
                                    <ul class="list-group">
                                        <li class="list-group-item"><b>Name :</b> {{$data->username}}</li>
                                        <li class="list-group-item"><b>Personal Slug :</b><br> {{url('/').'/'.$data->user_slug}}</li>
                                        <li class="list-group-item"><b>Designation :</b> 
                                        {{$data->designation}}
                                        </li>
                                        <li class="list-group-item"><b>DOB :</b>
                                        @if($data->dob != '')
                                        {{date('d M, Y',strtotime($data->dob))}}
                                        @endif
                                        </li>
                                        <li class="list-group-item"><b>Gender :</b> @if($data->gender != '')
                                            @if($data->gender == 'M')
                                               Male
                                            @else
                                                Female
                                            @endif
                                        @endif</li>
                                        <li class="list-group-item"><b>Location :</b> 
                                        @if($data->city != '')
                                            {{$data->city}}
                                        @endif
                                        @if($data->pincode != '')
                                        -{{$data->pincode}},
                                        @endif
                                        @if($data->state != '')
                                        {{$data->state}},
                                        @endif
                                        {{$data->country}}</li>
                                        <li class="list-group-item"><b>Email :</b> {{$data->email}}</li>
                                        <li class="list-group-item"><b>Phone :</b> {{$data->phone}}</li>
                                        <li class="list-group-item"><b>About :</b></li>
                                        <li class="list-group-item">{{$data->about_me}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Preferences</h3>
                        </div>
                        <div class="card-body">
                            <ul id="sortable" class="list-group preference-list mb-4">
                                @foreach($preference as $item)
                                <li class="list-group-item d-flex justify-content-between" data-id="{{$item->id}}">
                                    <span><i class="fa fa-sort mr-2"></i> {{$item->title}}</span>
                                    @php $checked = ($item->status == '1') ? 'checked' : ''; @endphp
                                    <div class="page-checkbox">
                                        <input type="checkbox" class="show-in-status" id="p{{$item->id}}" {{$checked}}>
                                        <label for="p{{$item->id}}"></label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-primary save-preference-order">Save Order</button>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
@section('pageJsScripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
          $( "#sortable" ).sortable();
        });
        
        </script>
@endsection