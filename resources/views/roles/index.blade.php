@extends('lizadmin::layouts.admin')
@section('title', '角色管理')
@section('menu', '权限管理')
@section('next_menu', '角色管理')
@section('addUrl', url('role/create'))
@section('addTitle', '添加角色')
@section('th')
	<th>ID</th>
    <th>角色名称</th>
    <th>角色描述</th>
    <th>创建时间</th>
    <th>操作</th>
@endsection

@section('tbodyTr')
	@foreach ($roles as $role)
        <tr>
        	<td>{{ $role->id }}</td>
        	<td>{{ $role->name }}</td>
        	<td>{{ $role->description }}</td>
        	<td>{{ $role->created_at }}</td>
        	<td>
        		<a href="{{ route('role.edit', [ $role->id ]) }}">
       				<button class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 编辑</button>
       			</a>
       			<button class="btn btn-danger" onclick="destory(this);" data-url="{{ url('role', [ $role->id ]) }}"type="button"><i class="fa fa-trash-o"></i> 删除</button>
            </td>
        </tr>
    @endforeach
@endsection

@section('paginate')
	{{ $roles->links() }}
@endsection