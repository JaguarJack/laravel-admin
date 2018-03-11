<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Controllers\BaseController;
use Lizyu\Admin\Model\User;
use Lizyu\Admin\Services\MenuService;
use Auth;
use Lizyu\Permission\Traits\PermissionTrait;

class IndexController extends BaseController
{
    use PermissionTrait;
    
    public function index(User $user)
    { 
       //超级用户
       $permissions = $user->is_super == 1 ? $this->permissions()->getAll() : $user->getUserOfPermissions(Auth::id());
       $userHavePerimssions = (new MenuService($permissions))->treeMenu();
       
       return view('lizadmin::index.index', [
           'menus' => $userHavePerimssions
       ]);
    }
    
    public function main()
    {
        return view('lizadmin::index.main');
    }
}