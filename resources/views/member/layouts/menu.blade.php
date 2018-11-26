<div class="col-sm-3">
    <div class="card">
        <div class="card-block text-center pt-5">
            <div class="avatar avatar-xxl">
                <a href="">
                    <img src="{{$user->icon}}" class="avatar-img rounded-circle">
                </a>
            </div>
            <div class="text-center mt-4">
                <a href="">
                    <h3 class="text-secondary">{{$user->name}}</h3>
                </a>
            </div>
        </div>
        <div class="card-body text-center pt-1 pb-2">
            @can('isMine',$user)
                <div class="nav flex-column nav-pills ">
                    {{--<a href="{{route('member.user.edit',[$user,'type'=>'icon'])}}" class="nav-link text-muted">--}}
                        {{--修改头像--}}
                    {{--</a>--}}
                    <a href="{{route('member.user.edit',[$user,'type'=>'icon'])}}" class="nav-link text-muted {{active_class(if_route(['member.user.edit']) && if_query('type', 'icon'), 'active', '')}}">
                        修改头像
                    </a>
                </div>

                <div class="nav flex-column nav-pills ">
                    <a href="{{route('member.user.edit',[$user,'type'=>'password'])}}" class="nav-link text-muted {{active_class(if_route(['member.user.edit']) && if_query('type', 'password'), 'active', '')}}">
                        修改密码
                    </a>
                </div>
                <div class="nav flex-column nav-pills ">
                    <a href="{{route('member.user.edit',[$user,'type'=>'name'])}}" class="nav-link text-muted {{active_class(if_route(['member.user.edit']) && if_query('type', 'name'), 'active', '')}}">
                        修改昵称
                    </a>
                </div>
            @endcan
            {{--<div class="nav flex-column nav-pills ">--}}
                {{--<a href="" class="nav-link text-muted">--}}
                    {{--粉丝列表--}}
                {{--</a>--}}
                {{--<a href="" class="nav-link text-muted">--}}
                    {{--关注列表--}}
                {{--</a>--}}
                {{--<a href="" class="nav-link text-muted">--}}
                    {{--消息中心--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="card">
        <div class="card-body text-center">
            <div class="nav flex-column nav-pills">
                <a href="{{route('member.my_fans',$user)}}" class="nav-link text-muted {{active_class(if_route(['member.my_fans']), 'active', '')}}">
                    @can('isMine',$user)
                        我的粉丝
                    @else
                        他的粉丝
                    @endcan
                </a>
                <a href="{{route('member.my_following',$user)}}" class="nav-link text-muted {{active_class(if_route(['member.my_following']), 'active', '')}}">
                    @can('isMine',$user)
                        我的关注
                    @else
                        他的关注
                    @endcan
                </a>
            </div>
        </div>
        {{--<div class="card-body text-center">--}}
            {{--<div class="nav flex-column nav-pills">--}}
                {{--<a href="" class="nav-link--}}
                                    {{--text-muted">--}}
                    {{--帖子管理--}}
                {{--</a>--}}
                {{--<a href="" class="nav-link--}}
                                    {{--text-muted">--}}
                    {{--文档管理--}}
                {{--</a>--}}
                {{--<a href="" class="nav-link--}}
                                    {{--text-muted">--}}
                    {{--会员时长--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@push('css')
    <style>
        .active{
            color:white!important;
        }
    </style>
@endpush