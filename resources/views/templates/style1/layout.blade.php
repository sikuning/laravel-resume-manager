
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
    <div id="wrapper">
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top p-4">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#user-section">Home</a>
                        </li>
                        @foreach($preferences as $row)
                            <li class="nav-item">
                                <a class="nav-link" href="#{{strtolower($row->title)}}-section">{{$row->title}}</a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <ul class="d-flex social-links order-1 order-lg-2">
                        @foreach($social_links as $social)
                        <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </header>
        <section id="user-section" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 d-flex flex-column order-2 order-md-1">
                        <h1 class="mt-auto">{{$hero_section->pre_title}}</h1>
                        <h2 class="mb-auto">{{$hero_section->title}}</h2>
                        <ul class="d-flex mb-auto">
                            @foreach($preferences as $row)
                            @if($row->title == 'Portfolio' && $row->status == '1' && $portfolios->isNotEmpty() && $hero_section->show_portfolio_btn == '1')
                            <li><a href="#portfolio-section">View my works</a></li>
                            @endif
                            @if($row->title == 'Contact' && $row->status == '1' && $hero_section->show_contact_btn == '1')
                            <li><a href="#contact-section">Contact Me <i class="fa fa-arrow-down"></i></a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4 order-1 order-md-2">
                        <div class="user-img">
                            @if($hero_section->image != '')
                                <img src="{{asset('public/hero-section/'.$hero_section->image)}}" alt="">
                            @else
                                <img src="{{asset('public/hero-section/default.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    </div>
    <script src="{{asset('public/templates/js/bootstrap5.min.js')}}"></script>
    <script src="{{asset('public/templates/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/templates/js/jquery.validate.min.js')}}"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <input type="text" hidden class="site-url" value="{{url('/')}}">
    <script src="{{asset('public/templates/js/template.js')}}"></script>
</body>
</html>