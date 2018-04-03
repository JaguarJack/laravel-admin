@extends('lizadmin::layouts.form')
@section('title', '添加菜单')
@section('menu', '菜单管理')
@section('next_menu', '添加菜单')
@section('resource')
@endsection
@section('content')
    <form class="form-horizontal m-t" id="addMenu">
       <div class="form-group">
            <label class="col-sm-3 control-label">菜单icon：</label>
            <div class="col-sm-8">
                <input id="icon" name="icon" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>填入class即可，图标详情参照<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_BLANK">Font Awesome</a></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">菜单名称：</label>
            <div class="col-sm-8">
                <input id="name" name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">菜单路由：</label>
            <div class="col-sm-8">
                <input id="url" name="url" class="form-control">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>路由以路由文件为准</span>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">菜单行为：</label>
            <div class="col-sm-8">
                <input id="behavior" name="behavior" class="form-control">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>以controller@index形式描述</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">权重：</label>
            <div class="col-sm-8">
                <input id="weight" name="weight" class="form-control" value="1">
            </div>
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="pid" value="{{ $id }}">
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
	
	if (!/^[a-z]{4,20}\@[a-z]{4,20}$/.test(data.behavior)) {
		error("行为规则以controller@action形式"); return false;
	}
	
	$.post("{{ url('permission') }}", data, function(data){
			if (data.code == 10001) {
				return error(data.message);
			}
			
			success(data.message);
	})
	
	return false;
})  
</script>
@endsection