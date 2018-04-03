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
    <link href="{{ asset('/assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/assets/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js?v=3.3.5') }}"></script>
    <script src="{{ asset('/assets/js/content.min.js?v=1.0.0') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js') }}"></script>
     <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script>
   	@yield('resource')
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@yield('menu')  / @yield('next_menu')</h5>
            </div>
        </div>
		<div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <div class="example-wrap">
                            <div class="example">
                                <div class="btn-group hidden-xs" id="toolbar" role="group">
                                	<a href="@yield('addUrl')">
                                     <button type="button" class="btn btn-w-m btn-success">
                                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>  @yield('addTitle')
                                     </button>
                                    </a>
                                </div>
                                <table data-toggle="table" data-height="600" data-mobile-responsive="true">
                                    <thead>
                                       <tr>
                                           @yield('th')
                                       </tr>
                                    </thead>
                                    <tbody>
                                       		@yield('tbodyTr')
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                	@yield('paginate')
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>
<script>
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
	function destory(dom) {
		var url = $(dom).attr('data-url');

		$.post(url, {'_token':"{{ csrf_token()}}", '_method' : 'DELETE'}, function(data) {
				if (data.code == 10001) {
					toastr.error(data.message);return false;
				}

				toastr.success(data.message, function(){setTimeout("window.location.reload()", 2000)})
		}) 
	}
</script>
@yield('script')
