<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Controllers\BaseController;
use Lizyu\Admin\Model\User;
use Lizyu\Admin\Services\MenuService;
use Auth;
use Lizyu\Permission\Contracts\PermissionContract as Permission;

class IndexController extends BaseController
{
    public function index(User $user, Permission $permission, MenuService $menu)
    { 
       $loginUser = Auth::user();
       
       $permissions = $loginUser->is_super == 1 ? $permission->getAllPermissions() : $user->getUserOfPermissions($loginUser->id);

       $userHavePerimssions = $menu->set($permissions)->treeMenu();

       return view('lizadmin::index.index', [
           'menus' => $userHavePerimssions
       ]);
    }
    
    public function main()
    {
        return view('lizadmin::index.main');
    }
}