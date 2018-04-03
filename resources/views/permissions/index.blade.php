@extends('lizadmin::layouts.admin')
@section('title', '菜单管理')
@section('menu', '权限管理')
@section('next_menu', '菜单管理')

@section('addUrl', url('create'))
@section('addTitle', '添加菜单')
@section('tableTr')
<th>ID</th>
<th>菜单名称</th>
<th>菜单路由</th>
<th>菜单行为</th>
<th>操作</th>
@endsection

@section('th')
<th>ID</th>
<th>菜单名称</th>
<th>菜单路由</th>
<th>菜单行为</th>
<th>操作</th>
@endsection

@section('tbodyTr')
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
        	<button type="button" class="btn btn-danger btn-sm" onclick="destory(this);" data-url="{{ url('permission', [$permission->id]) }}" ><i class="fa fa-trash-o"></i> 删除</button>
        </td>
    </tr>
@endforeach
@endsection
@section('script')

@endsection