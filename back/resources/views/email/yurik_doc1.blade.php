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
    <div style="text-align: justify; padding: 30px">
        <h4 class="text-center">ДОГОВОР КУПЛИ-ПРОДАЖИ № {{ $number }}</h4>

        <div class="d-flex flex-row flex-nowrap justify-space-between mb-5">
            <span>г.Москва</span>
            <span style="float: right;">{{ $date }}г.</span>
        </div>
        <div class="text-justify">
            Индивидуальный предприниматель Кляус Наталья Сергеевна, именуемый в
            дальнейшем «Продавец», в лице Кляус Натальи Сергеевны, действующей на
            основании Свидетельства о государственной регистрации физического лица
            в качестве индивидуального предпринимателя, с одной стороны, и {{$field1}}
            , именуемый в дальнейшем «Покупатель», в лице {{$field2}}
            , действующего на основании {{$field3}}
            , с другой стороны, совместно именуемые Стороны, заключили настоящий
            Договор о нижеследующем:
        </div>

        <h5 class="text-center">1. ПРЕДМЕТ ДОГОВОРА</h5>

        <p>
            1.1. В рамках настоящего договора Покупатель в любое время имеет право
            совершать ряд не связанных между собой сделок по купле-продаже
            спортивной одежды (далее — «Товар»). Основанием для возникновения прав
            и обязанностей по настоящему договору является обращение Покупателя с
            Заказом клиента на совершение сделки купли-продажи.
        </p>

        <p>
            1.2. Продавец обязуется передать в собственность Покупателя Товар в
            количестве, ассортименте и по ценам указанным в товарных накладных, а
            Покупатель принять и оплатить его. Предметом каждой сделки является
            купленный Товар в ассортименте, оговоренном в Заказе клиента и
            указанный в товарных накладных с итоговой суммой сделки, определяемой,
            как сумма всех товарных накладных отгруженного Товара по данному
            Заказу клиента.
        </p>

        <h5 class="text-center">2. СУММА ДОГОВОРА</h5>

        <p>
            2.1. Сумма Договора и цены на поставляемый Товар определяются заказом
            (Приложение №1), которая являются неотъемлемой частью настоящего
            Договора.
        </p>

        <p>
            2.2. Изменение цены Товара в течение срока действия настоящего
            Договора Продавцом без письменного согласия Покупателя
            недействительно.
        </p>

        <h5 class="text-center">3. ОБЯЗАННОСТИ СТОРОН</h5>

        <p>3.1. Продавец обязан:</p>

        <p>3.1.1. Направить Покупателю счет на оплату Товара.</p>

        <p>
            3.1.2. Передать Покупателю Товар надлежащего качества, в соответствии
            с ассортиментом и количеством, указанным в товарных накладных.
            Обязанность Продавца передать Товар считается исполненной с момента
            подписания товарно-транспортной накладной первым уполномоченным
            перевозчиком или представителем Покупателя со склада Продавца в г.
            Москва.
        </p>

        <p>
            3.1.3. Передать Покупателю все документы, относящиеся к Товару:
            товарно-транспортные накладные, счета.
        </p>

        <p>
            3.1.4. На основании акта, принять к возврату Товар, проданный
            Покупателем возвращенный в пределах гарантийного срока, с выявленными
            производственными дефектами. В этом случае Продавец возмещает
            стоимость возвращенного Товара, либо, по согласованию с Покупателем,
            заменяет бракованный Товар на качественный в течение 10 (десяти)
            рабочих дней.
        </p>

        <p>3.2. Покупатель обязан:</p>

        <p>
            3.2.1. Оформить заказ - Заказ клиента на сделку по купле-продаже, в
            которой должен указать артикул, цвет, размер и количество необходимого
            для поставки Товара.
        </p>

        <p>
            3.2.2. Обеспечить приемку товара. Приемка товара по количеству и
            качеству осуществляется в соответствии с законодательно установленными
            нормами на складе Продавца.
        </p>

        <h5 class="text-center">4. ГАРАНТИЙНЫЙ СРОК ТОВАРА</h5>

        <p>
            4.1. Покупатель вправе предъявлять претензии, связанные с
            производственными дефектами Товара, при их обнаружении в течение
            гарантийного срока.
        </p>

        <p>
            4.2. Срок гарантийных обязательств Продавца составляет 6 (шесть)
            месяцев с момента передачи Товара Покупателю.
        </p>

        <h5 class="text-center">5. ПОСТАВКА ТОВАРА</h5>

        <p>
            5.1. Доставка Товара до Покупателя осуществляется силами и средствами
            Покупателя.
        </p>

        <p>
            5.2. Товар по Заказу клиента поставляется со склада Продавца в
            г.Москва. Наименование, ассортимент, количество указаны в товарных
            накладных, являющихся неотъемлемой частью настоящего Договора.
        </p>

        <p>
            5.3. Датой поставки Товара считается дата получения товара Покупателем
            с оформлением всех необходимых документов, согласно п. 3.1.3.
        </p>

        <p>
            5.4. Условия поставки - Поставка товара на склад Покупателя за счет
            Поставщика.
        </p>

        <p>
            5.5. Срок поставки товара по Заказу клиента производится в течение 20
            (двадцати) календарных дней со дня поступления денежных средств на
            счет Поставщика.
        </p>

        <p>
            5.5. Поставщик по согласованию с Покупателем имеет право на досрочную
            поставку Товара при наличии Товара или его части на складе Поставщика
            в г. Москва.
        </p>

        <h5 class="text-center">6. ПОРЯДОК РАСЧЕТОВ</h5>

        <p>
            6.1. Оплата товара производится после подписания договора и
            выставления счета.
        </p>

        <p>
            6.2. Основанием для расчетов между сторонами являются данный договор и
            счет в котором указаны отпускные цены на товар Покупателю.
        </p>

        <p>
            6.3. Моментом оплаты считается дата поступления денег на расчетный
            счет Продавца.
        </p>

        <p>6.4. Покупатель оплачивает Товар в рублях.</p>

        <h5 class="text-center">7. ПРАВО СОБСТВЕННОСТИ</h5>

        <p>
            7.1. Право собственности на Товар переходит к Покупателю в момент
            фактической передачи Товара Полномочному представителю Покупателя.
        </p>

        <p>
            7.2. Риск случайной гибели или порчи товара переходит от Поставщика к
            Покупателю в момент передачи Товара первому перевозчику/экспедитору
            или уполномоченному представителю Покупателя, в зависимости какое
            событие наступит раньше.
        </p>

        <h5 class="text-center">8. ОТВЕТСТВЕННОСТЬ СТОРОН</h5>

        <p>
            8.1 В случае невыполнения полностью или частично своих обязательств,
            предусмотренных в п.п. 6, виновная сторона выплачивает другой стороне,
            по требованию последней, пени в размере 0,10% (десять сотых процента)
            от стоимости неоплаченного Товара за каждый день просрочки, но не
            более 10% стоимости неисполненного обязательства.
        </p>

        <h5 class="text-center">9. ГАРАНТИИ ИСПОЛНЕНИЯ ДОГОВОРА</h5>

        <p>
            9.1. За неисполнение или ненадлежащие исполнение обязательств по
            Договору Стороны несут ответственность в соответствии с действующим
            законодательством РФ.
        </p>

        <p>
            9.2. Покупатель обязан возместить убытки Продавца, возникшие в
            результате ненадлежащего исполнения Покупателем условий Договора.
        </p>

        <p>
            9.3. Стороны несут ответственность за невыполнение обязательств по
            Договору, если не докажут, что надлежащее исполнение оказалось
            невозможным вследствие непреодолимой силы, то есть чрезвычайных и
            непредотвратимых при данных условиях обстоятельств.
        </p>

        <h5 class="text-center">10. ПОРЯДОК РАЗРЕШЕНИЯ СПОРОВ</h5>

        <p>
            10.1. В случае возникновения споров и разногласий, стороны прилагают
            усилия для их разрешения путем переговоров.
        </p>

        <p>
            10.2. Если стороны не урегулировали разногласия в результате
            переговоров или досудебного претензионного порядка урегулирования
            спора, он передается на разрешение в Арбитражный суд г. Москвы в
            соответствии с законодательством РФ.
        </p>

        <p>
            10.3. Во всем остальном, что не предусмотрено Договором, Стороны
            руководствуются действующим законодательством РФ.
        </p>

        <h5 class="text-center">11. СРОК ДЕЙСТВИЯ ДОГОВОРА</h5>

        <p>
            11.1 Настоящий Договор вступает в силу с момента его подписания и
            действует до полного выполнения Сторонами своих обязательств.
        </p>

        <p>
            11.2 Договор может быть расторгнут Сторонами досрочно в одностороннем
            порядке путем направления уведомления о расторжении договора не менее
            чем за 30 (тридцать) календарных дней до предполагаемой даты
            расторжения, и в случаях, предусмотренных действующим
            законодательством РФ.
        </p>

        <p>
            11.3 При расторжении договора Стороны обязаны произвести все
            взаиморасчеты.
        </p>

        <p>
            11.4 Договор составлен в 2 (двух) экземплярах, имеющих одинаковую
            юридическую силу, по одному экземпляру для каждой из Сторон.
        </p>

        <p>
            11.5 Любые изменения и дополнения к Договору действительны при
            условии, если они совершены в письменно форме и подписаны
            уполномоченными представителями Сторон.
        </p>

        <h5 class="text-center">
            12. ЮРИДИЧЕСКИЕ АДРЕСА И ПЛАТЕЖНЫЕ РЕКВИЗИТЫ СТОРОН
        </h5>

        <div class="row" style="display: flex; flex-flow: row nowrap;  margin-bottom: 50px;">
            <table style="width: 100%; table-layout: fixed;">
                <tbody>
                <tr>
                    <td><h5>«ПОКУПАТЕЛЬ»</h5></td>
                    <td><h5>"ПРОДАВЕЦ"</h5></td>
                </tr>
                <tr>
                    <td style="height: 100%">
                        <div class="col-sm-12 col-md-6 d-flex flex-column"
                             style="display: flex; flex-flow: column; flex-basis: 50%; height: 100%">
                            <div class="d-flex flex-colum flex-grow-1" style="flex-grow: 2">
                                {!! $info !!}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-between"
                             style="display: flex; flex-flow: column; flex-basis: 50%;">
                            <div style="margin-bottom: 30px">
                                <br>
                                ИП Кляус Наталья Сергеевна
                                <br/>
                                ОГРНИП: 315500300005930
                                <br/>
                                ИНН 753609484820
                                <br/>
                                Тел./факс +7(967) 21-92-444
                                <br/>
                                Е-mail : s-klyaus@mail.ru
                                <br/>
                                р/с 40802810540000011210
                                <br/>
                                в ПАО Сбербанк
                                <br/>
                                г.Видное ул. Советская 34А
                                <br/>
                                К/с 30101810400000000225
                                <br/>
                                БИК: 044525225
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: inline-block; border-bottom: 1px solid black; height: 25px; width: 50% ">
                            <span style="position: relative; bottom: -30px;">Подписать</span>
                        </div>
                        <div style="display: inline-block; border-bottom: 1px solid black; height: 25px; width: 45%">
                            /
                        </div>
                    </td>
                    <td>
                        <div style="display: inline-block; border-bottom: 1px solid black; height: 25px; width: 50%">
                            <span style="position: relative; bottom: -30px;">м.п.</span></div>
                        <div style="display: inline-block; border-bottom: 1px solid black; height: 25px; width: 45%;">
                            /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Н.С. Кляус
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>
