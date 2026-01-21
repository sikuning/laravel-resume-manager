<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    @php $siteInfo = site_settings();  @endphp
    <a href="#" class="brand-link bg-white">
        <img src="{{asset('public/frontend/images/'.$siteInfo->com_logo)}}" width="100%" alt="">
    </a> 
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="javascript:void(0)" class="d-block"><b>{{session()->get('username')}}</b></a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{url('user/my-profile')}}" class="nav-link {{(Request::path() == 'user/my-profile')? 'active':''}}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>My Profile </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('user/services')}}" class="nav-link {{(Request::path() == 'user/services')? 'active':''}}">
                    <i class="nav-icon fa fa-wrench"></i>
                    <p>Services</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('user/skill')}}" class="nav-link {{(Request::path() == 'user/skill')? 'active':''}}">
                    <i class="nav-icon fa fa-cogs"></i>
                    <p>Skill</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('user/experience')}}" class="nav-link {{(Request::path() == 'user/experience')? 'active':''}}">
                    <i class="nav-icon fa fa-book"></i>
                    <p>Experience</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('user/testimonial')}}" class="nav-link {{(Request::path() == 'user/testimonial')? 'active':''}}">
                    <i class="nav-icon fa fa-comment"></i>
                    <p>Testimonial</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{(Request::path() == 'user/category' || Request::path() == 'user/portfolio')? 'menu-open':''}}">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>Portfolios<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('user/portfolio')}}" class="nav-link {{(Request::path() == 'user/portfolio')? 'active bg-primary':''}}">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>All Portfolios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('user/category')}}" class="nav-link {{(Request::path() == 'user/category')? 'active bg-primary':''}}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Portfolio Category</p>
                        </a>
                    </li>
                    
                </ul> 
            </li>
            <li class="nav-item">
                <a href="{{url('user/hero-section')}}" class="nav-link {{(Request::path() == 'user/hero-section')? 'active':''}}">
                    <i class="nav-icon fa fa-list"></i>
                    <p>Hero Section</p>
                </a>
            </li>    
            <li class="nav-item">
                <a href="{{url('user/social-settings')}}" class="nav-link {{(Request::path() == 'user/social-settings')? 'active':''}}">
                    <i class="nav-icon fa fa-list"></i>
                    <p>Social Setting</p>
                </a>
            </li>    
            <li class="nav-item">
                <a href="{{url('user/layouts')}}" class="nav-link {{(Request::path() == 'user/layouts')? 'active':''}}">
                    <i class="nav-icon fa fa-copy"></i>
                    <p>Layouts</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('user/contact')}}" class="nav-link {{(Request::path() == 'user/contact')? 'active':''}}">
                    <i class="nav-icon fa fa-pen"></i>
                    <p>Contact Messages</p>
                </a>
            </li>
        </ul>
        <!--  </li>
        </ul> -->
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->