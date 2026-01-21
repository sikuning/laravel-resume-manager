<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->username}} Profile</title>
    <link href="{{asset('public/templates/css/bootstrap5.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Glass+Antiqua&family=Manrope:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/templates/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/templates/css/'.$user->layout.'.css')}}" />
</head>
<body>
    <header id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#header">Home</a>
                        </li>
                        @foreach($preferences as $row)
                        <li class="nav-item">
                            <a class="nav-link" href="#{{strtolower($row->title)}}-section">{{$row->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="row">
                <div class=" offset-3 col-6">
                    <div class="user-info">
                        <div class="user-img">
                            @if($user->image != '')
                                <img src="{{asset('public/user_profile/'.$user->image)}}" alt="">
                            @else
                                <img src="{{asset('public/user_profile/default.png')}}" alt="">
                            @endif
                        </div>
                        <h2>{{$user->username}}</h2>
                        <h4>{{$user->designation}}</h4>
                        <ul >
                            @if($user->show_dob == '1' && $user->dob != NULL && $user->dob != '')
                            <li><strong>Born :</strong>
                                {{date('d M, Y',strtotime($user->dob))}}
                            </li>
                            @endif
                            @if($user->show_gender == '1')
                            @if($user->gender != '')
                            <li><strong>Gender :</strong>
                                {{($user->gender == 'M') ? 'Male' : 'Female'}}
                                @endif</li>
                            @endif
                            <li><strong>Email :</strong> {{$user->email}}</li>
                            <li><strong>Phone :</strong> {{$user->phone}}</li>
                        </ul>
                        <ul class="social-contact">
                            @foreach($social_links as $social)
                            <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @foreach($preferences as $row)
        @include('templates.'.$user->layout.'.'.strtolower($row->title))
    @endforeach
    <footer id="footer" class="container-fluid">
        <div class="row">
            <div class="col-12">
                Copyright {{date('Y')}} <a href="{{url('/')}}">{{site_settings()->com_name}}</a>. All rights reserved.
            </div>
        </div>
    </footer>
    <script src="{{asset('public/templates/js/bootstrap5.min.js')}}"></script>
    <script src="{{asset('public/templates/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/templates/js/jquery.validate.min.js')}}"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <input type="text" hidden class="site-url" value="{{url('/')}}">
    <script src="{{asset('public/templates/js/template.js')}}"></script>
</body>
</html>