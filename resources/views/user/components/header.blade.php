

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    @php $siteInfo = site_settings(); @endphp
    <title>@yield('title'){{$siteInfo->com_name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="{{asset('public/assets/fontawesome-free/css/all.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('public/assets/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/assets/css/dataTables.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/assets/css/adminlte.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public/assets/css/summernote-bs4.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public/assets/css/sweetalert-bootstrap-4.min.css')}}">
    <!-- Tokenfield for Bootstrap-->
    <link rel="stylesheet" href="{{asset('public/assets/css/tokenfield.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('public/assets/css/trumbowyg.min.css')}}"> -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/assets/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/fontawesome-free/css/all.min.css')}}">
    <!-- Style.CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .user-img{
            height: 200px;
            width: 200px;
            object-fit: cover;
        }
        .page-checkbox{
        display: inline-block;
        position: relative;
        }
        .page-checkbox input[type=checkbox]{
            margin: 0;
            visibility: hidden;
            position: absolute;
            left: 1px;
            top: 1px;
        }
        .page-checkbox label{
            width: 35px;
            height: 22px;
            margin: 0;
            border: 3px solid #555;
            border-radius: 100px;
            cursor: pointer;
            display: block;
            overflow: hidden;
            position: relative;
            transition: all 0.75s ease;
        }
        .page-checkbox label:before,
        .page-checkbox label:after{
            content: '';
            background: #555;
            border-radius: 50px;
            width: 14px;
            height: 14px;
            position: absolute;
            top: 1px;
            left: 2px;
            opacity: 1;
            transition: 0.75s ease;
        }
        .page-checkbox label:after{
            left: auto;
            right: 2px;
            opacity: 0;
        }
        .page-checkbox input[type=checkbox]:checked+label{
            border-color: #0da333;
            box-shadow: 0 0 5px rgba(13, 163, 21, 0.4);
        }
        .page-checkbox input[type=checkbox]:checked+label:before{ opacity: 0; }
        .page-checkbox input[type=checkbox]:checked+label:after{
            background-color: #0da333;
            opacity: 1;
        }
        @media only screen and (max-width:767px){
            .page-checkbox{ margin: 0 0 20px; }
        }
        .checkbox{
            margin: 0;
            display: inline-block;
            position: absolute;
            top: -17px;
        }
        .checkbox input[type=checkbox]{
            margin: 0;
            visibility: hidden;
            left: 1px;
            top: 1px;
        }
        .checkbox label{
            background: #bbb;
            width: 36px;
            height: 14px;
            min-height: auto;
            padding: 0;
            cursor: pointer;
            border-radius: 50px;
            display: block;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease 0s;
        }
        .checkbox label:before{
            content: '';
            background: #fff;
            width: 20px;
            height: 20px;
            border-radius: 40px;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
                        0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 0 0 16px rgba(0, 108, 181, 0);
            transform: translateY(-50%);
            position: absolute;
            top: 50%;
            left: -2px;
            transition: all 0.26s ease 0s;
        }
        /* .checkbox label:active:before{
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
                        0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 0 0 16px rgba(255,20,231, 0.6);
        } */
        .checkbox input[type=checkbox]:checked+label{
            background: #e8ebf1;
            transition: all 0.25s ease 0s;
        }
        .checkbox input[type=checkbox]:checked+label:before{
            background: #0abb75;
            left: 18px;
        }
        @media only screen and (max-width:767px){
            .checkbox{ margin: 0 0 20px; }
        }

        .layout-box{
            position: relative;
            padding: 0;
            margin: 0 15px 0 0;
        }

        .layout-box input{
            visibility: hidden;
            position: absolute;
            left: 0;
            top: 0;
        }

        .layout-box label{
            width: 200px;
            border: 5px solid #ccc;
        }

        .layout-box label img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .layout-box input:checked + label{
            border: 5px solid #007BFF;
            box-shadow: 0 0 5px #007BFF;
        }

        
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper position-relative">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{url('/'.session()->get('user_slug'))}}" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> View Profile</a>
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                      Hello,{{session()->get('username')}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="width:180px;">
                        <li class="nav-item text-center"><a href="{{url('user/change-password')}}" class="nav-link">Change Password</a></li>
                        <li class="nav-item text-center user-logout"><a href="javascript:void(0)" class="nav-link">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
