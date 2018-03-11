@extends('lizadmin::layouts.admin')
@section('title', '角色管理')
@section('menu', '权限管理')
@section('next_menu', '角色管理')
@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="row row-lg">
            <div class="col-sm-12">
                <div class="example-wrap">
                    <div class="example">
                        <div class="btn-group hidden-xs" id="toolbar" role="group">
                        	<a href="{{ url('role/create') }}">
                                 <button type="button" class="btn btn-w-m btn-success">
                                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加角色
                                 </button>
                            </a>
                        </div>
                        <table id="table" data-height="400" data-mobile-responsive="true" >
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$('#table').bootstrapTable({
        url: '{{ url("getLimitRoles") }}',       
        method: 'post',                     
        toolbar: '#toolbar',               
        cache: false,                  
        pagination: true,              
        sortable: true,                 
        queryParams:  function (params) {
            return { 
                    limit: params.limit,  
                    offset: params.offset,
                    _token:'{{ csrf_token() }}'
           };
        },
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
        showToggle:false,                
        cardView: false,                
        detailView: false,            
        columns: [{
            field: "id",
            title: "ID",
        },{
            field: "name",
            title: "角色名称",
        },{
            field: "description",
            title: "角色描述",
        },{
            field: "created_at",
            title: "创建时间",
        },{
            field: "option",
            title: "操作",
            align: "center",
            formatter:function(value, row, index) {
                return '<button type="button" class="btn btn-primary" onclick="getPermissions('+row.id+')"><i class="fa fa-paste"></i> 编辑</button> ' +
                       '<button type="button" class="btn btn-danger" onclick="getid('+row.id+')"><i class="fa fa-trash-o"></i> 删除</button>'
            }
        },],
    });
function getPermissions(id)
{
	window.location.href = "/role/" +id+ "/edit";
}
function getid(id) {
	_delete('/role/' + id, id)
}
</script>
@endsection