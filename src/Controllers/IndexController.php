<?php

namespace Lizyu\Admin\Controllers;

use Lizyu\Admin\Controllers\BaseController;
use Lizyu\Admin\Model\User;
use Lizyu\Admin\Services\MenuService;
use Auth;

class IndexController extends BaseController
{
    public function index(User $user)
    { 
       $userHavePerimssions = (new MenuService($user->getUserOfPermissions(Auth::id())))->treeMenu();
       
       return view('lizadmin::index.index', [
           'menus' => $userHavePerimssions
       ]);
    }
    
    public function main()
    {
        return view('lizadmin::index.main');
    }
}