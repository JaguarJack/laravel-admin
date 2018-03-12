<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
   	@yield('resource')
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@yield('menu')  / @yield('next_menu')</h5>
            </div>
        </div>
		@yield('content')
		</div>
</body>
</html>
<script>
//表单每页显示的数量
var pageSize = 10;

function formError(dom, msg) {
	dom.parent('div').parent('.form-group').removeClass('has-success').addClass('has-error');
	dom.next('span').html('<i class="fa fa-times-circle">'+msg+'</i>')
}
function _delete(url) {
    $.post(url, {_method:"DELETE", _token:'{{ csrf_token() }}'}, function(data){
        if (data.status == 10000) {
        	window.location.reload();
         } else {
        	 swal({
                 title: data.msg,
                 type: "info",
                 confirmButtonColor: "#DD6B55",
             });
          }
    })
}
function formSubmit(url, params, type = 1) {
	$.post(url, params, function(data){
        if (data.status == 10001 && type == 1 ) {
            alert(213)
          	formError($('input[name=username]'), data.msg);
          	return false;
        }
        swal({
            title: data.msg,
            type: (data.status == 10000 ? 'info' : "warning"),
            confirmButtonColor: "#DD6B55",
        });
    })
}
</script>
@yield('script')
