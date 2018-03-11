<?php

namespace Lizyu\Admin\Services;

class MenuService
{
    private $menu;
    
    public function __construct($menu)
    {
        $this->menu = $menu;
    }
    
    
    /**
     * @description:tree menu
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月28日
     * @param number $pid
     * @param number $level
     * @return \Illuminate\Support\Collection|unknown
     */
    public function treeMenu($pid = 0, $level= 1)
    {
        $tree_menu = [];
        
        $this->menu->each(function($menu, $key) use (&$tree_menu, $pid, $level){
            
            if ($menu->pid == $pid) {
                $menu->level = $level;
                $tree_menu[$key] = $menu;
                $tree_menu[$key]['children'] = array_merge($this->treeMenu($menu->id, ++$level));
                unset($this->menu[$key]);
            }
        });
        
        return $tree_menu;
    }
    
    public function sortMenu($pid = 0, $level = 0)
    {
        $tree_menu = [];
       
        $this->menu->each(function($menu, $key) use (&$tree_menu, $pid, $level){
            if ($menu->pid == $pid) {
                $menu->level = $level;
                $tree_menu[] = $menu;
                $tree_menu = array_merge($tree_menu, $this->sortMenu($menu->id, ++$level));
                unset($this->menu[$key]);
            }
        });
        
        return $tree_menu;
    }
   
}

