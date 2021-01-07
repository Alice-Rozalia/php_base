<!doctype html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/admin/static/css/font.css">
    <link rel="stylesheet" href="/admin/static/css/weadmin.css">
    <script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.min.js" charset="utf-8"></script>

</head>

<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="/">MO</a>
    </div>
    <div class="left_open">
        <i title="展开左侧栏" class="layui-icon layui-icon-shrink-right"></i>
    </div>

    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ auth()->user()->username }}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a href="{{ route('admin.user.edit', auth()->user()) }}">个人信息</a>
                </dd>
                <dd>
                    <a class="loginout" href="{{ route('admin.logout') }}">退出</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/">前台首页</a>
        </li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            @foreach($menu as $item)
                <li>
                    <a href="javascript:;">
                        <i class="layui-icon {{ $item['icon'] }}"></i>
                        <cite>{{ $item['name'] }}</cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        @foreach($item['sub'] as $child)
                            <li>
                                <a _href="{{ route($child['route_name']) }}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>{{ $child['name'] }}</cite>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="wenav_tab" id="WeTabTip" lay-allowclose="true">
        <ul class="layui-tab-title" id="tabName">
            <li>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{ route('admin.welcome') }}' frameborder="0" scrolling="yes" class="weIframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2021 MO</div>
</div>
<!-- 底部结束 -->
<script type="text/javascript">
    layui.config({
        base: '/admin/static/js/'
        , version: '101100'
    }).use('admin');
</script>
</body>
<!--Tab菜单右键弹出菜单-->
<ul class="rightMenu" id="rightMenu">
    <li data-type="fresh">刷新</li>
    <li data-type="current">关闭当前</li>
    <li data-type="other">关闭其它</li>
    <li data-type="all">关闭所有</li>
</ul>

</html>