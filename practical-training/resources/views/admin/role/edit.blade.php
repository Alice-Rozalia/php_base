<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改用户</title>
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
    <form class="layui-form" action="{{ route('admin.role.update', $role) }}" method="post">
        @method('PUT')
        @csrf
        <div class="layui-form-item">
            <label for="role_name" class="layui-form-label">
                <span class="we-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input id="role_name" type="text" value="{{ $role->name }}" name="name" lay-verify="required" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label"/>
            <button class="layui-btn" lay-submit="" type="submit">修改角色</button>
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