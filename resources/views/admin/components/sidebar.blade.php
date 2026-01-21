<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-white text-dark">
        @php $siteInfo = site_settings();  @endphp
        @if($siteInfo->com_logo != '')
            <img src="{{asset('public/frontend/images/'.$siteInfo->com_logo)}}" alt="{{$siteInfo->com_name}}" width="100%">
        @else
            <h5>{{$siteInfo->com_name}}</h5>
        @endif
    </a> 
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="javascript:void(0)" class="d-block">{{session()->get('admin_name')}}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{url('admin/dashboard')}}" class="nav-link {{(Request::path() == 'admin/dashboard')? 'active':''}}">
                    <i class="nav-icon fas fa-home"></i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/services')}}" class="nav-link {{(Request::path() == 'admin/services')? 'active':''}}">
                    <i class="nav-icon fa fa-wrench"></i>
                    <p>Services</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/users')}}" class="nav-link {{(Request::path() == 'admin/users')? 'active':''}}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{(Request::path() == 'admin/category' || Request::path() == 'admin/blog')? 'menu-open':''}}">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Blogs<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('admin/blogs')}}" class="nav-link {{(Request::path() == 'admin/blogs')? 'active bg-primary':''}}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>All Blogs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/category')}}" class="nav-link {{(Request::path() == 'admin/category')? 'active bg-primary':''}}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Blog Category</p>
                        </a>
                    </li>
                    
                </ul> 
            </li>
            <li class="nav-item">
                <a href="{{url('admin/pages')}}" class="nav-link {{(Request::path() == 'admin/pages')? 'active':''}}">
                    <i class="nav-icon fas fa-clone"></i>
                    <p>Pages</p>
                </a>
            </li>   
            <li class="nav-item">
                <a href="{{url('admin/contact')}}" class="nav-link {{(Request::path() == 'admin/contact')? 'active':''}}">
                    <i class="nav-icon fa fa-pen"></i>
                    <p>Contact Messages</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{(Request::path() == 'admin/general-settings' || Request::path() == 'admin/banner-settings'|| Request::path() == 'admin/profile-settings'|| Request::path() == 'admin/social-settings')? 'menu-open':''}}">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fa fa-wrench"></i>
                    <p> Settings <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('admin/banner-settings')}}" class="nav-link {{(Request::path() == 'admin/banner-settings')? 'active bg-primary':''}}">
                            <i class="fas fa-cogs nav-icon"></i>
                            <p>Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/general-settings')}}" class="nav-link {{(Request::path() == 'admin/general-settings')? 'active bg-primary':''}}">
                            <i class="fas fa-cogs nav-icon"></i>
                            <p>General Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/profile-settings')}}" class="nav-link {{(Request::path() == 'admin/profile-settings')? 'active bg-primary':''}}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Profile Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/social-settings')}}" class="nav-link {{(Request::path() == 'admin/social-settings')? 'active bg-primary':''}}">
                            <i class="nav-icon fa fa-list"></i>
                            <p>Social Links</p>
                        </a>
                    </li> 
                </ul> 
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