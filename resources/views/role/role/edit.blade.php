@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h1 class="header-title">
                                    角色管理
                                </h1>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="{{route('role.role.create')}}" class="btn btn-primary">
                                    添加角色
                                </a>
                            </div>
                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('role.role.index')}}" class="nav-link ">
                                            角色列表
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('role.role.edit',$role)}}" class="nav-link active">
                                            编辑角色
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row     justify-content-center">
                    <div class="col-12 col-lg-10 col-xl-8">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{route('role.role.update',$role)}}">
                                   @csrf @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">角色中文名称</label>
                                        <input type="text" value="{{$role['title']}}" name="title" class="form-control"
                                               id="exampleInputEmail1" placeholder="请输入角色中文名称">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">角色英文表示</label>
                                        <input type="text" value="{{$role['name']}}" name="name" class="form-control"
                                               id="exampleInputEmail1" placeholder="请输入角色英文表示">
                                    </div>
                                    <button type="submit" class="btn btn-primary">保存数据</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div>
@endsection