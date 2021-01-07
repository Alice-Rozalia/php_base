<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>用户列表</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" href="/admin/static/css/font.css"/>
    <link rel="stylesheet" href="/admin/static/css/weadmin.css"/>
</head>

<body>
<div class="weadmin-nav">
			<span class="layui-breadcrumb">
				<a href="javascript:;">首页</a> <a href="javascript:;">用户管理</a>
				<a href="javascript:;"> <cite>用户列表</cite></a>
			</span>
    <a class="layui-btn layui-btn-sm" style="margin-top:3px;float:right"
       href="javascript:location.replace(location.href);"
       title="刷新">
        <i class="layui-icon layui-icon-refresh"></i>
    </a>
</div>

<div class="weadmin-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 we-search">
            用户搜索：
            <div class="layui-inline">
                <input type="text" name="key" placeholder="请输入用户名" value="{{ $key }}" autocomplete="off"
                       class="layui-input"/>
            </div>
            <button class="layui-btn" lay-submit="" lay-filter="sreach">
                <i class="layui-icon layui-icon-search"></i>
            </button>
        </form>
    </div>
    <div class="weadmin-block">
        <button class="layui-btn layui-btn-danger" style="background-color: #f56c6c" onclick="deleteAll()">
            <i class="layui-icon layui-icon-delete"></i>批量删除
        </button>
        <a class="layui-btn" href="{{ route('admin.user.create') }}" style="background-color: #409eff">
            <i class="layui-icon layui-icon-add-circle-fine"></i>添加
        </a>
        <span class="fr" style="line-height:40px">共有数据：{{$data->toArray()['total']}} 条</span>
    </div>
    <table class="layui-table" id="memberList">
        <thead>
        <tr>
            <th width="30px;">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary">
                    <i class="layui-icon">&#xe605;</i>
                </div>
            </th>
            <th width="30px;">ID</th>
            <th>用户名</th>
            <th>角色</th>
            <th width="30px;">性别</th>
            <th>手机</th>
            <th>邮箱</th>
            <th width="130px;">创建时间</th>
            <th width="50px;">状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr data-id="{{ $item->id }}">
                <td>
                    @if(auth()->id() != $item->id)
                        @if($item->deleted_at == null)
                            <div class="layui-unselect layui-form-checkbox" lay-skin="primary"
                                 data-id="{{ $item->id }}">
                                <i class="layui-icon">&#xe605;</i>
                            </div>
                        @endif
                    @endif
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->role->name }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at }}</td>
                <td class="td-status">
                    <span class="layui-btn layui-btn-normal layui-btn-xs" style="background-color: #21ba45">已启用</span>
                </td>
                <td class="td-manage">
                    {!! $item->allotBtn('admin.user.role') !!}
                    {!! $item->editBtn('admin.user.edit') !!}
                    @if(auth()->id() != $item->id)
                        @if($item->deleted_at != null)
                            {!! $item->restoreBtn('admin.user.restore') !!}
                        @else
                            {!! $item->deleteBtn('admin.user.delete') !!}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        {{ $data->links() }}
    </div>
</div>
<script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>
<script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(function () {
        tableCheck = {
            init: function () {
                $(".layui-form-checkbox").click(function (event) {
                    if ($(this).hasClass('layui-form-checked')) {
                        $(this).removeClass('layui-form-checked');
                        if ($(this).hasClass('header')) {
                            $(".layui-form-checkbox").removeClass('layui-form-checked');
                        }
                    } else {
                        $(this).addClass('layui-form-checked');
                        if ($(this).hasClass('header')) {
                            $(".layui-form-checkbox").addClass('layui-form-checked');
                        }
                    }

                });
            },
            getData: function () {
                var obj = $(".layui-form-checked").not('.header');
                var arr = [];
                obj.each(function (index, el) {
                    arr.push(obj.eq(index).attr('data-id'));
                });
                return arr;
            }
        };

        //开启表格多选
        tableCheck.init();
    });
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

    // 全选删除
    const deleteAll = () => {
        layui.use(['layer'], function () {
            layer.confirm('您真的要删除选中的用户吗？', {
                btn: ['确认删除', '思考一下']
            }, () => {
                let id = tableCheck.getData();
                if (id.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.user.deleteAll') }}",
                        data: {id, _token},
                        type: "DELETE"
                    }).then(({status, msg}) => {
                        if (status === 200) {
                            layui.use(['layer'], function () {
                                layer.msg(msg, {time: 1200, icon: 1}, () => {
                                    location.reload();
                                });
                            });
                        }
                    });
                }
            });
        });
    }
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
