<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/model3" method="post" enctype="multipart/form-data">
    姓名：<input type="text" name="name"><br>
    邮箱：<input type="text" name="email"><br>
    <input type="file" name="avatar"/><br>
    <input type="text" name="code" placeholder="验证码"><img id="img" src="{{captcha_src()}}">
    <br>
    {{csrf_field()}}
    <input type="submit" value="提交"/>

    @if(count($errors) > 0)
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
<script>
    let img = document.getElementById('img');
    img.onclick = function () {
        img.src = '{{captcha_src()}}' + '&_=' + Math.random();
    }
</script>
</body>
</html>