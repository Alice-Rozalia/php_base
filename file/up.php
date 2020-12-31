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
<?php
if (!empty($_POST)) {
    $info = finfo_open(FILEINFO_MIME_TYPE);
    // 将finfo资源和文件做对比
    $mime = finfo_file($info, $_FILES['file']['tmp_name']);
    $allow = array('image/jpeg', 'image/png', 'image/gif');
    echo in_array($mime, $allow) ? '文件合法' : '文件不合法';
}
?>

<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file"/>
    <input type="submit" name="btn"/>
</form>
</body>
</html>