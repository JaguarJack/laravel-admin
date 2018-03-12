<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主页</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="{{ asset('/assets/css/bootstrap.min.css?v=3.3.5') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/font-awesome.min.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.min.css?v=4.0.0') }}" rel="stylesheet">
    <script src="{{ asset('/assets/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js?v=3.3.5') }}"></script>
    <script src="{{ asset('/assets/js/content.min.js?v=1.0.0') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight" >
    <div class="ibox float-e-margins">
    </div>
    <div class="middle-box text-center animated fadeInDown" style="margin-top:10px;">
        <h2>欢迎使用Laravel Admin 后台</h2>
    </div>
	<div class="row">
	<div class="col-sm-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>系统信息</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                    <i class="fa fa-wrench"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Version</td>
                        <td>1.0</td>
                         <td> PHP版本</td>
                        <td>{{ PHP_VERSION }}</td>
                        
                    </tr>
                     <tr>
                        <td>运行环境</td>
                        <td>{{ $_SERVER ['SERVER_SOFTWARE'] }}</td>
                        <td> 操作系统</td>
                        <td>{{ PHP_OS }}</td>
                    </tr>
                     <tr>
                        <td> MYSQL版本</td>
                        <td>{{ mysqli_get_client_version() }}</td>
                         <td> 上传附件限制</td>
                        <td>{{ get_cfg_var ("upload_max_filesize") }}</td>
                    </tr>
                    <tr>
                        <td> 执行时间限制</td>
                        <td>{{ get_cfg_var("max_execution_time") }}</td>
                        <td>opcache(建议开启)</td>
                        @if (function_exists('opcache_get_configuration'))
                          <td>{{ opcache_get_configuration()['directives']['opcache.enable'] ? '开启' : '关闭' }}</td>
                        @else
                          <td>未开启</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>
