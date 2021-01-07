<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加权限</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/admin/static/css/font.css">
    <link rel="stylesheet" href="/admin/static/css/weadmin.css">
    <style>
        .tip {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            color: firebrick;
        }
    </style>
</head>

<body>
<div class="weadmin-body">
    <form class="layui-form" action="{{ route('admin.node.store') }}" method="post">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="we-red">*</span>是否顶级
            </label>
            <div class="layui-input-inline">
                <select name="pid" lay-filter="aihao">
                    <option value="0">== 顶级 ==</option>
                    @foreach($data as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="we-red">*</span>节点名称
            </label>
            <div class="layui-input-inline">
                <input id="name" type="text" value="{{ old('name') }}" name="name" lay-verify="required"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="route_name" class="layui-form-label">
                路由别名
            </label>
            <div class="layui-input-inline">
                <input id="route_name" type="text" value="{{ old('route_name') }}" name="route_name" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="is_menu" class="layui-form-label">
                <span class="we-red">*</span>是否菜单
            </label>
            <div class="layui-input-block" id="is_menu">
                <input type="radio" name="is_menu" value="1" title="是" checked="">
                <input type="radio" name="is_menu" value="0" title="否">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label"/>
            <button class="layui-btn" lay-submit="" type="submit">添加节点</button>
        </div>
    </form>

    @include('admin.common.validate')
</div>
<script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>

<script>
    layui.extend({
        admin: '{/}/admin/static/js/admin'
    });
    layui.use(['form', 'layer'], function () {
        var form = layui.form,
            layer = layui.layer;
    });
</script>
</body>

</html>