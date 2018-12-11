<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    @stack('css')
    <title>后台管理</title>
</head>
<body>

<!-- SIDEBAR
================================================== -->

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
                aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('home')}}">梦里人生
            {{--<img src="{{asset('org/assets')}}/img/logo.svg" class="navbar-brand-img--}}
            {{--mx-auto" alt="...">--}}
        </a>

        <!-- User (xs) -->
        <div class="navbar-user d-md-none">

            <!-- Dropdown -->
            <div class="dropdown">

                <!-- Toggle -->
                <a href="{{route('home')}}" id="sidebarIcon" class="dropdown-toggle" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <img src="{{asset('org/assets')}}/img/avatars/profiles/avatar-1.jpg"
                             class="avatar-img rounded-circle" alt="...">
                    </div>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
                    <a href="profile-posts.html" class="dropdown-item">Profile</a>
                    <a href="settings.html" class="dropdown-item">Settings</a>
                    <hr class="dropdown-divider">
                    <a href="sign-in.html" class="dropdown-item">Logout</a>
                </div>

            </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                           placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fe fe-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html">
                        <i class="fe fe-home"></i> 周公解梦
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarPages" data-toggle="collapse" role="button" aria-expanded="false"
                       aria-controls="sidebarPages">
                        <i class="fe fe-file"></i> 文章系统
                    </a>
                    <div class="collapse " id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.category.index')}}" class="nav-link">
                                    栏目管理
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#sidebarLayouts" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fe fe-layout"></i> 网站配置
                    </a>
                    <div class="collapse " id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.config.edit',['name'=>'base'])}}" class="nav-link">
                                    基本配置
                                </a>
                                @role('Admin-config-upload')
                                <a href="{{route('admin.config.edit',['name'=>'upload'])}}" class="nav-link">
                                    上传配置
                                </a>
                                @endrole
                                <a href="{{route('admin.config.edit',['name'=>'mail'])}}" class="nav-link">
                                    邮件配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'code'])}}" class="nav-link">
                                    验证码配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'search'])}}" class="nav-link">
                                    搜索配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'wechat'])}}" class="nav-link">
                                    微信配置
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarWechat" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fe fe-message-square"></i> 微信管理
                    </a>
                    <div class="collapse " id="sidebarWechat">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('wechat.button.index')}}" class="nav-link" >
                                    微信菜单
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.response_text.index')}}" class="nav-link" >
                                    文本回复
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.response_news.index')}}" class="nav-link" >
                                    图文回复
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.response_base.create')}}" class="nav-link" >
                                    基本回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @role('Admin-swiper')
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarSwiper" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarswiper">
                        <i class="fe fe-message-square"></i> 轮播图管理
                    </a>
                    <div class="collapse " id="sidebarSwiper">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('swiper.swiper.index')}}" class="nav-link" >
                                    图片管理
                                </a>

                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarAuth" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fe fe-user"></i> 权限管理
                    </a>
                    <div class="collapse show" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('role.user.index')}}" class="nav-link" >
                                    用户管理
                                </a>
                                <a href="{{route('role.role.index')}}" class="nav-link" >
                                    角色管理
                                </a>
                                <a href="{{route('role.permission.index')}}" class="nav-link" >
                                    权限列表
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

            <!-- Divider -->
            <hr class="my-3">



            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link " href="changelog.html">
                        <i class="fe fe-git-branch"></i> 系统版本 <span
                                class="badge badge-primary ml-auto">v1.1.2</span>
                    </a>
                </li>
            </ul>


            <!-- User (md) -->
            <div class="navbar-user mt-auto d-none d-md-flex">

                <!-- Icon -->
                <a href="#sidebarModalActivity" class="text-muted" data-toggle="modal">
              <span class="icon">
                <i class="fe fe-bell"></i>
              </span>
                </a>

                <!-- Dropup -->
                <div class="dropup">

                    <!-- Toggle -->
                    <a href="#!" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="{{asset('org/assets')}}/img/avatars/profiles/avatar-1.jpg"
                                 class="avatar-img rounded-circle" alt="...">
                        </div>
                    </a>

                    <!-- Menu -->
                    <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">

                        <a href="sign-in.html" class="dropdown-item">注销登录</a>
                    </div>

                </div>

                <!-- Icon -->
                <a href="#sidebarModalSearch" class="text-muted" data-toggle="modal">
              <span class="icon">
                <i class="fe fe-search"></i>
              </span>
                </a>

            </div>


        </div> <!-- / .navbar-collapse -->

    </div> <!-- / .container-fluid -->
</nav>

<!-- MAIN CONTENT
================================================== -->
<div class="main-content">

    @yield('content')
</div><!-- / .container-fluid -->
<!-- JAVASCRIPT
================================================== -->
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['bootstrap'])
</script>
{{--stack在手册Blade模板--}}
@stack('js')
</body>
</html>
