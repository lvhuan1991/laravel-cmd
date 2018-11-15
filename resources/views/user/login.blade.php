
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

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>登录</title>
    
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="{{asset('org/assets')}}/img/illustrations/happiness.svg" alt="..." class="img-fluid">
            </div>

        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">
            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                登&nbsp&nbsp&nbsp&nbsp录
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                免费访问我们的仪表板.
            </p>

            <!-- Form -->
            <form method="post" action="{{route('login')}}">
            @csrf
            <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        邮箱
                    </label>
                    <!-- Input -->
                    <input type="email" name="email" class="form-control" placeholder="lvhuan1991@qq.com">
                </div>
                <!-- Password -->
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        密码
                    </label>
                    <!-- Input group -->
                    <div class="input-group input-group-merge">
                        <!-- Input -->
                        <input type="password" name="password" class="form-control form-control-appended" placeholder="请输入邮箱密码">

                        <!-- Icon -->
                        <div class="input-group-append">
                  <span class="input-group-text">
                    {{--<i class="fe fe-eye"></i>--}}
                  </span>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    登录
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        没有账号? <a href="{{route('register')}}">去注册</a>.
                        <a href="{{route('password_reset')}}">重置密码</a>
                        <a href="{{route('home')}}">返回首页</a>

                    </small>
                </div>

            </form>

        </div>
        <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">

            <!-- Image -->
            <div class="bg-cover vh-100 mt--1 mr--3" style="background-image: url(org/{{asset('org/assets')}}/img/covers/auth-side-cover.jpg);"></div>

        </div>
    </div> <!-- / .row -->
</div>
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['hdjs','bootstrap'], function (hdjs) {
        let option = {
            //按钮
            el: '#bt',
            //后台链接
            url: '{{route('code.send')}}',
            //验证码等待发送时间
            timeout: 10,
            //表单，手机号或邮箱的INPUT表单
            input: '[name="email"]'
        };
        hdjs.validCode(option);
    })
</script>


</body>
</html>









<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">





</body>
</html>