<?php

namespace Lizyu\Admin\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lizyu\Permission\Traits\HasRoleTrait;
use Illuminate\Database\Eloquent\Collection;
use Lizyu\Permission\Traits\HasPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable, HasRoleTrait, HasPermissionsTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * @description:获取用户
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param unknown $offset
     * @return Collection
     */
    public function getUsers($offset):Collection
    {
        return $this->select('id', 'name', 'email', 'is_super', 'created_at')
                    ->offset($offset)
                    ->limit(10)
                    ->get();
    }
    
    /**
     * @description:用户名是否存在
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param string $name
     * @return Collection
     */
    public function isNameExist(string $name, int $user_id = null)
    {
        $where = [['name' , '=', $name ]];
        if ($user_id) {
            $where[] = ['id' , '<>', $user_id ];
        }
        return $this->where($where)->first();
    }
    
    /**
     * @description:根据user_id更新数据
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年3月3日
     * @param int $user_id
     * @param array $data
     */
    public function updateUserById(int $user_id, array $data) 
    {
       return $this::where('id', $user_id)->update($data);
    }
    
    /**
     * @description:邮箱是否存在
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param string $password
     * @return Collection
     */
    public function isEmailExist(string $email, int $user_id = null)
    {
        $where = [['email' , '=', $email]];
        if ($user_id) {
            $where[] = ['id' , '<>', $user_id ];
        }
        return $this->where($where)->first();
    }
}