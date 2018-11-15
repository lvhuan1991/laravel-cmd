
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
    <title>注册</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-4">
                注&nbsp&nbsp&nbsp&nbsp册
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                免费访问我们的仪表板.
            </p>

            <!-- Form -->
            <form method="post" action="{{route('register')}}">
                @csrf
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        用户昵称
                    </label>

                    <!-- Input -->
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="请输入个性昵称">

                </div>
                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        邮箱地址
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
                <div class="form-group">

                    <!-- Label -->
                    <label>
                        确认密码
                    </label>

                    <!-- Input -->
                    <input type="password" name="password_confirmation" class="form-control" placeholder="请确认密码">
                </div>

                <div class="form-group">
                    <!-- Label -->
                    <label>
                        验证码
                    </label>
                    <!-- Input -->
                    <div class="input-group mb-2">
                        <input type="text" name="code" class="form-control" placeholder="请输入验证码" name="code" value="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="bt">发送验证码</button>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    注册
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        已有账号? <a href="{{route('login')}}">去登录</a>.
                    </small>
                </div>

            </form>

        </div>
        <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">

            <!-- Image -->
            <div class="bg-cover vh-100 mt--1 mr--3" style="background-image: url({{asset('org/assets')}}/img/covers/auth-side-cover.jpg);"></div>

        </div>
    </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT
================================================== -->

<!-- Libs JS -->
{{--<script src="{{asset('org/assets')}}/libs/jquery/dist/jquery.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/chart.js/dist/Chart.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/chart.js/Chart.extension.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/highlight/highlight.pack.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/list.js/dist/list.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/quill/dist/quill.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/dropzone/dist/min/dropzone.min.js"></script>--}}
{{--<script src="{{asset('org/assets')}}/libs/select2/dist/js/select2.min.js"></script>--}}

<!-- Theme JS -->
{{--<script src="{{asset('org/assets')}}/js/theme.min.js"></script>--}}
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