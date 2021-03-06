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
        <h4 class="text-center">ДОГОВОР ОКАЗАНИЯ УСЛУГ № {{ $number }}</h4>

        <div class="d-flex flex-row flex-nowrap justify-space-between mb-5">
            <span>г.Москва</span>
            <span style="float: right">{{ $date }}г.</span>
        </div>
        <div class="text-justify">
            Индивидуальный предприниматель Кляус Наталья Сергеевна, именуемый в
            дальнейшем «Исполнитель», в лице Кляус Натальи Сергеевны, действующей
            на основании Свидетельства о государственной регистрации физического
            лица в качестве индивидуального предпринимателя, с одной стороны, и {{$field1}}
            , именуемое в дальнейшем «Заказчик», в лице {{$field2}}
            , действующего на основании {{$field3}}
            с другой стороны, совместно именуемые Стороны, заключили настоящий
            Договор о нижеследующем:
        </div>

        <h5 class="text-center">1. ПРЕДМЕТ ДОГОВОРА</h5>

        <p>
            1.1. Исполнитель обязуется оказать Заказчику услуги (далее – Услуги),
            предусмотренные п. 1.2 настоящего договора, а Заказчик обязуется
            оплатить эти Услуги.
        </p>

        <p>
            1.2 Услуги по нанесению логотипов и номеров, вид, содержание и объем
            нанесения логотипов и номеров определены в утвержденном макете и
            заказе, которые являются неотъемлемой частью настоящего Договора.
        </p>

        <h5 class="text-center">2. ПОРЯДОК ОКАЗАНИЯ УСЛУГ</h5>

        <p>2.1. Услуги оказываются в месте нахождения Исполнителя.</p>

        <h5 class="text-center">3. ЦЕНА ДОГОВОРА</h5>

        <p>
            3.1. Стоимость Услуг, оказываемых Исполнителем составляет
            <b>{{ $price }}</b> руб. ноль копеек (НДС не облагается)
            определяется согласно заказом от {{ $date }}г. и макета,
            являющиеся неотъемлемой частью настоящего Договора.
        </p>

        <p>
            3.2. Стоимость Услуг включает вознаграждение Исполнителя, а также
            возмещение издержек и дополнительных расходов Исполнителя, связанных с
            исполнением настоящего Договора.
        </p>

        <h5 class="text-center">4. УСЛОВИЯ И ПОРЯДОК ОПЛАТЫ</h5>

        <p>
            4.1. Оплата стоимости оказанных Услуг производится Заказчиком в
            безналичной форме путем перечисления денежных средств на расчетный
            счет, указанный Исполнителем. Обязательства Заказчика по оплате
            стоимости Услуг считаются исполненными с момента зачисления средств на
            расчетный счет, указанный Исполнителем.
        </p>

        <p>
            4.2. Оплата стоимости Услуг производится Заказчиком в размере 100% не
            позднее 5 (пяти) рабочих дней с момента заключения настоящего договора
            и выставлении счета.
        </p>

        <h5 class="text-center">5. СРОКИ ОКАЗАНИЯ УСЛУГ</h5>

        <p>
            5.1. Услуги, указанные в п. 1.1. настоящего Договора, оказываются
            Исполнителем в течении 5 (пяти) рабочих дней с момента поступления
            товара на склад Исполнителя.
        </p>

        <p>
            5.2. Стороны вправе изменить сроки оказания услуг, указанные в п. 5.1.
            настоящего Договора, путем заключения дополнительного соглашения к
            настоящему Договору.
        </p>

        <h5 class="text-center">6. ПОРЯДОК ПРИЕМКИ УСЛУГ</h5>

        <p>
            6.1. Приемка услуг, оказанных Исполнителем, осуществляется путем
            подписания Сторонами акта об оказании услуг.
        </p>

        <p>
            6.2. Акт об оказании услуг составляется и подписывается Сторонами
            настоящего Договора в течение трех рабочих дней с момента оказания
            Услуг в полном объеме.
        </p>

        <h5 class="text-center">7. ОТВЕТСТВЕННОСТЬ СТОРОН</h5>

        <p>
            7.1. В случае нарушения срока оплаты Услуг, указанного в п. 4.2.
            настоящего Договора, Заказчик выплачивает Исполнителю неустойку в
            размере 1 % от стоимости Услуг, указанной в п. 3.1. настоящего
            Договора за каждый день просрочки.
        </p>

        <p>
            7.2. В случае нарушения срока оказания Услуг, указанного в п. 5.1.
            настоящего Договора, Исполнитель выплачивает Заказчику неустойку в
            размере 1 % от стоимости Услуг, указанной в п. 3.1. настоящего
            Договора за каждый день просрочки.
        </p>

        <p>
            7.3. В случаях, не предусмотренных настоящим Договором,
            ответственность Сторон определяется в соответствии с действующим
            законодательством.
        </p>

        <h5 class="text-center">8. ФОРС МАЖОР</h5>

        <p>
            8.1. Ни одна из Сторон не несет ответственности за полное или
            частичное неисполнение обязательств по Настоящему договору, если это
            явилось следствием обстоятельств непреодолимой силы, а именно: пожар,
            землетрясение, наводнение, иные стихийные бедствия, забастовки,
            военные действия, действий органов государственной власти и местного
            самоуправления.
        </p>

        <p>
            8.2. Сторона, для которой наступили обстоятельства, указанные в п.
            8.1. настоящего Договора, должна немедленно известить другую сторону о
            наступлении таковых.
        </p>

        <p>
            8.3. Если обстоятельства, указанные в п. 8.1. настоящего Договора,
            будут продолжаться более 6 месяцев, каждая Сторона имеет право
            отказаться от дальнейшего исполнения обязательств по настоящему
            договору, и в этом случае ни одна из Сторон не будет иметь права
            требовать от другой Стороны возмещения возможных убытков.
        </p>

        <h5 class="text-center">9. СПОРЫ И РАЗНОГЛАСИЯ</h5>

        <p>
            9.1. Все споры и разногласия по настоящему договору будут разрешаться
            путем переговоров на основе действующего законодательства и обычаев
            делового оборота.
        </p>

        <p>
            9.2. При не урегулировании спорных вопросов в процессе переговоров
            споры разрешаются в суде в порядке, установленном действующим
            законодательством.
        </p>

        <h5 class="text-center">10. АНТИКОРРУПЦИОННАЯ ОГОВОРКА.</h5>

        <p>
            10.1 Каждая из Сторон Договора, ее аффилированные лица, работники или
            посредники отказываются от стимулирования каким-либо образом
            работников другой Стороны, в том числе путем предоставления денежных
            сумм, подарков, безвозмездного выполнения в их адрес работ (услуг) и
            другими, не поименованными здесь способами, ставящего работника в
            определенную зависимость и направленного на обеспечение выполнения
            этим работником каких-либо действий в пользу стимулирующей его
            Стороны.
        </p>

        <p>
            10.2. Под действиями работника, осуществляемыми в пользу стимулирующей
            его Стороны, понимаются:
            <br/>
            1) предоставление неоправданных преимуществ по сравнению с другими
            контрагентами;
            <br/>
            2) предоставление каких-либо гарантий;
            <br/>
            3) ускорение существующих процедур;
            <br/>
            4) иные действия, выполняемые работником в рамках своих должностных
            обязанностей, но идущие вразрез с принципами прозрачности и открытости
            взаимоотношений между Сторонами.
        </p>

        <p>
            10.3. В случае возникновения у Стороны подозрений, что произошло или
            может произойти нарушение каких-либо положений настоящего раздела
            Договора, соответствующая Сторона обязуется уведомить другую Сторону в
            письменной форме. После письменного уведомления, соответствующая
            Сторона имеет право приостановить исполнение обязательств по
            настоящему Договору до получения подтверждения от другой Стороны после
            проведённой ею проверки, что нарушения не произошло или не произойдет.
            Это подтверждение должно быть направлено в течение десяти рабочих дней
            с даты направления письменного уведомления.
        </p>

        <p>
            10.4. В случае нарушения одной Стороной обязательств воздерживаться от
            запрещенных настоящим разделом действий и/или неполучения другой
            Стороной в установленный Договором срок подтверждения, что нарушения
            не произошло или не произойдет, другая Сторона имеет право расторгнуть
            Договор в одностороннем порядке, направив письменное уведомление о
            расторжении. Сторона, по чьей инициативе был расторгнут настоящий
            Договор в соответствии с положениями настоящей статьи, вправе
            требовать возмещения реального ущерба, возникшего в результате такого
            расторжения.
        </p>

        <h5 class="text-center">11. КОНФИДЕНЦИАЛЬНОСТЬ.</h5>

        <p>
            11.1. В течение срока действия настоящего Договора, а также в течение
            12 месяцев после его прекращения Стороны не должны предоставлять или
            разглашать иным способом конфиденциальную информацию, полученную в
            результате совместной деятельности, равно как и не должны
            недобросовестно использовать такую информацию для того, чтобы самим
            конкурировать друг с другом.
        </p>

        <h5 class="text-center">12. ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ</h5>

        <p>
            12.1. Все изменения и дополнения к настоящему Договору являются его
            неотъемлемыми частями и действительны, если совершены в той же форме,
            что и настоящий договор, и подписаны обеими Сторонами или надлежаще
            уполномоченными на то представителями Сторон.
        </p>

        <p>
            12.2. Настоящий Договор составлен в двух экземплярах: по одному
            экземпляру для Исполнителя и Заказчика. Каждый экземпляр имеет равную
            юридическую силу.
        </p>

        <p>
            12.3. Все уведомления и сообщения в рамках исполнения настоящего
            Договора должны направляться в письменной форме c уведомлением о
            вручении и описью вложения.
        </p>

        <p>
            12.4. Во всем остальном, не предусмотренном настоящим договором,
            Стороны будут руководствоваться действующим законодательством РФ.
        </p>

        <h5 class="text-center">
            13. ЮРИДИЧЕСКИЕ АДРЕСА, ПЛАТЕЖНЫЕ РЕКВИЗИТЫ И ПОДПИСИ СТОРОН
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
                                Е-mail :info@joma-club.ru
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
