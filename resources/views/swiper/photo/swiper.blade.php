@extends('admin.layouts.master')
@section('content')
<div class="col-sm-8">
    <div style="display: inline-block;position: relative;" class="flex-fill">
        @foreach($swipers as $swiper)

               <img src="{{$swiper->path}}" class="img-responsive img-thumbnail" width="300">
               {{--delete--}}
               <button onclick="del(this)" type="button" class="btn btn-danger">删除</button>
               <form action="{{route('swiper.swiper.destroy',$swiper)}}" method="post">
                   @csrf  @method('DELETE')
               </form>

        @endforeach
    </div>
    <div id="uploads" class="input-group-append" >
        <button onclick="upImagePc(this)" class="btn btn-secondary" type="button">单图上传</button>
    </div>
    <form action="{{route('swiper.swiper.store')}}" method="post">
        @csrf
        <input hidden type="text" name="thumb">
    </form>


</div>
@endsection

@push('js')


<script>
    require(['mhdjs','bootstrap']);
    //上传图片
    function upImagePc() {
        require(['hdjs'], function (hdjs) {
            var options = {
                multiple: false,//是否允许多图上传
                //data是向后台服务器提交的POST数据
                data: {name: '后盾人', year: 2099},
            };
            hdjs.image(function (images) {
                //上传成功的图片，数组类型
                $("[name='thumb']").val(images[0]);
                $(".img-thumbnail").attr('src', images[0]);
                $("#uploads").next().submit();
            }, options)
        });
    }
    //移除图片
    function del(obj) {
        require(['https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js'], function (swal) {
            swal("确定删除?", {
                icon: 'warning',
                buttons: {
                    cancel: "取消",
                    defeat: '确定',
                },
            }).then((value) => {
                switch (value) {
                    case "defeat":
                        $(obj).next('form').submit();
                        break;
                    default:

                }
            });
        })
    }
</script>
@endpush