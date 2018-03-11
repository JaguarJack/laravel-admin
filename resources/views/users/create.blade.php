@extends('lizadmin::layouts.admin')
@section('title', '添加用户')
@section('menu', '用户管理')
@section('next_menu', '添加用户')
@section('resource')
@endsection
@section('content')
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form class="form-horizontal m-t" id="addUserInfo">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名：</label>
                        <div class="col-sm-8">
                            <input id="username" name="username" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail：</label>
                        <div class="col-sm-8">
                            <input id="email" name="email" class="form-control" type="email">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">密码：</label>
                        <div class="col-sm-8">
                            <input id="password" name="password" class="form-control" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认密码：</label>
                        <div class="col-sm-8">
                            <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-w-m btn-primary">提交</button>
                            <button class="btn btn-w-m btn-warning" onclick="history.go(-1);return false;">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
@section('script')
<script src="{{ asset('/assets/js/plugins/validate/jquery.validate.min.js' )}}"></script>
<script src="{{ asset('/assets/js/plugins/validate/messages_zh.min.js' )}}"></script>
<script>
$("#addUserInfo").validate({
	rules: {
      username: {
        required: true,
        minlength: 2,
        maxlength: 15,
      },
      password: {
        required: true,
        minlength: 5,
        maxlength:20,
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      email: {
        required: true,
        email: true,
      },
    },
    submitHandler:function(form){
        var params = { name:$('input[name=username]').val(),email:$('input[name=email]').val(),
        			   password:$('input[name=password]').val(),_token:"{{ csrf_token() }}",
                	  }
        $.post("{{ url('user') }}", params, function(data){
            if (data.status == 10001) {
            	 $('input[name=username]').parent('div').addClass('has-error');
            } else {
            	add(data.data.id, data.data.name, data.data.email, '', data.data.created_at);
            	close();
            }
        })
    }  
});  
</script>
@endsection