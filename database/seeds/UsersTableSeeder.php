<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertUser();
        $this->insertPermissions();
    }
    
    
    protected function insertUser()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'avatar' => '',
            'is_super' => 1,
        ]);
    }
    
    protected function insertPermissions()
    {
        $ppid = DB::table('permissions')->insert([
            'name' => '权限管理',
            'pid'  => 0,
            'url' => '#',
            'behavior' => '#',
            'weight' => 10,
        ]);
        
        $upid = DB::table('permissions')->insert([
            'name' => '用户管理',
            'pid'  => $ppid,
            'url' => 'user',
            'behavior' => 'user@index',
            'weight' => 10,
        ]);
         DB::table('permissions')->insert([
            'name' => '添加用户',
            'pid'  => $upid,
            'url' => 'user/create',
            'behavior' => 'user@create',
            'weight' => 1,
        ]);
        DB::table('permissions')->insert([
            'name' => '编辑用户',
            'pid'  => $upid,
            'url' => 'user/edit',
            'behavior' => 'user@edit',
            'weight' => 1,
        ]);
         DB::table('permissions')->insert([
            'name' => '删除用户',
            'pid'  => $upid,
            'url' => 'user/destory',
            'behavior' => 'user@destory',
            'weight' => 1,
        ]);
         
         $rpid = DB::table('permissions')->insert([
             'name' => '角色管理',
             'pid'  => $ppid,
             'url' => 'role',
             'behavior' => 'role@index',
             'weight' => 9,
         ]);
         DB::table('permissions')->insert([
             'name' => '添加角色',
             'pid'  => $rpid,
             'url' => 'role/create',
             'behavior' => 'role@create',
             'weight' => 1,
         ]);
         DB::table('permissions')->insert([
             'name' => '编辑角色',
             'pid'  => $rpid,
             'url' => 'role/edit',
             'behavior' => 'role@edit',
             'weight' => 1,
         ]);
         DB::table('permissions')->insert([
             'name' => '删除角色',
             'pid'  => $rpid,
             'url' => 'role/destory',
             'behavior' => 'role@destory',
             'weight' => 1,
         ]);
         
         
         $ppid = DB::table('permissions')->insert([
             'name' => '菜单管理',
             'pid'  => $ppid,
             'url' => 'permission',
             'behavior' => 'permission@index',
             'weight' => 10,
         ]);
         DB::table('permissions')->insert([
             'name' => '添加菜单',
             'pid'  => $ppid,
             'url' => 'permission/create',
             'behavior' => 'permission@create',
             'weight' => 1,
         ]);
         DB::table('permissions')->insert([
             'name' => '编辑菜单',
             'pid'  => $ppid,
             'url' => 'permission/edit',
             'behavior' => 'permission@edit',
             'weight' => 1,
         ]);
         DB::table('permissions')->insert([
             'name' => '删除菜单',
             'pid'  => $ppid,
             'url' => 'permission/destory',
             'behavior' => 'permission@destory',
             'weight' => 1,
         ]);
    }
}
