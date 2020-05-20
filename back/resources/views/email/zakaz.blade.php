<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .table-sm td, .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-borderless tbody + tbody, .table-borderless td, .table-borderless th, .table-borderless thead th {
            border: 0
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-primary, .table-primary > td, .table-primary > th {
            background-color: #b8daff
        }

        .table-primary tbody + tbody, .table-primary td, .table-primary th, .table-primary thead th {
            border-color: #7abaff
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff
        }

        .table-hover .table-primary:hover > td, .table-hover .table-primary:hover > th {
            background-color: #9fcdff
        }

        .table-secondary, .table-secondary > td, .table-secondary > th {
            background-color: #d6d8db
        }

        .table-secondary tbody + tbody, .table-secondary td, .table-secondary th, .table-secondary thead th {
            border-color: #b3b7bb
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf
        }

        .table-hover .table-secondary:hover > td, .table-hover .table-secondary:hover > th {
            background-color: #c8cbcf
        }

        .table-success, .table-success > td, .table-success > th {
            background-color: #c3e6cb
        }

        .table-success tbody + tbody, .table-success td, .table-success th, .table-success thead th {
            border-color: #8fd19e
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb
        }

        .table-hover .table-success:hover > td, .table-hover .table-success:hover > th {
            background-color: #b1dfbb
        }

        .table-info, .table-info > td, .table-info > th {
            background-color: #bee5eb
        }

        .table-info tbody + tbody, .table-info td, .table-info th, .table-info thead th {
            border-color: #86cfda
        }

        .table-hover .table-info:hover {
            background-color: #abdde5
        }

        .table-hover .table-info:hover > td, .table-hover .table-info:hover > th {
            background-color: #abdde5
        }

        .table-warning, .table-warning > td, .table-warning > th {
            background-color: #ffeeba
        }

        .table-warning tbody + tbody, .table-warning td, .table-warning th, .table-warning thead th {
            border-color: #ffdf7e
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1
        }

        .table-hover .table-warning:hover > td, .table-hover .table-warning:hover > th {
            background-color: #ffe8a1
        }

        .table-danger, .table-danger > td, .table-danger > th {
            background-color: #f5c6cb
        }

        .table-danger tbody + tbody, .table-danger td, .table-danger th, .table-danger thead th {
            border-color: #ed969e
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7
        }

        .table-hover .table-danger:hover > td, .table-hover .table-danger:hover > th {
            background-color: #f1b0b7
        }

        .table-light, .table-light > td, .table-light > th {
            background-color: #fdfdfe
        }

        .table-light tbody + tbody, .table-light td, .table-light th, .table-light thead th {
            border-color: #fbfcfc
        }

        .table-hover .table-light:hover {
            background-color: #ececf6
        }

        .table-hover .table-light:hover > td, .table-hover .table-light:hover > th {
            background-color: #ececf6
        }

        .table-dark, .table-dark > td, .table-dark > th {
            background-color: #c6c8ca
        }

        .table-dark tbody + tbody, .table-dark td, .table-dark th, .table-dark thead th {
            border-color: #95999c
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe
        }

        .table-hover .table-dark:hover > td, .table-hover .table-dark:hover > th {
            background-color: #b9bbbe
        }

        .table-active, .table-active > td, .table-active > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover > td, .table-hover .table-active:hover > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #212529;
            border-color: #32383e
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .table-dark {
            color: #fff;
            background-color: #212529
        }

        .table-dark td, .table-dark th, .table-dark thead th {
            border-color: #32383e
        }

        .table-dark.table-bordered {
            border: 0
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, .05)
        }

        .table-dark.table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, .075)
        }
    </style>
