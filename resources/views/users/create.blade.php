@extends('lizadmin::layouts.form')
@section('title', '添加用户')
@section('menu', '用户管理')
@section('next_menu', '添加用户')
@section('resource')
@endsection
@section('content')
    <form class="form-horizontal m-t" id="addUserInfo">
        <div class="form-group">
            <label class="col-sm-3 control-label">用户名：</label>
            <div class="col-sm-4">
                <input id="username" name="name" class="form-control" type="text" aria-invalid="true" class="error">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">E-mail：</label>
            <div class="col-sm-4">
                <input type="email" name="email" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">密码：</label>
            <div class="col-sm-4">
                <input id="password" name="password" class="form-control" type="password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">确认密码：</label>
            <div class="col-sm-4">
                <input id="confirm_password" name="confirm_password" class="form-control" type="password">
            </div>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <button class="btn btn-primary save" onclick="return false;">提交</button>
                <button class="btn btn-white" onclick="history.go(-1);return false;">返回</button>
            </div>
        </div>
    </form>
@endsection
@section('script')
<script>
$('.save').click(function(){
	var data = $("form").serializeObject();
	
	$.post("{{ url('user') }}", data, function(data){
			if (data.code == 10001) {
				return error(data.message);
			}
			
			success(data.message);
	})
	
	return false;
})
</script>
@endsection