<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.staticfile.org/layui/2.5.7/layui.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .main {
            padding: 20px 15px 10px 15px;
        }
    </style>
</head>

<body>
<div class="main">
    <form>
        <div class="ui form">
            <div class="inline fields">
                <div class="five wide field">
                    <input type="text" name="key" value="{{ $key }}" autocomplete="off" placeholder="请输入文章标题进行搜索...">
                </div>
                <div class="two wide field">
                    <button class="ui primary button">
                        搜索
                    </button>
                </div>
                <a href="{{ route('admin.article.create') }}" class="ui teal button">编写文章</a>
            </div>
        </div>
    </form>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>ID</th>
            <th width="150">标题</th>
            <th>摘要</th>
            <th width="160">创建时间</th>
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->summary }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    {!! $item->editBtn2('admin.article.edit') !!}
                    @if(auth()->id() != $item->id)
                        @if($item->deleted_at != null)
                            {!! $item->restoreBtn2('admin.article.restore') !!}
                        @else
                            {!! $item->deleteBtn2('admin.article.destroy') !!}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="5">
                {{ $data->links() }}
            </th>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    const _token = "{{ csrf_token() }}";
    $('.deleteBtn').click(function (e) {
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {_token},
            dataType: 'json'
        }).then(({status, msg}) => {
            if (status === 200) {
                layui.use(['layer'], function () {
                    layer.msg(msg, {time: 1200, icon: 1}, () => {
                        location.reload();
                    });
                });
            }
        });
        return false;
    });
</script>
@if(session()->has('success'))
    <script>
        layui.use(['layer'], function () {
            layer.msg('{{session('success')}}', {icon: 1});
        });
    </script>
@endif
</body>

</html>