<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Reuqest\UserRequest as Request;
use Lizyu\Admin\Model\User;
use Lizyu\Permission\Contracts\RoleContract;

class UsersController extends BaseController
{
    protected  $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lizadmin::users.index', [
            'users' => $this->user::paginate(10),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lizadmin::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $name     = $request->input('name');
        $password = bcrypt($request->input('password'));
        $email    = $request->input('email');
        
        $this->user->name     = $name;
        $this->user->password = $password;
        $this->user->email    = $email;

        return  $this->user->save() ? $this->ajaxSuccess('添加成功') : $this->ajaxFail('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('lizadmin::users.edit', [
            'user' => $this->user::find($id),
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = $this->user->find($id);
        $name = $request->input('name');
        $email    = $request->input('email');
        $password = $request->input('password');
        $is_super = $request->input('is_super');
        
        $user->name  = $name;
        $user->email = $email;
        if ($password) {
            $user->password = bcrypt($password);
        }
        
        $user->is_super = $is_super;
        
        return $user->save() ? $this->ajaxSuccess('更新成功') : $this->ajaxFail('更新失败', ['field' => 'username']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = $this->user->find($id);

        if ($user->delete()) {
            $user->deleteRolesOfUser();
            return $this->ajaxSuccess('删除成功');
        }
        
        return $this->ajaxFail('删除失败');
    }
    
    public function getUsers(Request $request)
    {
        if ($request->isMethod('POST')) {
            $users = $this->user->getUsers($request->input('offset'), $request->input('limit'));
            
            return response()->json([
                'total' => $this->user->count(),
                'rows'  => $users,
            ]);
        }
    }
    
    /**
     * @description:获取用户相关的角色
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年3月4日
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRolesOfUser(RoleContract $role)
    {
        $request = app('request');
        if ($request->isMethod('POST')) {
            $roles =  $role->offset(intval($request->input('offset')))->limit(intval($request->input('limit')))->get();
            $rolesOfUsers = $this->user->find($request->input('user_id'))->getRolesOfUser();
            $roles = $roles->each(function($item, $key) use ($rolesOfUsers, $roles){
                $roles[$key]->check = $rolesOfUsers->contains($item) ? true : false;
            });
            return response()->json([
                'total' => $role->count(),
                'rows'  => $roles,
            ]);
        }
    }
    
    /**
     * @description:分配角色
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param Request $request
     */
    public function giveRoleToUser()
    {
        $request = app('request');
        
        $user_id = $request->post('user_id', 0, 'intval');
        $role    = $request->post('role');
        
        $user = $this->user->find($user_id);
        
        //如果是超级用户， 无需分配角色信息
        if ($user->is_super == 1) {
            return $this->ajaxFail('超级用户， 无需分配角色');    
        }
        
        $user->storeRolesOfUser($role);
        
        return $this->ajaxSuccess('授权成功');
    }
}
