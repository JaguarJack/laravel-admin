@extends('lizadmin::layouts.admin')
@section('title', '编辑角色')
@section('menu', '角色管理')
@section('next_menu', '编辑角色')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-10" style="min-height:400px;">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">编辑角色</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">授权权限</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                            	<form class="form-horizontal m-t" id="editRole">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">角色名：</label>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" value="{{$role->name}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">角色描述：</label>
                                        <div class="col-sm-8">
                                            <input id="description" name="description" value="{{$role->description}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
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
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            	<div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                      <ul id="treeDemo" class="ztree"></ul>
                                    </div>
                                 </div>
                                <div class="form-group" style="margin-top:100px;">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button class="btn btn-w-m btn-primary submitPer">提交</button>
                                        <button class="btn btn-w-m btn-warning" onclick="history.go(-1);return false;">返回</button>
                                    </div>
                                 </div>
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
<script src="{{ asset('/assets/js/plugins/validate/jquery.validate.min.js' )}}"></script>
<script src="{{ asset('/assets/js/plugins/validate/messages_zh.min.js' )}}"></script>
<script src="{{ asset('/assets/js/demo/form-validate-demo.min.js' )}}"></script>
<link rel="stylesheet" href="{{ asset('/assets/css/ztree.css' )}}" type="text/css">
<script type="text/javascript" src="{{ asset('/assets/js/plugins/ztree/jquery.ztree.core.js' )}}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/plugins/ztree/jquery.ztree.excheck.js' )}}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/plugins/ztree/jquery.ztree.exedit.js' )}}"></script>
<script>
$("#editRole").validate({
	rules: {
		name: {
        required: true,
        minlength: 2,
        maxlength: 15,
      },
      description: {
        required: false,
        minlength: 5,
        maxlength:255,
      },
    },
    submitHandler:function(form){
        var params = {}
        params['name'] = $('input[name=name]').val()
        params['description'] = $('input[name=description]').val()
        params['_token'] = "{{ csrf_token() }}"
        params['_method'] = "PUT"
        formSubmit("{{ url('role', [$role->id]) }}", params);
    }  
}); 
</script>
<SCRIPT type="text/javascript">
	var setting = {
		view: {
		},
		check: {
			enable: true
		},
		data: {
			simpleData: {
				enable: true
			}
		},callback:{
			onCheck:onCheck
		}
	};

	$(document).ready(function(){
		$.get('{{ url("getPermissions")}}',{role_id:"{{ $role->id }}"},function(data){
			$.fn.zTree.init($("#treeDemo"), setting, data.rows);
		})
		
	});

	var ids;
	function onCheck(e,treeId,treeNode){
        var treeObj=$.fn.zTree.getZTreeObj("treeDemo");
        nodes = treeObj.getCheckedNodes(true);
        ids = new Array()
        for(var i=0; i<nodes.length; i++){
            ids.push(nodes[i].id); //获取选中节点的值
        }
    }
   
	 $(".submitPer").click(function(){
		var params = {}
        params['role_id'] = "{{ $role->id }}"
        params['_token'] = "{{ csrf_token() }}"
        params['permission'] = ids
        formSubmit("{{ url('givePermissionsToRole') }}", params);
	})
</SCRIPT>
@endsection