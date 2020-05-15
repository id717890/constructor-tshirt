<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Каталог</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table {
            width: 100%;
        }

        .table-dense {
            font-size: 0.7rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered thead th,
        .table-bordered tbody td {
            border: 1px solid #dee2e6
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body style="font-family: DejaVu Serif;">
<table style="width: 100%">
    <tbody>
    <tr>
        <td style="width: 50%">
            <img style="max-height: 75px" src="image/logo3.png" alt="">
        </td>
        <td>
            <div>Способ оплаты и доставки</div>
            <div>Общая цена: {{$price}} руб.</div>
            <div>Способ доставки: {{$delivery}}</div>
            <div>Способ оплаты: {{$payment}}</div>
        </td>
    </tr>
    </tbody>

    <table style="width: 100%;">
        <tbody>
        <tr>
            <td>{{$typeCustomerText}}: {{$name}}</td>
        </tr>
        <tr>
            <td>Телефон: {{$phone}}</td>
        </tr>
        <tr>
            <td>E-mail: {{$email}}</td>
        </tr>
        <tr>
            <td>
                <h3>Заказ товар</h3>
            </td>
        </tr>
        <tr>
            <td>
                @if(isset($zakazTovar))
                    <table class="table-bordered table-dense" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Размер</th>
                            <th>Количество Москва</th>
                            <th>Количество Испания</th>
                            <th>Общее количество</th>
                            <th>Цена (руб.)</th>
                            <th>Сумма (руб.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($zakazTovar as $row)
                            <tr>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['size']}}</td>
                                <td>{{$row['inMoscow']}}</td>
                                <td>{{$row['inSpain']}}</td>
                                <td>{{$row['total']}}</td>
                                <td>{{$row['price']}}</td>
                                <td>{{$row['sum']}}</td>
                            </tr>
                        @endforeach
                        @if(count($zakazTovar)===0)
                            <tr>
                                <td colspan="7">Данные отсутствуют</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                @endif
            </td>
        </tr>
        @if(isset($zakazLogosEach))
            @foreach($zakazLogosEach as $order)
                <tr>
                    <td><h3>Заказ нанесение {{$order['name']}}</h3></td>
                </tr>
                <tr>
                    <td>
                        <table class="table-bordered table-dense">
                            <thead>
                            <tr>
                                <th>Нанесение</th>
                                <th>Кол-во</th>
                                <th>Цена (руб.)</th>
                                <th>Сумма (руб.)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order['rows'] as $row)
                                <tr>
                                    <td>{{$row['logoType']}}</td>
                                    <td>{{$row['count']}}</td>
                                    <td>{{$row['price']}}</td>
                                    <td>{{$row['sum']}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" style="border: 1px solid #dee2e6">Итого:</td>
                                <td style="border: 1px solid #dee2e6">{{$order['sum']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        @endif
        @if(isset($zakazLogos))
            <tr>
                <td><h3>Заказ нанесение ИТОГО</h3></td>
            </tr>
            <tr>
                <td>
                    <table class="table-bordered table-dense">
                        <thead>
                        <tr>
                            <th>Нанесение</th>
                            <th>Кол-во</th>
                            <th>Сумма (руб.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($zakazLogos as $row)
                            <tr>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['count']}}</td>
                                <td>{{$row['sum']}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Итого:</td>
                            <td>{{$zakazLogosSum}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        @endif
        @if(isset($zakazNumberName))
            <tr>
                <td><h3>РЗМЕР-НОМЕР-ФАМИЛИЯ</h3></td>
            </tr>
            <tr>
                <td>
                    <table class="table-bordered table-dense">
                        <thead>
                        <tr>
                            <th>Модель</th>
                            <th>Размер</th>
                            <th>Номер</th>
                            <th>ФИО</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($zakazNumberName as $row)
                            <tr>
                                <td>{{$row['name']}}</td>
                                <td>{{$row['size']}}</td>
                                <td>{{$row['number']}}</td>
                                <td>{{$row['fio']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endif
        <tr>
            <td>
                @if($typeCustomer == 'fizik')
                    @include('pdf.fizik_doc1',['date'=>$date, 'number'=>$number, 'fio'=>$fio])
                    <div class="page-break"></div>
                    @include('pdf.fizik_doc2',['date'=>$date, 'number'=>$number, 'fio'=>$fio, 'price' => $price])
                @endif
            </td>
        </tr>
        <tr>
            <td>
                @if($typeCustomer == 'yurik')
                    @include('pdf.yurik_doc1',['date'=>$date, 'number'=>$number, 'field1'=>$field1,  'field2'=>$field2,  'field3'=>$field3])
                    <div class="page-break"></div>
                    @include('pdf.yurik_doc2',['date'=>$date, 'number'=>$number, 'fio'=>$fio, 'field1'=>$field1,  'field2'=>$field2,  'field3'=>$field3, 'price' => $price])
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <div class="page-break"></div>
                @include('pdf.rules_form')
            </td>
        </tr>
        </tbody>
    </table>
</table>
</body>
</html>