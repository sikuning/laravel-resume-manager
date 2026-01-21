{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('public/siteimg/logo.png')}}" width="220px" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            @if(session()->has('username'))
                                <li class="nav-item"><a class="nav-link" href="{{url('dashboard')}}">View Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{url('layout')}}">View Layout</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{url('login')}}">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{url('signup')}}">Create Profile</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main-content">
            @yield('content')
        </div>
        <footer id="footer">
            <!-- jQuery UI 1.11.4 -->
            <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
            <!-- jquery-validation -->
            <script src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
             <!-- SweetAlert -->
            <script src="{{asset('public/assets/js/sweetalert2.min.js')}}"></script>
            <!-- user.js -->
            <script src="{{asset('public/assets/js/user-action.js')}}"></script>
            <input type="hidden" class="demo" value="{{url('/')}}"></input>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @php $site_settings = site_settings(); 
    $pages = custom_pages();
    @endphp
    <title>@yield('title'){{$site_settings->com_name}}</title>
    @include('frontend.partials.header-links')
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-xl container-fluid">
                    <div class="d-flex mb-2 mb-sm-0 me-0 me-md-2 justify-content-between col-12 col-sm-auto">
                        <a class="navbar-brand" href="{{url('/')}}">
                            @if($site_settings->com_logo != '')
                            <img src="{{asset('public/frontend/images/'.$site_settings->com_logo)}}" class="logo" alt="{{$site_settings->com_name}}">
                            @else
                                <span>{{$site_settings->com_name}}</span>
                            @endif
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                  <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('blog')}}">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('layouts')}}">Layouts</a>
                      </li>
                      @foreach($pages as $page)
                      @if($page->show_in_header == '1')
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('p/'.$page->page_slug)}}">{{$page->page_title}}</a>
                        </li>
                      @endif
                      @endforeach
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}">Contact</a>
                      </li>
                    </ul>
                  </div>
                  <div class="d-flex col-12 justify-content-center col-sm-auto order-2 order-lg-3">
                    @if(session()->has('username'))
                    <a href="{{url('user/my-profile')}}" class="btn btn-primary me-2">View Dashboard <i class="fa fa-list"></i></a>
                    <a href="{{url(session()->get('user_slug'))}}" class="btn btn-outline-primary" target="_blank">View Profile <i class="fa fa-eye"></i></a>
                    @else
                    <a href="{{url('login')}}" class="btn btn-primary me-2">Login <i class="fa fa-sign-in"></i></a>
                    <a href="{{url('signup')}}" class="btn btn-outline-primary">Create Profile <i class="fa fa-edit"></i></a>
                    @endif
                  </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer id="footer" class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <img src="{{asset('public/frontend/images/resume.png')}}" class="logo mb-3" alt="">
                        <p class="mb-3">{{$site_settings->description}}</p>
                        @php $social_links = social_links(); @endphp
                        <ul class="footer-social-links">
                            @if($social_links->twitter != '')
                            <li><a href="{{$social_links->twitter}}" target="_blank"><i class="fab fa-x-twitter"></i></a></li>
                            @endif
                            @if($social_links->facebook != '')
                            <li><a href="{{$social_links->facebook}}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            @endif
                            @if($social_links->instagram != '')
                            <li><a href="{{$social_links->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($social_links->you_tube != '')
                            <li><a href="{{$social_links->you_tube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    @php 
                    $footer_pages = [];
                    foreach($pages as $page){
                        if($page->show_in_footer == '1'){
                        array_push($footer_pages,$page);
                        }
                    }
                    @endphp
                    @if($footer_pages)
                    <div class="col-md-5">
                        <h4 class="footer-section-head mb-3">Useful Links</h4>
                        <ul class="footer-links">
                            @foreach($footer_pages as $page)
                            @if($page->show_in_footer == '1')
                                <li><a class="nav-link p-0" href="{{url('p/'.$page->page_slug)}}">{{$page->page_title}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <div class="container-fluid footer-bottom">
                <div class="row">
                    <div class="col-12 text-center py-3">
                        <span>{{$site_settings->footer_copyright}}</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('frontend.partials.footer-scripts')
</body>
</html>