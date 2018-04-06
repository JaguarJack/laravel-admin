<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Reuqest\PermissionRequest as Request;
use Lizyu\Permission\Contracts\PermissionContract;
use Lizyu\Admin\Services\MenuService;
use Lizyu\Permission\Contracts\RoleContract;

class PermissionsController extends BaseController
{
    
    protected $permissions;
    
    public function __construct(PermissionContract $permission)
    {
        $this->permissions = $permission;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuService $menu)
    {
        //
        $permissions = $this->permissions->getAllPermissions();

        return view('lizadmin::permissions.index', [
            'permissions' => $menu->set($permissions)->sortMenu(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 0)
    {
        return view('lizadmin::permissions.create', [
                'id' => $id,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('lizadmin::permissions.edit', [
            'permission' => $this->permissions->findById($id),
        ]);
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
        $permission = $request->except('_token');
        
        return $this->permissions->store($permission) ?
            
                $this->ajaxSuccess('添加成功') : $this->ajaxFail('添加失败');
        
    }
    
    /**
     * @description:获取权限列表
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月21日
     */
    public function getPermissions(
        RoleContract $role, 
        PermissionContract $permission, 
        MenuService $menu
    ){
        $request = app('request');

        $permissions = $permission->select('id', 'pid', 'name')->get();
        $roleOfPermissions = $role->getPermissionsOfRole($request->input('role_id'));
        
        $permissions = $permissions->each(function($item, $key) use ($roleOfPermissions, $permissions){
            $permissions[$key]->checked = $roleOfPermissions->contains($item) ? true : false;
        });
        
        $permissions= $menu->set($permissions)->treeMenu();
        
        $menu = [];
        foreach ($permissions as $permission) {
            $menu[] = $permission;
        }
        
        return response()->json(['rows' => $menu]);
    }
    
    /**
     * @description:更新数据
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月21日
     * @param Request $request
     */
    public function update($id, Request $request)
    {
        $permission = $request->except(['_token', '_method']);
        
        return $this->permissions->updateBy($permission, $id) ? $this->ajaxSuccess('更新成功') : $this->ajaxFail('更新失败');
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->permissions->isHaveChildren($id)) {
            return $this->ajaxFail('请先删除子菜单');
        }
        
        $this->permissions->deletePermissionOfRole($id);
        
        return $this->permissions->destory($id) ? $this->ajaxSuccess('删除成功') : $this->ajaxFail('删除失败');
    }

}
