@extends('lizadmin::layouts.form')
@section('title', '添加角色')
@section('menu', '角色管理')
@section('next_menu', '添加角色')
@section('resource')
@endsection
@section('content')
    <form class="form-horizontal m-t" id="addRole">
        <div class="form-group">
            <label class="col-sm-3 control-label">角色名：</label>
            <div class="col-sm-4">
                <input id="username" name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">角色描述：</label>
            <div class="col-sm-4">
                <input id="description" name="description" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
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
	
	$.post("{{ url('role') }}", data, function(data){
		if (data.code == 10001) {
			return error(data.message);
		}
		
		success(data.message);
	})
	
	return false;
})    
</script>
@endsection