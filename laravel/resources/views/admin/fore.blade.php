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
@extends('admin.head')
@section('head')
@endsection
<h1>循环操作</h1>
<hr/>
@foreach($data as $key => $val)
    {{$val->id}} - {{$val->name}} <br/>
@endforeach

<h4>
    今天是星期
    @if($day == 1)
        一
    @elseif($day == 2)
        二
    @elseif($day == 3)
        三
    @elseif($day == 4)
        四
    @elseif($day == 5)
        五
    @elseif($day == 6)
        六
    @else
        日
    @endif
</h4>
</body>
</html>