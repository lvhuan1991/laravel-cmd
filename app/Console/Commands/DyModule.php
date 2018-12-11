<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DyModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dy_module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '这里是命令的描述';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //users 用户表
        //model_has_roles 用户 角色中间表
        //roles 角色表
        //role_has_permission 角色 权限中间表
        //permissions 权限表

        //在生成的权限迁移文件:permissions表增加title module 字段
        //在roles表增加 title 字段
        //自行创建迁移文件 modules:title(模块中文名称)  name(模块英文标识) permissions(记录模块所有权限)
        //=======================================//
        //扫描出 app/Http/Controllers里面所有文件以及文件夹
        $modules = glob('app/Http/Controllers/*');
        //dd($modules);
        foreach($modules as $module){
            //dump($module);
            //判断模块里面 System 是否为目录
            if(is_dir($module . '/System')){
                //dump($module);
                //获取模块为英文标识
                //basename php 函数,用户获取整个路径最后一部分,反之是dirname
                $moduleName = basename($module);
                //dump($moduleName);
                $config = include $module . '/System/config.php';
                //dump($config);
                //获取模块所有权限
                $permissions = include $module . '/System/permission.php';
                //dump($permissions);
                //将模块数据写入数据表中:title name permissions
                //执行完成这句代码,那么 modules 表就应该有数据被写入
                Module::firstOrNew(['name'=>$moduleName])->fill(['title'=>$config['app'],'permissions'=>
                $permissions])->save();
                //dump($permissions);
                //将所有设定权限写入权限表:title name module
                //执行完成这句代码,那么 permission 表就应该有数据被写入
                foreach($permissions as $permission){
                    Permission::firstOrNew(['name'=>$moduleName . '-' .$permission['name']])->fill([
                        'title'=>$permission['title'],
                        'module'=>$moduleName
                    ])->save();
                }
            }
        }

        //=======================================//
        //给指定一个用户设置站长角色,站长角色要拥有所有权限
        //设置一个角色填充文件,系统初始需要有一个站长角色
        //1.将所有权限设置给站长这个角色
        //找到站长这个角色对象
        $role = Role::where('name','webmaster')->first();
        //dd($permissions);
        //给角色同步权限
        $permissions= Permission::pluck('name');
        //dd($permissions);
        //执行完成这句话之后 role_has_permissions表应该有数据
        $role->syncPermissions($permissions);
        //2.获得设置成站长的那个用户
        $user = User::find(1);
        //dd($user);
        //给用同步权限
        //注意如果执行报错:App\User 模型中未定义assignRole,解决办法:需要在 User 模型中引入HasRoles类
        $user->assignRole('webmaster');
        //3.清除权限缓存
        app()['cache']->forget('spatie.permission.cache');
        //4.命令执行成功提示信息
        $this->info('permission init successfully');
    }
}
