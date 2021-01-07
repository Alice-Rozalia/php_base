<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改权限</title>
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
    <form class="layui-form" action="{{ route('admin.node.update', $data) }}" method="post">
        @method('PUT')
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="we-red">*</span>是否顶级
            </label>
            <div class="layui-input-inline">
                <select name="pid" lay-filter="aihao">
                    <option value="0">== 顶级 ==</option>
                    @foreach($menu as $item)
                        @if($item->id == $data->pid)
                            <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">
                <span class="we-red">*</span>节点名称
            </label>
            <div class="layui-input-inline">
                <input id="name" type="text" value="{{ $data->name }}" name="name" lay-verify="required"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="route_name" class="layui-form-label">
                路由别名
            </label>
            <div class="layui-input-inline">
                <input id="route_name" type="text" value="{{ $data->route_name }}" name="route_name" autocomplete="off"
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
            <label for="" class="layui-form-label"/>
            <button class="layui-btn" lay-submit="" type="submit">修改节点</button>
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