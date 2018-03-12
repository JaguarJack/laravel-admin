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
       $loginUser = Auth::user();
       $permissions = $loginUser->is_super == 1 ? $this->permission()->getAll() : $user->getUserOfPermissions($loginUser->id);
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