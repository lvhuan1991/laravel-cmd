<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //调用模型工厂一次性填充24个数据
        factory(\App\User::class,24)->create();
        //修改第一个数据为正式数据
        $user = \App\User::find(1);
        $user->name = '后盾人';
        $user->email = 'lvhuan1991@qq.com';
        $user->password = bcrypt('1111');
        $user->is_admin = true;
        $user->save();
    }
}
