@extends('lizadmin::layouts.admin')
@section('title', '编辑菜单')
@section('menu', '菜单管理')
@section('next_menu', '编辑菜单')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal m-t" id="editMenu">
                	<div class="form-group">
                        <label class="col-sm-3 control-label">菜单icon：</label>
                        <div class="col-sm-8">
                            <input id="icon" name="icon" class="form-control" value="{{$permission->icon}}" type="text" aria-required="true" aria-invalid="true" class="error">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>填入class即可，图标详情参照<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_BLANK">Font Awesome</a></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单名称：</label>
                        <div class="col-sm-8">
                            <input id="username" name="name" value="{{$permission->name}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单路由：</label>
                        <div class="col-sm-8">
                            <input id="username" name="url" value="{{$permission->url}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">菜单行为：</label>
                        <div class="col-sm-8">
                            <input id="username" name="behavior" value="{{$permission->behavior}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>以controller@index形式描述</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">权重：</label>
                        <div class="col-sm-8">
                            <input id="weight" name="weight" value="{{$permission->weight}}"class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-w-m btn-primary">提交</button>
                            <button class="btn btn-w-m btn-warning" onclick="history.go(-1);">返回</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/assets/js/plugins/validate/jquery.validate.min.js' )}}"></script>
<script src="{{ asset('/assets/js/plugins/validate/messages_zh.min.js' )}}"></script>
<script>
jQuery.validator.addMethod("isZipCode", function(value, element) {   
    var tel = /^[a-z]{4,20}\@[a-z]{4,20}$/;
    return this.optional(element) || (tel.test(value));
}, "行为规则以controller@action形式");
$("#editMenu").validate({
	rules: {
	 name: {
        required: true,
        minlength: 2,
        maxlength: 15,
      },url: {
        required: true,
        minlength: 2,
        maxlength: 100,
      },behavior: {
        required: false,
        isZipCode:true,
        minlength: 2,
        maxlength: 255,
      },weight: {
        required: true,
      },
    },
    submitHandler:function(form){
        var params = { icon:$('input[name=icon]').val(),name:$('input[name=name]').val(),url:$('input[name=url]').val(),
        			   behavior:$('input[name=behavior]').val(),weight:$('input[name=weight]').val(),
        				_token:"{{ csrf_token() }}", id:"{{$permission->id}}",_method:"PUT",
                	  }
        $.post("{{ url('permission', [$permission->id]) }}", params, function(data){
            if (data.status == 10001) {
            	 swal({
                     title: data.msg,
                     type: "info",
                     confirmButtonColor: "#DD6B55",
               });
            } else {
            	 swal({
                     title: data.msg,
                     type: "info",
                     confirmButtonColor: "#DD6B55",
               });
            }
        })
    }  
});  
</script>
@endsection