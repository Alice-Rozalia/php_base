<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加文章</title>
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
    <form enctype="multipart/form-data" class="layui-form" action="{{ route('admin.article.store') }}" method="post">
        @csrf
        <div class="layui-form-item">
            <label for="a_title" class="layui-form-label">
                <span class="we-red">*</span>文章标题
            </label>
            <div class="layui-input-inline">
                <input id="a_title" type="text" name="title" lay-verify="required" autocomplete="off"
                       class="layui-input" style="width: 700px;">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="a_summary" class="layui-form-label">
                <span class="we-red">*</span>文章描述
            </label>
            <div class="layui-input-inline">
                <input id="a_summary" type="text" name="summary" lay-verify="required" autocomplete="off"
                       class="layui-input" style="width: 700px;">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="a_pic" class="layui-form-label">
                文章封面
            </label>
            <div class="layui-input-inline">
                <input id="a_pic" type="file" name="pic" class="layui-input" style="width: 700px;">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="a_pic" class="layui-form-label">
                <span class="we-red">*</span>文章内容
            </label>
            <div class="layui-input-inline">
                <div style="min-height: 300px;width: 850px;" id="editor"></div>
                <textarea name="content" id="content" style="display: none"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label"/>
            <button class="layui-btn" lay-submit="" id="subBtn">确认发布</button>
        </div>
    </form>

    @include('admin.common.validate')
</div>

<script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="https://unpkg.com/wangeditor/dist/wangEditor.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    const E = window.wangEditor;
    const editor = new E('#editor');

    editor.config.onchange = function (newHtml) {
        $("#content").val(newHtml);
    };
    editor.config.onchangeTimeout = 1000;
    editor.create();
</script>
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