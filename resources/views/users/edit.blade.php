@extends('lizadmin::layouts.form')
@section('title', '编辑用户')
@section('menu', '用户管理')
@section('next_menu', '编辑用户')
@section('resource')
<link href="{{ asset('/assets/css/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
<script src="{{ asset('/assets/js/content.min.js?v=1.0.0') }}"></script>
<script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js') }}"></script>
@endsection
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content">
    	 <div class="row">
            <div class="col-sm-10" style="min-height:400px;">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">编辑用户</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">授权角色</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                              <form class="form-horizontal m-t" id="editUserInfo">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">用户名：</label>
                                        <div class="col-sm-8">
                                            <input id="username" name="name" value="{{ $user->name }}" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-mail：</label>
                                        <div class="col-sm-8">
                                            <input id="email" name="email" class="form-control" type="email" value="{{ $user->email }}">
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
                                        <label class="col-sm-3 control-label">是否为超级用户：</label>
                                        <div class="col-sm-8">
                                           <div class="onoffswitch">
                                           <input type="checkbox" name="is_super" class="onoffswitch-checkbox" id="status" {{$user->is_super == 1 ? 'checked' : ''}} value="{{$user->is_super}}">
                                           <label class="onoffswitch-label" for="status">
                                           <span class="onoffswitch-inner"></span>
                                           <span class="onoffswitch-switch"></span></label></div></div>
                                    </div>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-3">
                                            <button class="btn btn-w-m btn-primary save" onclick="return false;">提交</button>
                                            <button class="btn btn-w-m btn-warning" onclick="history.go(-1);return false;">返回</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            	 <table id="userrole" data-height="400" data-mobile-responsive="true">
                                </table>
                                <a href="javascript:;"><button type="button" class="btn btn-primary authuser" style="margin-top:10px;text-align:center;">提交</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
@section('script')
<link href="{{ asset('/assets/css/plugins/switchery/switchery.css' )}}" rel="stylesheet">
<script src="{{ asset('/assets/js/plugins/switchery/switchery.js' )}}"></script>
<script>
$('#userrole').bootstrapTable({
    url: '{{ url("getRolesOfUser") }}',    
    method: 'post',                  
    toolbar: '#toolbar',             
    pagination: true,  
    sortable: true,                   
    queryParams: function(params){return {
    	 limit: params.limit,
         offset: params.offset,
         user_id:"{{$user->id}}",
         _token:'{{ csrf_token() }}'
    }},
    sidePagination: "server",        
    pageNumber:1,                  
    pageSize: 10,
    showRefresh: true,                    
    height: 400,                  
    uniqueId: "ID",
    columns: [{
        checkbox: true,
        formatter:function(value, row, index){
            return {
            checked : row.check//设置选中
        }},
    }, {
        field: "name",
        title: "角色名",
    },{
        field: "description",
        title: "角色描述",
    },],
});
$('.authuser').click(function () {
    var ids = $.map($('#userrole').bootstrapTable('getSelections'), function (row) {
        return row.id;
    });
    var params = {}
	params.role    = ids
	params.user_id = "{{$user->id}}"
	params._token  = '{{ csrf_token() }}'
	$.post("{{url('giveRoleToUser')}}", params, function(data){
		if (data.status == 10000) {
			success(data.message);
		} else {
			error(data.message);
		}
	});
	return false;
});
$('.save').click(function(){
	var data = $("form").serializeObject();
	
	$.post("{{ url('user', [ $user->id ]) }}", data, function(data){
			if (data.status == 10001) {
				return error(data.message);
			}
			success(data.message);
	})
	return false;
})
$('#editUserInfo').on('change', '.onoffswitch-checkbox', function(){
	$(this).val($(this).val() == 1 ? 2 : 1);
})
</script>
@endsection