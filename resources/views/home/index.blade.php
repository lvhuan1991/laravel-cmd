@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <!-- Files -->
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="card-header-title">
                                    动态
                                </h4>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-body">
                        <!-- List group -->
                        <div class="list-group list-group-flush my--3">
                            @foreach($actives as $active)
                                @if($active['log_name'] =='article')
                                    @include('home.layouts._article')
                                @elseif($active['log_name'] =='comment')
                                    @include('home.layouts._comment')
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- List -->
                </div>
                {{$actives->links()}}

            </div>
            <!-- Swiper -->
            <div class="col-8">
                <form action="" method="post">
                    <div class="swiper-container l1">
                        <div class="swiper-wrapper">
                            @foreach($paths as $path)
                                <div class="swiper-slide"><a href=""><img src='{{$path->path}}'/></a></div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.bootcss.com/Swiper/4.4.2/css/swiper.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/Swiper/4.4.2/css/swiper.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('org/myswiper/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('org/myswiper/swipersize.css')}}">
@endpush
@push('js')

    <script type="text/javascript">
        var swiper = new Swiper('.l1', {
            direction: 'horizontal',
            pagination: {
                el: '.swiper-pagination',
            },
            loop: true,
            autoplay: {
                delay: 3000,
            },
            // 如果需要前进后退按钮
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>


@endpush