<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章详情页</title>
    <link rel="stylesheet" href="/home/css/common.css">
    <link rel="stylesheet" href="/home/css/article.css">
</head>

<body>
<!-- 顶部模块 -->
<header>
    <div class="top_main">
        <div class="item">
            <ul>
                <li><a href="/"><i class="icomoon_i"></i>首页</a></li>
            </ul>
        </div>
        <div class="item">
            <ul>
                <li>
                    @if(auth()->user())
                        <div class="isLogin">
                            <i class="icomoon_i"></i>
                            <i class="nickName">
                                {{ auth()->user()->username }}
                                <a style="padding-left: 15px;" href="{{ route('admin.logout') }}">退出</a>
                            </i>
                        </div>
                    @else
                        <div class="isnotLogin">
                            <a href="{{ route('admin.login') }}">登录</a> | <a
                                    href="javaScript:;">注册</a>
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- 顶部模块 end -->

<div class="article_main">
    <div class="article_title">
        <h2>{{ $article->title }}</h2>
    </div>
    <div class="author_info">
        <span>{{ $article->user->username }}</span> |
        <span>{{ $article->created_at }}</span>
    </div>
    <div class="text_con">
        {!! $article->content !!}
    </div>
</div>

<!-- 页面尾部 -->
<footer>
    <div class="copyright clearfix">
        <img src="/home/images/logo.jpg" width="240">
        <p>PHP实训。
            <br> © 2021MO 保留所有权利。-桂ICP备99999999号
        </p>
    </div>
</footer>
<!-- 页面尾部 end -->

</body>

</html>