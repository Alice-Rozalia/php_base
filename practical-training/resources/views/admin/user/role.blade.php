<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分配权限</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdn.staticfile.org/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        #container {
            width: 600px;
            padding: 20px 30px;
            margin: 100px auto 0;
        }

        .la {
            display: block;
            margin-bottom: 30px!important;
        }
    </style>
</head>

<body>
<div class="ui compact segment" id="container">
    <form class="ui from" action="{{ route('admin.user.allot', $user) }}" method="POST">
        @csrf
        <div class="ui form" style="margin-bottom: 20px;">
            <div class="grouped fields">
                <h2>你想为【{{ $user->username }}】分配什么角色？</h2>
                <label class="la">用户【{{ $user->username }}】当前的角色为【{{ $user->role->name }}】？</label>
                @foreach($allRole as $item)
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="role_id" value="{{ $item->id }}"
                                   @if($item->id == $user->role_id) checked="checked" @endif
                            >
                            <label>{{ $item->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="ui blue button" type="submit">分配角色</button>
    </form>
</div>
</body>

</html>