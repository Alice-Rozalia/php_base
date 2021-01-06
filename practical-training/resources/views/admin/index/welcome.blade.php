<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/admin/static/css/font.css">
    <link rel="stylesheet" href="/admin/static/css/weadmin.css">

</head>

<body>
<div class="weadmin-body">
    <div class="layui-col-lg12 layui-collapse" style="border: none;">
        <div class="layui-col-lg6 layui-col-md12">
            <!--统计信息展示-->
            <fieldset class="layui-elem-field" style="padding: 5px;">
                <div class="layui-card">
                    <div class="layui-card-header layui-elem-quote">公告</div>
                    <div class="layui-card-body">
                        <div class="layui-carousel weadmin-notice" lay-filter="notice" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 280px;">
                            <div carousel-item="">
                                <div class="">
                                    <a href="https://gitee.com/lovetime/WeAdmin" target="_blank" class="layui-bg-red">2018年3月28日 WeAdmin小版本更新</a>
                                </div>
                                <div class="">
                                    <a href="http://www.layui.com/admin/" target="_blank" class="layui-bg-blue">首款 layui 官方后台模板系统正式发布</a>
                                </div>
                            </div>
                            <div class="layui-carousel-ind">
                                <ul>
                                    <li class="layui-this"></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<legend>信息统计</legend>-->
                <blockquote class="layui-elem-quote font16">信息统计</blockquote>
                <div class="">
                    <table class="layui-table" lay-even>
                        <thead>
                        <tr>
                            <th>统计</th>
                            <th>资讯库</th>
                            <th>图片库</th>
                            <th>产品库</th>
                            <th>用户</th>
                            <th>管理员</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>总数</td>
                            <td>92</td>
                            <td>9</td>
                            <td>0</td>
                            <td>8</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>今日</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>昨日</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>本周</td>
                            <td>2</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>本月</td>
                            <td>2</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th colspan="2" scope="col">服务器信息</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th width="30%">服务器计算机名</th>
                            <td><span id="lbServerName">http://127.0.0.1/</span></td>
                        </tr>
                        <tr>
                            <td>服务器IP地址</td>
                            <td>192.168.1.1</td>
                        </tr>
                        <tr>
                            <td>服务器域名</td>
                            <td>github.com</td>
                        </tr>
                        <tr>
                            <td>服务器端口 </td>
                            <td>80</td>
                        </tr>
                        <tr>
                            <td>上次更新时间 </td>
                            <td id="lastTime">12210分钟</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        <div class="layui-col-lg6 layui-col-md12">
            <fieldset class="layui-elem-field we-changelog" style="padding: 5px;">
                <!--更新日志-->
                <blockquote class="layui-elem-quote font16">发展历程&amp;更新日志</blockquote>
                <ul class="layui-timeline" style="height: 729px; overflow-y: auto;">
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>WeAdmin更新layui基础版本为V2.4.5</h3>
                                <span class="layui-badge-rim">2019-01-15</span>
                            </div>
                            <ul>
                                <li>更新layui基础版本为V2.4.5</li>
                                <li>更新字体图标的引入方式为iconfont(未修改完全，按照示例即可)</li>
                            </ul>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>WeAdmin更新layui基础版本为V2.2.6</h3>
                                <span class="layui-badge-rim">2018-04-03</span>
                            </div>
                            <ul>
                                <li>更新layui基础版本为V2.2.6</li>
                            </ul>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>WeAdmin小版本修复</h3>
                                <span class="layui-badge-rim">2018-03-28</span>
                            </div>
                            <ul>
                                <li>增加了文章分类添加、编辑页面</li>
                                <li>增加公用eleDel.js,个别通用页面独立加载</li>
                            </ul>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis" style="color: #FF5722;">&#xe756;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>WeAdmin重新整理js调用方法</h3>
                                <span class="layui-badge-rim">2018-02-05</span>
                            </div>
                            <blockquote class="layui-elem-quote">使用
                                <a href="http://www.layui.com/doc/base/modules.html#extend" target="_blank">layui扩展模块</a>的方法重写了admin.js,里面包含了整个We-admin后台框架中常用的方法。</blockquote>
                            <ul>
                                <li>增加了Tab菜单栏鼠标右键刷新、关闭方法</li>
                                <li>增加了Tab切换监听和删除监听事件</li>
                                <li>admin.js修改为layui扩展组件加载模式 &nbsp;<i class="layui-icon" style="font-size: 16px; color: #FF5722;">&#xe60c;</i></li>
                            </ul>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>增加echarts定制使用实例</h3>
                                <span class="layui-badge-rim">2018-02-01</span>
                            </div>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">
                                <h3>WeAdmin初步规划</h3>
                                <span class="layui-badge-rim">2018-01-01</span>
                            </div>
                            <p>
                                layui发版以来，很多朋友贡献了layui案例,其中后台相关案例占了比较大的比例。
                                <br>layui的案例layuicms/vip-admin/x-admin/jqadmin等等，甚至还有AdminLte/H-ui admin的demo
                            </p>
                        </div>
                    </li>
                </ul>
            </fieldset>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.extend({
        admin: '{/}/admin/static/js/admin',
    });
    layui.use(['jquery', 'element','util', 'admin', 'carousel'], function() {
        var element = layui.element,
            $ = layui.jquery,
            carousel = layui.carousel,
            util = layui.util,
            admin = layui.admin;
        //建造实例
        carousel.render({
            elem: '.weadmin-shortcut'
            ,width: '100%' //设置容器宽度
            ,arrow: 'none' //始终显示箭头
            ,trigger: 'hover'
            ,autoplay:false
        });

        carousel.render({
            elem: '.weadmin-notice'
            ,width: '100%' //设置容器宽度
            ,arrow: 'none' //始终显示箭头
            ,trigger: 'hover'
            ,autoplay:true
        });

        $(function(){
            setTimeAgo(2018,0,1,13,14,0,'#firstTime');
            setTimeAgo(2018,2,28,16,0,0,'#lastTime');
        });
        function setTimeAgo(y, M, d, H, m, s,id){
            var str = util.timeAgo(new Date(y, M||0, d||1, H||0, m||0, s||0));
            $(id).html(str);
            console.log(str);
        };
    });
</script>

</html>