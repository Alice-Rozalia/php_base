<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分配权限</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/semantic-ui/2.4.1/semantic.min.css">
    <script type="text/javascript" src="https://cdn.staticfile.org/layui/2.5.7/layui.js" charset="utf-8"></script>
    <style>
        #container {
            width: 500px;
            padding: 20px 30px 12px;
            margin: 100px auto 0;
        }

        .my-bom {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
<div class="ui compact segment" id="container">
    <form class="ui from" action="{{ route('admin.role.node', $role) }}" method="POST">
        @csrf
        @foreach($allNode as $item)
            <div class="field my-bom">
                <div class="ui checkbox">
                    <input type="checkbox" name="node[]" value="{{ $item['id'] }}"
                           @if(in_array($item['id'], $nodes)) checked @endif
                    >
                    <label>
                        {{ $item['html'] }}{{ $item['name'] }}
                    </label>
                </div>
            </div>
        @endforeach
        <div style="margin-top: 20px;">
            <button class="ui blue button" type="submit">分配权限</button>
        </div>
    </form>
</div>

@if(session()->has('success'))
    <script>
        layui.use(['layer'], function () {
            layer.msg('{{session('success')}}', {icon: 1});
        });
    </script>
@endif
</body>

</html>