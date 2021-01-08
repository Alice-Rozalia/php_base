<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页</title>
    <link rel="stylesheet" href="/home/css/common.css">
    <link rel="stylesheet" href="/home/css/index.css">
    <link rel="stylesheet" href="/home/css/lib/swiper.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="/home/js/swiper.min.js"></script>

    <style>
        .swiper-container {
            margin: 50px auto 0;
            width: 1000px !important;
        }

        .swiper-slide {
            width: 1000px !important;
            height: 380px;
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .page {
            padding: 15px 0;
        }

        .pagination {
            justify-content: center;
        }
    </style>
</head>

<body>
<!-- 顶部模块 -->
<header>
    <div class="top_main">
        <div class="item">
            <ul>
                <li><a href="javascript:;"><i class="icomoon_i"></i>账号找回</a></li>
            </ul>
        </div>
        <div class="item">
            <ul>
                <li>
                    <form>
                        <input style="color: #fff;" type="text" class="top_search" name="key" value="{{ $key }}"
                               autocomplete="off"
                               placeholder="输入文章标题，回车搜索"
                               id="search">
                        <button style="display: none"></button>
                    </form>
                </li>
                <li>
                    <a href="javascript:;"><i class="icomoon_i"></i>手机版</a>
                </li>
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

<!-- 轮播图模块 -->
<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="javascript:;">
                    <img src="/home/images/b1.jpg"
                         width="1000px"/>
                    <div class="bottom-bg"></div>
                    <div class="title text-nowrap">栖霞山风景区牌上的翻译是不是错了？</div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="javascript:;">
                    <img src="/home/images/b2.jpg"
                         width="1000px"/>
                    <div class="bottom-bg"></div>
                    <div class="title text-nowrap">高淳福寿螺泛滥成灾，注意不要误食</div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="javascript:;">
                    <img src="/home/images/b3.jpg"
                         width="1000px"/>
                    <div class="bottom-bg"></div>
                    <div class="title text-nowrap">高淳福寿螺泛滥成灾，注意不要误食</div>
                </a>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
<!-- 轮播图模块 end -->

<!-- 文章列表模块 -->
<div class="article_list">
    @foreach($data as $item)
        <div class="post_list list_one_pic">
            <div class="pic">
                <a href="javascript:;">
                    <img src="{{ $item->pic }}">
                </a>
            </div>
            <div class="desc">
                <a href="{{ route('home.detail', $item) }}" class="click_title">
                    <div class="title">{{ $item->title }}</div>
                    <div class="info">{{ $item->summary }}</div>
                </a>
                <div class="bottom">
                    <a href="javascript:;">
                        <div class="board">分类</div>
                    </a>
                    <div class="auth">{{ $item->user->username }} | {{ $item->created_at }}</div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="page">
        {{ $data->links() }}
    </div>
</div>
<!-- 文章列表模块 end -->

<!-- 页面尾部 -->
<footer>
    <div class="copyright clearfix">
        <img src="/home/images/logo.jpg" width="240">
        <p>PHP实训。
            <br> © 2021年MO 保留所有权利。-桂ICP备99999999号
        </p>
    </div>
</footer>
<!-- 页面尾部 end -->

<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
</body>

</html>