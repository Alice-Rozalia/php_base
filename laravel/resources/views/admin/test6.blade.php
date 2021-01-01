<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/test7" method="post">
        收款人：<input type="text" name="name" placeholder="请输入收款人" /><br/>
        金额：<input type="text" name="name" placeholder="请输入金额" /><br/>
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        {{csrf_field()}}
        <input type="submit" value="转账" />
    </form>
</body>
</html>