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
    <div class="fizik-contract-for-buy" style="text-align: justify; padding: 30px">
        <h4 class="text-center">ДОГОВОР КУПЛИ-ПРОДАЖИ №{{$number}}</h4>
        <div class="d-flex flex-row flex-nowrap justify-content-between mb-5">
            <span>г.Москва</span>
            <span style="float: right;">{{$date}}г.</span>
        </div>
        <p class="text-justify">
            Индивидуальный предприниматель Кляус Наталья Сергеевна,
            именуемый в дальнейшем
            «Продавец», в
            лице
            Кляус Натальи Сергеевны, действующей на основании
            Свидетельства о государственной
            регистрации
            физического лица в качестве индивидуального предпринимателя,
            с одной стороны, и {{$fio}}, именуемый в дальнейшем «Покупатель» с другой
            стороны, совместно именуемые Стороны, заключили настоящий
            Договор о нижеследующем:</p>
        <h5 style="font-size: 1.1rem" class="text-center">1. ПРЕДМЕТ ДОГОВОРА</h5>

        <p>
            <strong>1.1.</strong> В рамках настоящего договора
            Покупатель в любое время имеет право
            совершать
            ряд не связанных между собой сделок по купле-продаже
            спортивной одежды (далее —
            «Товар»).
            Основанием для возникновения прав и обязанностей по
            настоящему договору является
            обращение
            Покупателя с Заказом клиента на совершение сделки
            купли-продажи.
        </p>

        <p>
            <strong>1.2.</strong> Продавец обязуется передать в
            собственность Покупателя Товар в
            количестве,
            ассортименте и по
            ценам указанным в товарных накладных, а Покупатель принять и
            оплатить его. Предметом
            каждой
            сделки
            является купленный Товар в ассортименте, оговоренном в
            Заказе клиента и указанный в
            товарных
            накладных с итоговой суммой сделки, определяемой, как сумма
            всех товарных накладных
            отгруженного
            Товара по данному Заказу клиента.
        </p>
        <h5 style="font-size: 1.1rem" class="text-center">2. СУММА ДОГОВОРА</h5>

        <p>
            <strong>2.1.</strong> Сумма Договора и цены на поставляемый
            Товар определяются заказом
            (Приложение
            №1), которая
            являются неотъемлемой частью настоящего Договора.
        </p>

        <p>
            <strong>2.2.</strong> Изменение цены Товара в течение срока
            действия настоящего Договора
            Продавцом
            без письменного
            согласия Покупателя недействительно.
        </p>

        <h5 style="font-size: 1.1rem" class="text-center">3. ОБЯЗАННОСТИ СТОРОН</h5>

        <p><strong>3.1.</strong> Продавец обязан:</p>

        <p><strong>3.1.1.</strong> Направить Покупателю счет на оплату
            Товара.</p>

        <p><strong>3.1.2.</strong> Передать Покупателю Товар надлежащего
            качества, в соответствии
            с
            ассортиментом и количеством,
            указанным в товарных накладных. Обязанность Продавца
            передать Товар считается
            исполненной с
            момента
            подписания товарно-транспортной накладной первым
            уполномоченным перевозчиком или
            представителем
            Покупателя со склада Продавца в г. Москва.</p>

        <p><strong>3.1.3.</strong> Передать Покупателю все документы,
            относящиеся к Товару:
            товарно-транспортные накладные,
            счета.</p>

        <p><strong>3.1.4.</strong> На основании акта, принять к возврату
            Товар, проданный
            Покупателем
            возвращенный в пределах
            гарантийного срока, с выявленными производственными
            дефектами. В этом случае Продавец
            возмещает
            стоимость возвращенного Товара, либо, по согласованию с
            Покупателем, заменяет
            бракованный Товар
            на
            качественный в течение 10 (десяти) рабочих дней.</p>

        <p><strong>3.2.</strong> Покупатель обязан:</p>

        <p><strong>3.2.1.</strong> Оформить заказ - Заказ клиента на
            сделку по купле-продаже, в
            которой
            должен указать артикул,
            цвет, размер и количество необходимого для поставки Товара.
        </p>

        <p><strong>3.2.2.</strong> Обеспечить приемку товара. Приемка
            товара по количеству и
            качеству
            осуществляется в
            соответствии с законодательно установленными нормами на
            складе Продавца.</p>

        <h5 style="font-size: 1.1rem" class="text-center">4. ГАРАНТИЙНЫЙ СРОК ТОВАРА</h5>

        <p><strong>4.1.</strong> Покупатель вправе предъявлять
            претензии, связанные с
            производственными
            дефектами Товара, при их
            обнаружении в течение гарантийного срока.</p>

        <p><strong>4.2.</strong> Срок гарантийных обязательств Продавца
            составляет 6 (шесть)
            месяцев с
            момента передачи Товара
            Покупателю.</p>

        <h5 style="font-size: 1.1rem" class="text-center">5. ПОСТАВКА ТОВАРА</h5>

        <p><strong>5.1.</strong> Доставка Товара до Покупателя
            осуществляется силами и средствами
            Покупателя.</p>

        <p><strong>5.2.</strong> Товар по Заказу клиента поставляется со
            склада Продавца в
            г.Москва.
            Наименование,
            ассортимент,
            количество указаны в товарных накладных, являющихся
            неотъемлемой частью настоящего
            Договора.</p>

        <p><strong>5.3.</strong> Датой поставки Товара считается дата
            получения товара Покупателем
            с
            оформлением всех
            необходимых документов, согласно п. 3.1.3.</p>

        <p><strong>5.4.</strong> Условия поставки - Поставка товара на
            склад Покупателя за счет
            Поставщика.
        </p>

        <p><strong>5.5.</strong> Срок поставки товара по Заказу клиента
            производится в течение 20
            (двадцати)
            календарных дней
            со
            дня поступления денежных средств на счет Поставщика.</p>

        <p><strong>5.5.</strong> Поставщик по согласованию с Покупателем
            имеет право на досрочную
            поставку
            Товара при наличии
            Товара или его части на складе Поставщика в г. Москва.</p>

        <h5 style="font-size: 1.1rem" class="text-center">6. ПОРЯДОК РАСЧЕТОВ</h5>

        <p><strong>6.1.</strong> Оплата товара производится после
            подписания договора и
            выставления счета.
        </p>

        <p><strong>6.2.</strong> Основанием для расчетов между сторонами
            являются данный договор и
            счет в
            котором указаны
            отпускные цены на товар Покупателю.</p>

        <p><strong>6.3.</strong> Моментом оплаты считается дата
            поступления денег на расчетный
            счет
            Продавца.</p>

        <p><strong>6.4.</strong> Покупатель оплачивает Товар в рублях.
        </p>

        <h5 style="font-size: 1.1rem" class="text-center">7. ПРАВО СОБСТВЕННОСТИ</h5>

        <p><strong>7.1.</strong> Право собственности на Товар переходит
            к Покупателю в момент
            фактической
            передачи Товара
            Полномочному представителю Покупателя.</p>

        <p><strong>7.2.</strong> Риск случайной гибели или порчи товара
            переходит от Поставщика к
            Покупателю
            в момент
            передачи
            Товара первому перевозчику/экспедитору или уполномоченному
            представителю Покупателя, в
            зависимости
            какое событие наступит раньше.</p>

        <h5 style="font-size: 1.1rem" class="text-center">8. ОТВЕТСТВЕННОСТЬ СТОРОН</h5>

        <p><strong>8.1 </strong>В случае невыполнения полностью или
            частично своих обязательств,
            предусмотренных в п.п. 6,
            виновная сторона выплачивает другой стороне, по требованию
            последней, пени в размере
            0,10%
            (десять
            сотых процента) от стоимости неоплаченного Товара за каждый
            день просрочки, но не более
            10%
            стоимости неисполненного обязательства.
        </p>

        <h5 style="font-size: 1.1rem" class="text-center">9. ГАРАНТИИ ИСПОЛНЕНИЯ ДОГОВОРА</h5>

        <p><strong>9.1.</strong> За неисполнение или ненадлежащие
            исполнение обязательств по
            Договору
            Стороны несут
            ответственность в соответствии с действующим
            законодательством РФ.</p>

        <p><strong>9.2.</strong> Покупатель обязан возместить убытки
            Продавца, возникшие в
            результате
            ненадлежащего
            исполнения
            Покупателем условий Договора.</p>

        <p><strong>9.3.</strong> Стороны несут ответственность за
            невыполнение обязательств по
            Договору,
            если не докажут, что
            надлежащее исполнение оказалось невозможным вследствие
            непреодолимой силы, то есть
            чрезвычайных
            и
            непредотвратимых при данных условиях обстоятельств.</p>

        <h5 style="font-size: 1.1rem" class="text-center">10. ПОРЯДОК РАЗРЕШЕНИЯ СПОРОВ</h5>

        <p><strong>10.1.</strong> В случае возникновения споров и
            разногласий, стороны прилагают
            усилия
            для
            их разрешения путем
            переговоров.</p>

        <p><strong>10.2.</strong> Если стороны не урегулировали
            разногласия в результате
            переговоров или
            досудебного
            претензионного порядка урегулирования спора, он передается
            на разрешение в Арбитражный
            суд г.
            Москвы
            в соответствии с законодательством РФ.</p>

        <p><strong>10.3.</strong> Во всем остальном, что не
            предусмотрено Договором, Стороны
            руководствуются
            действующим
            законодательством РФ.</p>

        <h5 style="font-size: 1.1rem" class="text-center">11. СРОК ДЕЙСТВИЯ ДОГОВОРА</h5>

        <p><strong>11.1 </strong>Настоящий Договор вступает в силу с
            момента его подписания и
            действует до
            полного выполнения
            Сторонами своих обязательств.</p>

        <p><strong>11.2 </strong>Договор может быть расторгнут Сторонами
            досрочно в одностороннем
            порядке
            путем направления
            уведомления о расторжении договора не менее чем за 30
            (тридцать) календарных дней до
            предполагаемой
            даты расторжения, и в случаях, предусмотренных действующим
            законодательством РФ.</p>

        <p><strong>11.3 </strong>При расторжении договора Стороны
            обязаны произвести все
            взаиморасчеты.
        </p>

        <p><strong>11.4 </strong>Договор составлен в 2 (двух)
            экземплярах, имеющих одинаковую
            юридическую
            силу, по одному
            экземпляру для каждой из Сторон.</p>

        <p><strong>11.5 </strong>Любые изменения и дополнения к Договору
            действительны при
            условии, если
            они
            совершены в
            письменно форме и подписаны уполномоченными представителями
            Сторон.</p>

        <h5 style="font-size: 1.1rem" class="text-center">12. ЮРИДИЧЕСКИЕ АДРЕСА И ПЛАТЕЖНЫЕ
            РЕКВИЗИТЫ СТОРОН</h5>

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
                                <br>
                                ОГРНИП: 315500300005930
                                <br>
                                ИНН 753609484820
                                <br>
                                Тел./факс +7(967) 21-92-444
                                <br>
                                Е-mail : s-klyaus@mail.ru
                                <br>
                                р/с 40802810540000011210
                                <br>
                                в ПАО Сбербанк
                                <br>
                                г.Видное ул. Советская 34А
                                <br>
                                <br>
                                К/с 30101810400000000225
                                <br>
                                БИК: 044525225

                                Карта СБ 4276 4000 5311 7280
                                <br>
                                В назначении платежа указать № заказа
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
