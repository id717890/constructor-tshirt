<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    Новое уведомление с <a href="{{getenv('WEB_SITE')}}" target="_blank">сайта визитки</a>.
    <br>
    {{ $text }}
    <br>
    Запрошенный объект:
    <br>
    {!! $result  !!}
</div>
</body>
</html>