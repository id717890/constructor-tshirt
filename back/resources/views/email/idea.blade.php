<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h1>Новое предложение</h1>

    @if(isset($name))
        <div>Имя: {{$name}}</div>
    @endif
    @if(isset($phone))
        <div>Контакты: {{$phone}}</div>
    @endif
    <div>
        {{$text}}
    </div>

</div>
</body>
</html>