@extends('lizadmin::layouts.admin')
@section('title', '用户管理')
@section('menu', '权限管理')
@section('next_menu', '用户管理')
@section('addUrl', url('user/create'))
@section('addTitle', '添加用户')
@section('th')
	<th>ID</th>
    <th>用户名</th>
    <th>邮箱</th>
    <th>超级用户</th>
    <th>创建时间</th>
    <th>操作</th>
@endsection

@section('tbodyTr')
	@foreach ($users as $user)
        <tr>
        	<td>{{ $user->id }}</td>
        	<td>{{ $user->name }}</td>
        	<td>{{ $user->email }}</td>
        	<td>{{ $user->is_super == 1 ? '否' : '否' }}</td>
        	<td>{{ $user->created_at }}</td>
        	<td>
        		<a href="{{ url('user', [$user->id]) }}">
       				<button class="btn btn-primary" type="button"><i class="fa fa-paste"></i> 编辑</button>
       			</a>
       			<button class="btn btn-danger" onclick="destory(this);" data-url="{{ url('user', [$user->id]) }}"type="button"><i class="fa fa-trash-o"></i> 删除</button>
            </td>
        </tr>
    @endforeach
@endsection

@section('paginate')
	{{ $users->links() }}
@endsection
