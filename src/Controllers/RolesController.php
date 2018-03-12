<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Reuqest\RoleRequest as Request;
use Lizyu\Permission\Traits\RoleTrait;
use Lizyu\Permission\Traits\PermissionTrait;
use Lizyu\Admin\Services\MenuService;
use Lizyu\Admin\Model\User;
use Route;
use DB;

class RolesController extends BaseController
{
    use RoleTrait, PermissionTrait;
    
    protected $role;
    
    public function __construct()
    {
        $this->role = $this->role();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('lizadmin::roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lizadmin::roles.create');
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
        $name = $request->input('name');
      
        if ($this->role->findByName($name)) {
            return $this->ajaxFail('该角色名称已经存在~');
        }
        
        return  $this->role->store(['name' => $name, 'description' => $request->input('description')]) ? 
        
                $this->ajaxSuccess('添加成功', $this->role->getLastestRole()) : $this->ajaxFail('添加失败');
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
        //
        $role = $this->role->findById($id);
        
        $permissions = (new MenuService($this->permission()->getAll()))->treeMenu();
        //dump($permissions);
        $users = (new User())->get();
        
        return view('lizadmin::roles.edit', [
            'role'        => $role,
            'permissions' => $permissions,
            'users'       => $users,
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
        $name= $request->input('name');
        
        if ($this->role->findByName($name)) {
            return $this->ajaxFail('该角色名称已经存在~');
        }
        
        $data = ['id' => $id, 'name' => $name, 'description' => $request->input('description')];
        
        return $this->role->update($data) ? $this->ajaxSuccess('更新成功~') : $this->ajaxFail('更新失败~');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除角色相关权限 
        $this->role->deletePermissionsOfRole($id);
        // 删除角色与用户关联
        $this->role->deleteUserOfRole($id);
        // 删除 角色
        if ($this->role->delete($id)) {
            return $this->ajaxSuccess('删除成功');
        }
        
        return $this->ajaxFail('删除失败');
    }
    
    /**
     * @description:异步获取角色列表
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年3月7日
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLimitRoles(Request $request)
    {
        $offset = $request->input('offset');
        $limit  = $request->input('limit');
        return response()->json([
            'rows'  => $this->role->paginate($offset, $limit),
            'total' => $this->role->count(),
        ]);
    }
    
    /**
     * @description:给予角色权限
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年3月6日
     * @param Request $request
     */
    public function givePermissionsToRole(Request $request)
    {
        $role_id     = $request->post('role_id', 0, 'intval');
        $permissions = $request->post('permission');

        $this->role->storePermissionsOfRole($role_id, $permissions);
        
        return $this->ajaxSuccess('授权成功');
    }
}
