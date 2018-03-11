@extends('lizadmin::layouts.admin')
@section('title', '菜单管理')
@section('menu', '权限管理')
@section('next_menu', '菜单管理')
@section('resource')
<link href="{{ asset('/assets/js/plugins/bootstrap-table/extension/jquery-treegrid/css/jquery.treegrid.css') }}" >
<script src="{{ asset('/assets/js/plugins/bootstrap-table/extension/bootstrap-table-treegrid.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/bootstrap-table/extension/jquery-treegrid/js/jquery.treegrid.min.js') }}"></script>
@endsection
@section('content')
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <div class="example-wrap">
                            <div class="example">
                                <div class="btn-group hidden-xs" id="toolbar" role="group">
                                	<a href="{{ url('create') }}">
                                        <button type="button" class="btn btn-w-m btn-success">
                                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加菜单
                                        </button>
                                    </a>
                                </div>
                                <table id="table" data-height="800" data-mobile-responsive="true" data-toggle="table">
                            		<thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>菜单名称</th>
                                            <th>菜单路由</th>
                                            <th>菜单行为</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ str_repeat('—', $permission->level) }}{{ $permission->name }}</td>
                                            <td>{{ $permission->url }}</td>
                                            <td>{{ $permission->behavior }}</td>
                                            <td>
                                            	<a href="{{ url('create', [$permission->id])}}">
                                            		<button type="button" class="btn btn-success btn-sm">
                                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加子菜单
                                        </button>
                                            	</a>
                                            	<a href="{{ route('permission.edit', [$permission->id])}}">
                                            		<button type="button" class="btn btn-primary "><i class="fa fa-paste"></i> 编辑</button>
                                            	</a>
                                            	<button type="button" class="btn btn-danger btn-sm" onclick="getid('{{$permission->id}}')"><i class="fa fa-trash-o"></i> 删除</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
function getid(id) {
	_delete('/permission/' + id, id)
}
</script>
@endsection