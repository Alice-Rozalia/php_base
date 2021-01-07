<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>权限列表</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" href="/admin/static/css/font.css"/>
    <link rel="stylesheet" href="/admin/static/css/weadmin.css"/>
</head>

<body>
<div class="weadmin-nav">
			<span class="layui-breadcrumb">
				<a href="javascript:;">首页</a> <a href="javascript:;">权限管理</a>
				<a href="javascript:;"> <cite>权限列表</cite></a>
			</span>
    <a class="layui-btn layui-btn-sm" style="margin-top:3px;float:right"
       href="javascript:location.replace(location.href);"
       title="刷新">
        <i class="layui-icon layui-icon-refresh"></i>
    </a>
</div>

<div class="weadmin-body">
    <div class="weadmin-block">
        <a class="layui-btn" href="{{ route('admin.node.create') }}">
            <i class="layui-icon layui-icon-add-circle-fine"></i>添加
        </a>
    </div>
    <table class="layui-table" id="memberList">
        <thead>
        <tr>
            <th width="30px;">ID</th>
            <th>节点名称</th>
            <th>路由别名</th>
            <th>是否菜单</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr data-id="{{ $item['id'] }}">
                <td>{{ $item['id'] }}</td>
                <td>
                    {{ $item['html'] }}
                    {{ $item['name'] }}
                </td>
                <td>{{ $item['route_name'] }}</td>
                {{--                <td>{!! $item['menu'] !!}</td>--}}
                <td>
                    @if($item['is_menu'])
                        <a href="javascript:;" class="layui-btn layui-btn-normal layui-btn-xs"
                           style="background-color: #21ba45">是</a>
                    @else
                        <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs"
                           style="background-color: #f78989">否</a>
                    @endif
                </td>
                <td>{{ $item['created_at'] }}</td>
                <td class="td-manage">
                    <a href="{{ route('admin.node.edit', ['id'=>$item['id']]) }}" class="layui-btn layui-btn-xs"
                       style="background-color: #409eff">编辑</a>
                    <a href="{{ route('admin.node.destroy', ['id'=>$item['id']]) }}"
                       class="layui-btn layui-btn-danger layui-btn-xs deleteBtn"
                       style="background-color: #f56c6c">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>
<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script>
    const _token = "{{ csrf_token() }}";
    $('.deleteBtn').click(function (e) {
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {_token},
            dataType: 'json'
        }).then(({status, msg}) => {
            if (status === 200) {
                layui.use(['layer'], function () {
                    layer.msg(msg, {time: 1200, icon: 1}, () => {
                        location.reload();
                    });
                });
            }
        });
        return false;
    });
</script>
@if(session()->has('success'))
    <script>
        layui.use(['layer'], function () {
            layer.msg('{{session('success')}}', {icon: 1});
        });
    </script>
@endif
</body>
</html>
