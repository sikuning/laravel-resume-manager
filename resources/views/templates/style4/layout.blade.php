
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->username}} Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    @include('templates.style')
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0 flex-column text-center">
            <div class="d-flex navbrand-box justify-content-between">
                <a class="navbar-brand" href="#">{{$user->username}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-column align-self-start">
                <li class="nav-item">
                    <a class="nav-link" href="#user-section"><i class="fa fa-home"></i>Home</a>
                </li>
                @foreach($preferences as $row)
                <li class="nav-item">
                    <a class="nav-link" href="#{{strtolower($row->title)}}-section">{{$row->title}}</a>
                </li>
                @endforeach
                </ul>
            </div>
        </nav>
        <div id="page-content">
            <section id="user-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 py-5">
                            <span>{{$hero_section->pre_title}}</span>
                            <h1>{{$hero_section->title}}</h1>
                            <h3>{{$hero_section->sub_title}}</h3>
                            <ul>
                            @if($hero_section->show_portfolio_btn == '1')
                            <li><a href="#portfolio-section">My work</a></li>
                            @endif
                            @if($hero_section->show_contact_btn == '1')
                            <li><a href="#contact-section">Contact Me</a></li>
                            @endif
                        </ul>
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
        <section id="about-section" class="gray-background py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-head">
                            <h3>About Me</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="about-img">
                            @if($user->image != '')
                                <img src="{{asset('public/user_profile/'.$user->image)}}" alt="">
                            @else
                                <img src="{{asset('public/user_profile/default.png')}}"  alt="">
                            @endif
                            <ul>
                                @foreach($social_links as $social)
                                <li><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="user-about">
                            <h3>{{$user->username}}</h3>
                            <span>{{$user->designation}}</span>
                            <p>{{$user->about_me}}</p>
                            <ul class="mb-3">
                                @if($user->show_dob == '1' && $user->dob != '')
                                <li><span>Birthday</span> {{date('d M, Y',strtotime($user->dob))}} </li>
                                @endif
                                @if($user->show_gender == '1' && $user->gender != '')
                                <li><span>Gender</span> {{($user->gender == 'M') ? 'Male' : 'Female'}} </li>
                                @endif
                                <li><span>Address</span> @if($user->city != '')
                                    {{$user->city}}
                                @endif
                                @if($user->pincode != '')
                                -{{$user->pincode}},
                                @endif
                                @if($user->state != '')
                                {{$user->state}},
                                @endif </li>
                                <li><span>Country</span> {{$user->country}} </li>
                                <li><span>Email</span> {{$user->email}} </li>
                                <li><span>Phone</span> {{$user->phone}} </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @foreach($preferences as $row)
            @include('templates.'.$user->layout.'.'.strtolower($row->title))
        @endforeach
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        Copyright {{date('Y')}} <a href="{{url('/')}}">{{site_settings()->com_name}}</a>. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
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
                    items:2
                }
            }
        })
    </script>
</body>
</html>