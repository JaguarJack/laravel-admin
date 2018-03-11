<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Of Laravel-Shop</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="{{ asset('/assets/css/bootstrap.min.css') }}?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('/assets/css/font-awesome.min.css') }}?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('/assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.min.css') }}?v=4.0.0" rel="stylesheet">
    <link href="{{ asset('/assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>
<body class="gray-bg">
    <div class="middle-box loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name text-center">Hi</h1>
            </div>
            <h3 class="text-center">Welcome To Laravel Shop</h3>

            <form class="m-t" role="form" action="{{ route('login') }}" method="post">
            	{{ csrf_field() }}
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="请输入登录邮箱" required="required"  value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="请输入登录密码" required="required">
                </div>
                <div class="form-group"><input type="checkbox" name="remember" class="i-checks" {{ old('remember') ? 'checked=checked' : '' }}>自动登录</div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('/assets/js/jquery.min.js') }}?v=2.1.4"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}?v=3.3.5"></script>
    <script src="{{ asset('/assets/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script>
     <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",})});
        $('.i-checks').on('ifChecked ifUnchecked', function(event) {
            event.type == 'ifChecked' ? $(this).attr('checked', true) :  $(this).removeAttr('checked');
        })
    </script>
    <script>
        toastr.options = {  
    	        closeButton: true,  
    	        debug: false,  
    	        progressBar: false,  
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
        @if ($errors->has('email'))
        	toastr.warning("{{ $errors->first('email') }}");
        @endif
        @if ($errors->has('password'))
        	toastr.warning("{{ $errors->first('password') }}");
        @endif  
    </script>
</body>
</html>


