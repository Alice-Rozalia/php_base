<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/semantic-ui/2.4.1/semantic.min.css">
</head>
<body>
<table class="ui celled table">
    <thead>
    <tr>
        <th>id</th>
        <th>姓名</th>
        <th>邮箱</th>
        <th>头像</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $val)
        <tr>
            <td>{{$val->id}}</td>
            <td>{{$val->name}}</td>
            <td>{{$val->email}}</td>
            <td>
                <img src="{{$val->avatar}}" width="280">
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4">
            <div class="ui right floated pagination menu">
                {{$data -> links()}}
            </div>
        </th>
    </tr>
    </tfoot>
</table>

</body>
</html>