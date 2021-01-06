<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>登录页</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" media="screen" href="/admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/reset.css"/>
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

<div id="particles-js">
    <div class="login">
        <div class="login-top">后台登录</div>
        <form action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="images/name.png"/></div>
                <div class="login-center-input">
                    <input type="text" name="username" placeholder="请输入您的用户名" onfocus="this.placeholder=''"
                           onblur="this.placeholder='请输入您的用户名'"/>
                    <div class="login-center-input-text">用户名</div>
                </div>
            </div>
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="images/password.png"/></div>
                <div class="login-center-input">
                    <input type="password" name="password" placeholder="请输入您的密码" onfocus="this.placeholder=''"
                           onblur="this.placeholder='请输入您的密码'"/>
                    <div class="login-center-input-text">密码</div>
                </div>
            </div>
            <div style="padding-left: 50px;">
                <button class="login-button" type="submit">登录</button>
            </div>
        </form>

        {{-- 错误信息提示 --}}
        @include('admin.common.validate')
        {{-- 退出登录消息提示 --}}
        @include('admin.common.message')
    </div>
</div>

<script src="/admin/js/particles.min.js"></script>
<script src="/admin/js/app.js"></script>
</body>
</html>