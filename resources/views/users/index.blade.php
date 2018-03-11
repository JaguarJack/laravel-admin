@extends('lizadmin::layouts.admin')
@section('title', '用户管理')
@section('menu', '权限管理')
@section('next_menu', '用户管理')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="row row-lg">
            <div class="col-sm-12">
                <div class="btn-group hidden-xs" id="toolbar" role="group">
                	<a href="{{ url('user/create') }}">
                         <button type="button" class="btn btn-w-m btn-success">
                                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加用户
                          </button>
                    </a>
                </div>
                <table id="table" data-height="400" data-mobile-responsive="true" ></table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<link href="{{ asset('/assets/css/plugins/switchery/switchery.css' )}}" rel="stylesheet">
<script src="{{ asset('/assets/js/plugins/switchery/switchery.js' )}}"></script>
<script>
$('#table').bootstrapTable({
    url: '{{ url("getUsers") }}',    
    method: 'post',                  
    toolbar: '#toolbar',             
    striped: false,                  
    cache: false,   
    pagination: true,  
    sortable: true,                   
    queryParams: function(params){return {
    	 limit: params.limit,
         offset: params.offset,
         _token:'{{ csrf_token() }}'
    }},
    sidePagination: "server",        
    pageNumber:1,                  
    pageSize: 10,                  
    search: false,                    
    strictSearch: true,
    showColumns: true,             
    showRefresh: true,               
    minimumCountColumns: 2,           
    clickToSelect: false,            
    height: 600,                  
    uniqueId: "ID",
    columns: [{
        field: "id",
        title: "ID",
    }, {
        field: "name",
        title: "用户名",
    }, {
    	field: "email",
        title: "邮箱",
    }, {
    	field: "is_super",
        title: "是否为超级用户",
        formatter: function(value, row, index) {
            return '<div class="onoffswitch">' +
                   '<input type="checkbox" uid="'+row.id+'" data="'+value+'" class="onoffswitch-checkbox" id="status'+value+'"'+(value == 1 ? ' checked' : '')+'>' +
                   '<label class="onoffswitch-label" for="status'+value+'">' +
                   '<span class="onoffswitch-inner"></span>'+
                   '<span class="onoffswitch-switch"></span></label></div></div>';
            },
    }, {
        field: "created_at",
        title: "创建时间",
    }, {
        title: "操作",
        formatter: function(value, row, index) {
			return '<a href="/user/'+row.id+'"><button class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 编辑</button></a> ' +
					'<button class="btn btn-danger" onclick="getid('+row.id+')" type="button"><i class="fa fa-trash-o"></i> 删除</button>'
        },
    }],
});

$('#table').on('change', '.onoffswitch-checkbox', function(){
	var _this = $(this);
	var status = _this.attr('data') == 1 ? 2 : 1;
	$.post('{{url("user/changeStatus")}}', {id:_this.attr('uid'), status:status, _token:"{{csrf_token()}}"}, function(data){
		if (data.status == '10001') {
			swal({
                title:"Warning",
                text: data.msg,
                type: "warning",
                confirmButtonColor: "#DD6B55",
            });
			} else {
				_this.attr('data', data.data.status);
			}
	})
})
function getid(id) {
	alert(id)
	_delete('/user/' + id, id)
}
</script>
@endsection