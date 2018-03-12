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
        $this->insertGetIdUser();
        $this->insertGetIdPermissions();
    }
    
    
    protected function insertGetIdUser()
    {
        DB::table('users')->insertGetId([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'avatar' => '',
            'is_super' => 1,
        ]);
    }
    
    protected function insertGetIdPermissions()
    {
        $ppid = DB::table('permissions')->insertGetId([
            'name' => '权限管理',
            'pid'  => 0,
            'url' => '#',
            'behavior' => '#',
            'weight' => 10,
        ]);
        
        $upid = DB::table('permissions')->insertGetId([
            'name' => '用户管理',
            'pid'  => $ppid,
            'url' => 'user',
            'behavior' => 'users@index',
            'weight' => 10,
        ]);
         DB::table('permissions')->insertGetId([
            'name' => '添加用户',
            'pid'  => $upid,
            'url' => 'user/create',
            'behavior' => 'users@create',
            'weight' => 1,
        ]);
        DB::table('permissions')->insertGetId([
            'name' => '编辑用户',
            'pid'  => $upid,
            'url' => 'user/edit',
            'behavior' => 'users@edit',
            'weight' => 1,
        ]);
         DB::table('permissions')->insertGetId([
            'name' => '删除用户',
            'pid'  => $upid,
            'url' => 'user/destory',
            'behavior' => 'users@destory',
            'weight' => 1,
        ]);
         
         $rpid = DB::table('permissions')->insertGetId([
             'name' => '角色管理',
             'pid'  => $ppid,
             'url' => 'role',
             'behavior' => 'roles@index',
             'weight' => 9,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '添加角色',
             'pid'  => $rpid,
             'url' => 'role/create',
             'behavior' => 'roles@create',
             'weight' => 1,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '编辑角色',
             'pid'  => $rpid,
             'url' => 'role/edit',
             'behavior' => 'roles@edit',
             'weight' => 1,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '删除角色',
             'pid'  => $rpid,
             'url' => 'role/destory',
             'behavior' => 'roles@destory',
             'weight' => 1,
         ]);
         
         
         $ppid = DB::table('permissions')->insertGetId([
             'name' => '菜单管理',
             'pid'  => $ppid,
             'url' => 'permission',
             'behavior' => 'permissions@index',
             'weight' => 10,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '添加菜单',
             'pid'  => $ppid,
             'url' => 'permission/create',
             'behavior' => 'permissions@create',
             'weight' => 1,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '编辑菜单',
             'pid'  => $ppid,
             'url' => 'permission/edit',
             'behavior' => 'permissions@edit',
             'weight' => 1,
         ]);
         DB::table('permissions')->insertGetId([
             'name' => '删除菜单',
             'pid'  => $ppid,
             'url' => 'permission/destory',
             'behavior' => 'permissions@destory',
             'weight' => 1,
         ]);
    }
}
