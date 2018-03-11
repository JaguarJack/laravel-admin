@extends('lizadmin::layouts.admin')
@section('title', '添加角色')
@section('menu', '角色管理')
@section('next_menu', '添加角色')
@section('resource')
@endsection
@section('content')
			<div class="ibox-content">
                <form class="form-horizontal m-t" id="addRole">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色名：</label>
                        <div class="col-sm-8">
                            <input id="username" name="username" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">角色描述：</label>
                        <div class="col-sm-8">
                            <input id="description" name="description" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
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
    @endsection
@section('script')
<script src="{{ asset('/assets/js/plugins/validate/jquery.validate.min.js' )}}"></script>
<script src="{{ asset('/assets/js/plugins/validate/messages_zh.min.js' )}}"></script>
<script src="{{ asset('/assets/js/demo/form-validate-demo.min.js' )}}"></script>
<script>
$("#addRole").validate({
	rules: {
      username: {
        required: true,
        minlength: 2,
        maxlength: 15,
      },description: {
          required: false,
          minlength: 2,
          maxlength: 255,
       },
	},
    submitHandler:function(form){
        var params = { name:$('input[name=username]').val(), description:$('input[name=description]').val(),_token:"{{ csrf_token() }}",}
        $.post("{{ url('role') }}", params, function(data){
            if (data.status == 10001) {
            	 formError($('input[name=name]'), data.msg)
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