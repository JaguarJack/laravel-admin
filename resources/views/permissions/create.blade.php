@extends('lizadmin::layouts.admin')
@section('title', '添加菜单')
@section('menu', '菜单管理')
@section('next_menu', '添加菜单')
@section('resource')
@endsection
@section('content')
			<div class="ibox-content">
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
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-w-m btn-primary">提交</button>
                            <button class="btn btn-w-m btn-warning" onclick="history.go(-1);return false;">返回</button>
                        </div>
                    </div>
                </form>
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
$("#addMenu").validate({
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
        required: true,
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
        				_token:"{{ csrf_token() }}", pid:$('input[name=id]').val()
                	  }
        $.post("{{ url('permission') }}", params, function(data){
            	 swal({
                     title: data.msg,
                     type: (data.status == 10001 ? 'warning' : 'info') ,
                     confirmButtonColor: "#DD6B55",
               });
        });
    }  
});  
</script>
@endsection