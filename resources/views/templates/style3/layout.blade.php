
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    @include('templates.style')
    <title>{{$user->username}} Profile</title>
</head>
<body>
    <div id="wrapper">
        <header id="header" class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light py-4">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            @foreach($preferences as $row)
                            <li class="nav-item">
                                <a class="nav-link" href="#{{strtolower($row->title)}}-section">{{$row->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <ul class="d-flex header-contact-info order-1 order-lg-2">
                        <li>{{$user->email}}</li>
                        <li>{{$user->phone}}</li>
                    </ul>
                </div>
            </nav>
        </header>
        <section id="user-section" class="pt-5">
            <div class="container">
                <div class="row border-bottom pb-5">
                    <div class="col-md-8">
                        <span class="text-span">{{$hero_section->pre_title}}</span>
                        <h1>{{$hero_section->title}}</h1>
                    </div>
                    <div class="col-md-4">
                        @if($hero_section->image != '')
                            <img src="{{asset('public/hero-section/'.$hero_section->image)}}" alt="">
                        @else
                            <img src="{{asset('public/hero-section/default.png')}}"  alt="">
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section id="about-section" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="text-span">About Me</span>
                        <h2>{{$user->about_me}}</h2>
                    </div>
                </div>
            </div>
        </section>
        @foreach($preferences as $row)
            @include('templates.'.$user->layout.'.'.strtolower($row->title))
        @endforeach
        <footer id="footer" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        Copyright {{date('Y')}} <a href="{{url('/')}}">{{site_settings()->com_name}}</a>. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('templates.script')
    <script>
        $('.testimonial-carousel').owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
</body>
</html>