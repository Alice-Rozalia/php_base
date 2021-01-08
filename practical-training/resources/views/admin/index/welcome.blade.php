<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台欢迎页</title>
    <script src="https://cdn.staticfile.org/echarts/4.8.0/echarts.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url("/admin/images/bg.jpg");
            background-size: cover;
        }

        .main {
            padding: 20px 0 0 50px;
        }

        .bar {
            width: 600px;
            height: 500px;
        }
        
        .ip {
            font-size: 16px;
            color: #fff;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
<div class="main">
    <div>
        <p class="ip">本次登录的IP：{{ request()->ip() }}</p>
    </div>
    <div class="bar"></div>
</div>

<script>
    let myChart = echarts.init(document.querySelector(".bar"));

    var option = {
        color: ['#2f89cf'],
        tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        // 修改图表的大小
        grid: {
            left: '0%',
            top: '10px',
            right: '0%',
            bottom: '4%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['用户总数', '启用状态用户数量', '文章总数', '未禁用文章总数'],
            axisTick: {
                alignWithLabel: true
            },
            // 修改x轴刻度标签的相关样式
            axisLabel: {
                color: "rgba(255, 255, 255, .6)",
                fontSize: "12"
            },
            // 不显示x坐标轴的线
            axisLine: {
                show: false
            }
        }],
        yAxis: [{
            type: 'value',
            // 修改y轴刻度标签的相关样式
            axisLabel: {
                color: "rgba(255, 255, 255, .6)",
                // 数字的双引号可加可不加
                fontSize: 12
            },
            axisLine: {
                lineStyle: {
                    color: "rgba(255, 255, 255, .1)",
                    width: 2
                }
            },
            // y轴分割线的颜色
            splitLine: {
                lineStyle: {
                    color: "rgba(255, 255, 255, .1)",
                }
            }
        }],
        series: [{
            name: '直接访问',
            type: 'bar',
            barWidth: '35%',
            data: [{{ $user['total'] }}, {{ $user['useTotal'] }}, {{ $article['total'] }}, {{ $article['useTotal'] }}],
            itemStyle: {
                // 修改柱子的圆角
                barBorderRadius: 5
            }
        }]
    };
    myChart.setOption(option);
    window.addEventListener("resize", function () {
        myChart.resize();
    })
</script>
</body>

</html>