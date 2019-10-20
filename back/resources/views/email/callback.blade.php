<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    Новое уведомление с <a href="{{getenv('WEB_SITE')}}" target="_blank">сайта</a>.
    <br>
    {{ $text }}
    <br>
    Имя: {{ $name }}
    <br>
    Телефон: {{ $phone }}
</div>
</body>
</html>