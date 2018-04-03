<?php

namespace Lizyu\Admin\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @description:ajax正确返回
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param string $msg
     * @param unknown $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxSuccess(string $msg = '', array $data = null)
    {
        return response()->json([
            'status'  =>  10000,
            'message' =>  $msg,
            'data'    =>  $data,
        ]);
    }
    
    /**
     * @description:ajax错误返回
     * @author: wuyanwen <wuyanwen1992@gmail.com>
     * @date:2018年1月20日
     * @param string $msg
     * @param unknown $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxFail(string $msg = '', array $data = null)
    {
        return response()->json([
            'status'  =>  10001,
            'message' =>  $msg,
            'data'    =>  $data,
        ]);
    }
}