</head>
<body>
<div>
    <h1>Информация о заказе</h1>

    <div style="font-size: 1.3rem">{!! $info !!}</div>
    <br><br>

    <div style="font-size: 1.3rem">Способ доставки: {!! $delivery !== null && $delivery !== '' ? $delivery : 'не указано'!!}</div>
    <div style="font-size: 1.3rem">Способ оплаты: {!!  $payment !== null && $payment !== '' ? $payment : 'не указано'!!}</div>
    <br><br>

    <h1>Заказ товар</h1>
    <table class="table table-hover table-bordered"
           style="width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6"
            >
        <thead>
        <tr>
            <th style="border: 1px solid #dee2e6">Наименование</th>
            <th style="border: 1px solid #dee2e6">Размер</th>
            <th style="border: 1px solid #dee2e6">Количество Москва</th>
            <th style="border: 1px solid #dee2e6">Количество Испания</th>
            <th style="border: 1px solid #dee2e6">Общее количество</th>
            <th style="border: 1px solid #dee2e6">Цена (руб.)</th>
            <th style="border: 1px solid #dee2e6">Сумма (руб.)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($zakazTovar as $row)
            <tr>
                <td style="border: 1px solid #dee2e6">{{$row['name']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['size']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['inMoscow']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['inSpain']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['total']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['price']}}</td>
                <td style="border: 1px solid #dee2e6">{{$row['sum']}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="border: 1px solid #dee2e6">Итого:</td>
            <td style="border: 1px solid #dee2e6">{{$zakazTovarSum}}</td>
        </tr>
        </tbody>
    </table>

    @if(isset($zakazLogosEach))
        @foreach($zakazLogosEach as $order)
            <h1>Заказ нанесение {{$order['name']}}</h1>
            <table class="table table-hover table-bordered"
                   style="width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6"
                    >
                <thead>
                <tr>
                    <th style="border: 1px solid #dee2e6">Нанесение</th>
                    <th style="border: 1px solid #dee2e6">Кол-во</th>
                    <th style="border: 1px solid #dee2e6">Цена (руб.)</th>
                    <th style="border: 1px solid #dee2e6">Сумма (руб.)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order['rows'] as $row)
                    <tr>
                        <td style="border: 1px solid #dee2e6">{{$row['logoType']}}</td>
                        <td style="border: 1px solid #dee2e6">{{$row['count']}}</td>
                        <td style="border: 1px solid #dee2e6">{{$row['price']}}</td>
                        <td style="border: 1px solid #dee2e6">{{$row['sum']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="border: 1px solid #dee2e6">Итого:</td>
                    <td style="border: 1px solid #dee2e6">{{$order['sum']}}</td>
                </tr>
                </tbody>
            </table>
        @endforeach
    @endif

    @if(isset($zakazLogos))
        <h1>Заказ нанесение ИТОГО</h1>
        <table class="table table-hover table-bordered"
               style="width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6"
                >
            <thead>
            <tr>
                <th style="border: 1px solid #dee2e6">Нанесение</th>
                <th style="border: 1px solid #dee2e6">Кол-во</th>
                <th style="border: 1px solid #dee2e6">Сумма (руб.)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($zakazLogos as $row)
                <tr>
                    <td style="border: 1px solid #dee2e6">{{$row['name']}}</td>
                    <td style="border: 1px solid #dee2e6">{{$row['count']}}</td>
                    <td style="border: 1px solid #dee2e6">{{$row['sum']}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="border: 1px solid #dee2e6">Итого:</td>
                <td style="border: 1px solid #dee2e6">{{$zakazLogosSum}}</td>
            </tr>
            </tbody>
        </table>
    @endif

    @if(isset($zakazNumberName))
        <h1>РЗМЕР-НОМЕР-ФАМИЛИЯ</h1>
        <table class="table table-hover table-bordered"
               style="width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6"
                >
            <thead>
            <tr>
                <th style="border: 1px solid #dee2e6">Модель</th>
                <th style="border: 1px solid #dee2e6">Размер</th>
                <th style="border: 1px solid #dee2e6">Номер</th>
                <th style="border: 1px solid #dee2e6">ФИО</th>
            </tr>
            </thead>
            <tbody>
            @foreach($zakazNumberName as $row)
                <tr>
                    <td style="border: 1px solid #dee2e6">{{$row['name']}}</td>
                    <td style="border: 1px solid #dee2e6">{{$row['size']}}</td>
                    <td style="border: 1px solid #dee2e6">{{$row['number']}}</td>
                    <td style="border: 1px solid #dee2e6">{{$row['fio']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <br>
    {{--Договор купли-продажи ФИЗИК--}}
    @if($typeCustomer == 'fizik')
        @include('email.fizik_doc1',['date'=>$date, 'number'=>$number, 'fio'=>$fio])
        @include('email.fizik_doc2',['date'=>$date, 'number'=>$number, 'fio'=>$fio, 'price' => $price])
    @endif

    @if($typeCustomer == 'yurik')
        @include('email.yurik_doc1',['date'=>$date, 'number'=>$number, 'field1'=>$field1,  'field2'=>$field2,  'field3'=>$field3])
        @include('email.yurik_doc2',['date'=>$date, 'number'=>$number, 'fio'=>$fio, 'field1'=>$field1,  'field2'=>$field2,  'field3'=>$field3, 'price' => $price])
    @endif
</div>
</body>
</html>