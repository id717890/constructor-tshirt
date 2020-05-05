<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Каталог</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body style="font-family: DejaVu Serif;">
<h1>{{ $heading}}</h1>

<div>{{$content}}</div>
{{--@if(isset($sizes))--}}
{{--<table width="100%" style="width:100%" border="1">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th>Модель</th>--}}
{{--<th>Цвет</th>--}}
{{--<th>Размер</th>--}}
{{--<th>Цена (руб.)</th>--}}
{{--<th>На складе</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--@foreach($sizes as $size)--}}
{{--<tr>--}}
{{--<td>{{$size->color->model->name}}</td>--}}
{{--<td>{{$size->color->name}}</td>--}}
{{--<td>{{$size->size}}</td>--}}
{{--<td>{{$size->price}}</td>--}}
{{--<td>{{$size->count}}</td>--}}
{{--</tr>--}}
{{--@endforeach--}}
{{--</tbody>--}}
{{--</table>--}}
{{--@endif--}}
</body>
</html>