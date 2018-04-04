<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="{{ asset('/assets/css/bootstrap.min.css?v=3.3.5') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/font-awesome.min.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.min.css?v=4.0.0') }}" rel="stylesheet"><base target="_blank">
    <link href="{{ asset('/assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/assets/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js?v=3.3.5') }}"></script>
    <script src="{{ asset('/assets/js/content.min.js?v=1.0.0') }}"></script>
    <script src="{{ asset('/assets/js/plugins/iCheck/icheck.min.js') }}"></script>
     <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script>
    <style>
        .i-checks{padding-left:12px;}
    </style>
    @yield('resource')
</head>
<body class="gray-bg">
	
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
            	<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@yield('menu')  / @yield('next_menu')</h5>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                    	@yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
        toastr.options = {  
    	        closeButton: true,  
    	        debug: false,  
    	        progressBar: true,  
    	        positionClass: "toast-top-center",  
    	        onclick: null,  
    	        showDuration: "300",  
    	        hideDuration: "1000",  
    	        timeOut: "2000",  
    	        extendedTimeOut: "1000",  
    	        showEasing: "swing",  
    	        hideEasing: "linear",  
    	        showMethod: "fadeIn",  
    	        hideMethod: "fadeOut"  
    	    };
		// 将表单元素转换成json串
        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        //错误信息
        function error(message) {toastr.error(message);return false;}
        //成功信息
        function success(message, time = 2000){toastr.success(message, function(time){setTimeout("self.location=document.referrer;", time)}(time));}

		//form提交
    	function formSubmit(dom)
    	{
    		var data = $("form").serializeObject();
    		
    		$.post($(dom).attr('data-url'), data, function(data){
    				if (data.status == 10001) {
    					return error(data.message);
    				}
    				success(data.message);
    		})
    		
    		return false;
    	}
    </script>
</body>
</html>
@yield('script')