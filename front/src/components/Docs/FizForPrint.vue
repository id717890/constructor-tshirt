<template>
  <v-row>
    <v-col cols="12">
      <section ref="fizik-contract-for-buy">
        <h4 class="text-center">ДОГОВОР КУПЛИ-ПРОДАЖИ № {{ fizik.number }}</h4>
        <div class="d-flex flex-row flex-nowrap justify-space-between mb-5">
          <span>г.Москва</span>
          <span>{{ fizik.date }}г.</span>
        </div>
        <p class="text-justify">
          Индивидуальный предприниматель Кляус Наталья Сергеевна, именуемый в
          дальнейшем «Продавец», в лице Кляус Натальи Сергеевны, действующей на
          основании Свидетельства о государственной регистрации физического лица
          в качестве индивидуального предпринимателя, с одной стороны, и
          {{ fio }}, именуемый в дальнейшем «Покупательс другой стороны,
          совместно именуемые Стороны, заключили настоящий Договор о
          нижеследующем:
        </p>
        <h5 class="text-center">1. ПРЕДМЕТ ДОГОВОРА</h5>
        <p>
          <strong>1.1.</strong> В рамках настоящего договора Покупатель в любое
          время имеет право совершать ряд не связанных между собой сделок по
          купле-продаже спортивной одежды (далее — «Товар»). Основанием для
          возникновения прав и обязанностей по настоящему договору является
          обращение Покупателя с Заказом клиента на совершение сделки
          купли-продажи.
        </p>
        <p>
          <strong>1.2.</strong> Продавец обязуется передать в собственность
          Покупателя Товар в количестве, ассортименте и по ценам указанным в
          товарных накладных, а Покупатель принять и оплатить его. Предметом
          каждой сделки является купленный Товар в ассортименте, оговоренном в
          Заказе клиента и указанный в товарных накладных с итоговой суммой
          сделки, определяемой, как сумма всех товарных накладных отгруженного
          Товара по данному Заказу клиента.
        </p>
        <h5 class="text-center">2. СУММА ДОГОВОРА</h5>
        <p>
          <strong>2.1.</strong> Сумма Договора и цены на поставляемый Товар
          определяются заказом (Приложение №1), которая являются неотъемлемой
          частью настоящего Договора.
        </p>
        <p>
          <strong>2.2.</strong> Изменение цены Товара в течение срока действия
          настоящего Договора Продавцом без письменного согласия Покупателя
          недействительно.
        </p>

        <h5 class="text-center">3. ОБЯЗАННОСТИ СТОРОН</h5>
        <p><strong>3.1.</strong> Продавец обязан:</p>
        <p>
          <strong>3.1.1.</strong> Направить Покупателю счет на оплату Товара.
        </p>
        <p>
          <strong>3.1.2.</strong> Передать Покупателю Товар надлежащего
          качества, в соответствии с ассортиментом и количеством, указанным в
          товарных накладных. Обязанность Продавца передать Товар считается
          исполненной с момента подписания товарно-транспортной накладной первым
          уполномоченным перевозчиком или представителем Покупателя со склада
          Продавца в г. Москва.
        </p>
        <p>
          <strong>3.1.3.</strong> Передать Покупателю все документы, относящиеся
          к Товару: товарно-транспортные накладные, счета.
        </p>
        <p>
          <strong>3.1.4.</strong> На основании акта, принять к возврату Товар,
          проданный Покупателем возвращенный в пределах гарантийного срока, с
          выявленными производственными дефектами. В этом случае Продавец
          возмещает стоимость возвращенного Товара, либо, по согласованию с
          Покупателем, заменяет бракованный Товар на качественный в течение 10
          (десяти) рабочих дней.
        </p>
        <p><strong>3.2.</strong> Покупатель обязан:</p>
        <p>
          <strong>3.2.1.</strong> Оформить заказ - Заказ клиента на сделку по
          купле-продаже, в которой должен указать артикул, цвет, размер и
          количество необходимого для поставки Товара.
        </p>
        <p>
          <strong>3.2.2.</strong> Обеспечить приемку товара. Приемка товара по
          количеству и качеству осуществляется в соответствии с законодательно
          установленными нормами на складе Продавца.
        </p>

        <h5 class="text-center">4. ГАРАНТИЙНЫЙ СРОК ТОВАРА</h5>
        <p>
          <strong>4.1.</strong> Покупатель вправе предъявлять претензии,
          связанные с производственными дефектами Товара, при их обнаружении в
          течение гарантийного срока.
        </p>
        <p>
          <strong>4.2.</strong> Срок гарантийных обязательств Продавца
          составляет 6 (шесть) месяцев с момента передачи Товара Покупателю.
        </p>

        <h5 class="text-center">5. ПОСТАВКА ТОВАРА</h5>
        <p>
          <strong>5.1.</strong> Доставка Товара до Покупателя осуществляется
          силами и средствами Покупателя.
        </p>
        <p>
          <strong>5.2.</strong> Товар по Заказу клиента поставляется со склада
          Продавца в г.Москва. Наименование, ассортимент, количество указаны в
          товарных накладных, являющихся неотъемлемой частью настоящего
          Договора.
        </p>
        <p>
          <strong>5.3.</strong> Датой поставки Товара считается дата получения
          товара Покупателем с оформлением всех необходимых документов, согласно
          п. 3.1.3.
        </p>
        <p>
          <strong>5.4.</strong> Условия поставки - Поставка товара на склад
          Покупателя за счет Поставщика.
        </p>
        <p>
          <strong>5.5.</strong> Срок поставки товара по Заказу клиента
          производится в течение 20 (двадцати) календарных дней со дня
          поступления денежных средств на счет Поставщика.
        </p>
        <p>
          <strong>5.5.</strong> Поставщик по согласованию с Покупателем имеет
          право на досрочную поставку Товара при наличии Товара или его части на
          складе Поставщика в г. Москва.
        </p>

        <h5 class="text-center">6. ПОРЯДОК РАСЧЕТОВ</h5>
        <p>
          <strong>6.1.</strong> Оплата товара производится после подписания
          договора и выставления счета.
        </p>
        <p>
          <strong>6.2.</strong> Основанием для расчетов между сторонами являются
          данный договор и счет в котором указаны отпускные цены на товар
          Покупателю.
        </p>
        <p>
          <strong>6.3.</strong> Моментом оплаты считается дата поступления денег
          на расчетный счет Продавца.
        </p>
        <p><strong>6.4.</strong> Покупатель оплачивает Товар в рублях.</p>

        <h5 class="text-center">7. ПРАВО СОБСТВЕННОСТИ</h5>
        <p>
          <strong>7.1.</strong> Право собственности на Товар переходит к
          Покупателю в момент фактической передачи Товара Полномочному
          представителю Покупателя.
        </p>
        <p>
          <strong>7.2.</strong> Риск случайной гибели или порчи товара переходит
          от Поставщика к Покупателю в момент передачи Товара первому
          перевозчику/экспедитору или уполномоченному представителю Покупателя,
          в зависимости какое событие наступит раньше.
        </p>

        <h5 class="text-center">8. ОТВЕТСТВЕННОСТЬ СТОРОН</h5>
        <p>
          <strong>8.1 </strong>В случае невыполнения полностью или частично
          своих обязательств, предусмотренных в п.п. 6, виновная сторона
          выплачивает другой стороне, по требованию последней, пени в размере
          0,10% (десять сотых процента) от стоимости неоплаченного Товара за
          каждый день просрочки, но не более 10% стоимости неисполненного
          обязательства.
        </p>

        <h5 class="text-center">9. ГАРАНТИИ ИСПОЛНЕНИЯ ДОГОВОРА</h5>
        <p>
          <strong>9.1.</strong> За неисполнение или ненадлежащие исполнение
          обязательств по Договору Стороны несут ответственность в соответствии
          с действующим законодательством РФ.
        </p>
        <p>
          <strong>9.2.</strong> Покупатель обязан возместить убытки Продавца,
          возникшие в результате ненадлежащего исполнения Покупателем условий
          Договора.
        </p>
        <p>
          <strong>9.3.</strong> Стороны несут ответственность за невыполнение
          обязательств по Договору, если не докажут, что надлежащее исполнение
          оказалось невозможным вследствие непреодолимой силы, то есть
          чрезвычайных и непредотвратимых при данных условиях обстоятельств.
        </p>

        <h5 class="text-center">10. ПОРЯДОК РАЗРЕШЕНИЯ СПОРОВ</h5>
        <p>
          <strong>10.1.</strong> В случае возникновения споров и разногласий,
          стороны прилагают усилия для их разрешения путем переговоров.
        </p>
        <p>
          <strong>10.2.</strong> Если стороны не урегулировали разногласия в
          результате переговоров или досудебного претензионного порядка
          урегулирования спора, он передается на разрешение в Арбитражный суд г.
          Москвы в соответствии с законодательством РФ.
        </p>
        <p>
          <strong>10.3.</strong> Во всем остальном, что не предусмотрено
          Договором, Стороны руководствуются действующим законодательством РФ.
        </p>

        <h5 class="text-center">11. СРОК ДЕЙСТВИЯ ДОГОВОРА</h5>
        <p>
          <strong>11.1 </strong>Настоящий Договор вступает в силу с момента его
          подписания и действует до полного выполнения Сторонами своих
          обязательств.
        </p>
        <p>
          <strong>11.2 </strong>Договор может быть расторгнут Сторонами досрочно
          в одностороннем порядке путем направления уведомления о расторжении
          договора не менее чем за 30 (тридцать) календарных дней до
          предполагаемой даты расторжения, и в случаях, предусмотренных
          действующим законодательством РФ.
        </p>
        <p>
          <strong>11.3 </strong>При расторжении договора Стороны обязаны
          произвести все взаиморасчеты.
        </p>
        <p>
          <strong>11.4 </strong>Договор составлен в 2 (двух) экземплярах,
          имеющих одинаковую юридическую силу, по одному экземпляру для каждой
          из Сторон.
        </p>
        <p>
          <strong>11.5 </strong>Любые изменения и дополнения к Договору
          действительны при условии, если они совершены в письменно форме и
          подписаны уполномоченными представителями Сторон.
        </p>

        <h5 class="text-center">
          12. ЮРИДИЧЕСКИЕ АДРЕСА И ПЛАТЕЖНЫЕ РЕКВИЗИТЫ СТОРОН
        </h5>
        <div class="row">
          <div class="col-sm-12 col-md-6 d-flex flex-column">
            <h5>«ПОКУПАТЕЛЬ»</h5>
            <div class="d-flex flex-colum flex-grow-1">
              <br />
              Фамилия: {{ fizik.lastName }}
              <br />
              Имя: {{ fizik.firstName }}
              <br />
              Отчество: {{ fizik.middleName }}
              <br />
              Электронный адрес: {{ fizik.email }}
              <br />
              Телефон: {{ fizik.phone }}
              <br />
            </div>

            <div class="d-flex flex-row flex-nowrap">
              <div
                class="flex-grow-1"
                style="border-bottom: 1px solid black; height: 25px; "
              >
                <span class="sign">Подписать</span>
              </div>
              <div
                style="border-bottom: 1px solid black; height: 25px; flex-basis: 45%;"
              >
                /
              </div>
            </div>
          </div>
          <div
            class="col-sm-12 col-md-6 d-flex flex-column justify-content-between"
          >
            <div>
              <h5>"ПРОДАВЕЦ"</h5>
              <br />
              ИП Кляус Наталья Сергеевна
              <br />
              ОГРНИП: 315500300005930
              <br />
              ИНН 753609484820
              <br />
              Тел./факс +7(967) 21-92-444
              <br />
              Е-mail : s-klyaus@mail.ru
              <br />
              р/с 40802810540000011210
              <br />
              в ПАО Сбербанк
              <br />
              г.Видное ул. Советская 34А
              <br />
              <br />
              К/с 30101810400000000225
              <br />
              БИК: 044525225 Карта СБ 4276 4000 5311 7280 В назначении платежа
              указать № заказа
              <br />
              <br />
            </div>

            <div class="d-flex flex-row flex-nowrap">
              <div
                class="flex-grow-1"
                style="border-bottom: 1px solid black; height: 25px; "
              >
                <span class="stamp">м.п.</span>
              </div>
              <div
                style="border-bottom: 1px solid black; height: 25px; flex-basis: 45%;"
              >
                /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Н.С. Кляус
              </div>
            </div>
          </div>
        </div>
      </section>
    </v-col>
    <v-col cols="12" class="mt-12">
      <section ref="fizik-contract-for-nanesenie">
        <h4 class="text-center">ДОГОВОР ОКАЗАНИЯ УСЛУГ № {{ fizik.number }}</h4>
        <div class="d-flex flex-row flex-nowrap justify-space-between mb-5">
          <span>г.Москва</span>
          <span>{{ fizik.date }}г.</span>
        </div>
        <p class="text-justify">
          Индивидуальный предприниматель Кляус Наталья Сергеевна, именуемый в
          дальнейшем «Исполнитель», в лице Кляус Натальи Сергеевны, действующей
          на основании Свидетельства о государственной регистрации физического
          лица в качестве индивидуального предпринимателя, с одной стороны, и
          {{ fio }}, именуемый в дальнейшем «Заказчик», с другой стороны,
          совместно именуемые Стороны, заключили настоящий Договор о
          нижеследующем:
        </p>

        <h5 class="text-center">1. ПРЕДМЕТ ДОГОВОРА</h5>
        <p>
          <strong>1.1.</strong> Исполнитель обязуется оказать Заказчику услуги
          (далее – Услуги), предусмотренные п. 1.2 настоящего договора, а
          Заказчик обязуется оплатить эти Услуги.
        </p>
        <p>
          <strong>1.2</strong> Услуги по нанесению логотипов и номеров, вид,
          содержание и объем нанесения логотипов и номеров определены в
          утвержденном макете и заказе, которые являются неотъемлемой частью
          настоящего Договора.
        </p>

        <h5 class="text-center">2. ПОРЯДОК ОКАЗАНИЯ УСЛУГ</h5>
        <p>
          <strong>2.1.</strong> Услуги оказываются в месте нахождения
          Исполнителя.
        </p>

        <h5 class="text-center">3. ЦЕНА ДОГОВОРА</h5>
        <p>
          <strong>3.1.</strong> Стоимость Услуг, оказываемых Исполнителем
          составляет <strong>{{ fizik.price }} руб. ноль копеек</strong> (НДС не
          облагается) определяется согласно заказом от {{ fizik.date }}г. и
          макета, являющиеся неотъемлемой частью настоящего Договора.
        </p>
        <p>
          <strong>3.2.</strong> Стоимость Услуг включает вознаграждение
          Исполнителя, а также возмещение издержек и дополнительных расходов
          Исполнителя, связанных с исполнением настоящего Договора.
        </p>
        <p></p>

        <h5 class="text-center">4. УСЛОВИЯ И ПОРЯДОК ОПЛАТЫ</h5>
        <p>
          <strong>4.1.</strong> Оплата стоимости оказанных Услуг производится
          Заказчиком в безналичной форме путем перечисления денежных средств на
          расчетный счет, указанный Исполнителем. Обязательства Заказчика по
          оплате стоимости Услуг считаются исполненными с момента зачисления
          средств на расчетный счет, указанный Исполнителем.
        </p>
        <p>
          <strong>4.2.</strong> Оплата стоимости Услуг производится Заказчиком в
          размере 100% не позднее 5 (пяти) рабочих дней с момента заключения
          настоящего договора и выставлении счета.
        </p>

        <h5 class="text-center">5. СРОКИ ОКАЗАНИЯ УСЛУГ</h5>
        <p>
          <strong>5.1.</strong> Услуги, указанные в п. 1.1. настоящего Договора,
          оказываются Исполнителем в течении 5 (пяти) рабочих дней с момента
          поступления товара на склад Исполнителя.
        </p>
        <p>
          <strong>5.2.</strong> Стороны вправе изменить сроки оказания услуг,
          указанные в п. 5.1. настоящего Договора, путем заключения
          дополнительного соглашения к настоящему Договору.
        </p>

        <h5 class="text-center">6. ПОРЯДОК ПРИЕМКИ УСЛУГ</h5>
        <p>
          <strong>6.1.</strong> Приемка услуг, оказанных Исполнителем,
          осуществляется путем подписания Сторонами акта об оказании услуг.
        </p>
        <p>
          <strong>6.2.</strong> Акт об оказании услуг составляется и
          подписывается Сторонами настоящего Договора в течение трех рабочих
          дней с момента оказания Услуг в полном объеме.
        </p>

        <h5 class="text-center">7. ОТВЕТСТВЕННОСТЬ СТОРОН</h5>
        <p>
          <strong>7.1.</strong> В случае нарушения срока оплаты Услуг,
          указанного в п. 4.2. настоящего Договора, Заказчик выплачивает
          Исполнителю неустойку в размере 1 % от стоимости Услуг, указанной в п.
          3.1. настоящего Договора за каждый день просрочки.
        </p>
        <p>
          <strong>7.2.</strong> В случае нарушения срока оказания Услуг,
          указанного в п. 5.1. настоящего Договора, Исполнитель выплачивает
          Заказчику неустойку в размере 1 % от стоимости Услуг, указанной в п.
          3.1. настоящего Договора за каждый день просрочки.
        </p>
        <p>
          <strong>7.3.</strong> В случаях, не предусмотренных настоящим
          Договором, ответственность Сторон определяется в соответствии с
          действующим законодательством.
        </p>

        <h5 class="text-center">8. ФОРС МАЖОР</h5>
        <p>
          <strong>8.1.</strong> Ни одна из Сторон не несет ответственности за
          полное или частичное неисполнение обязательств по Настоящему договору,
          если это явилось следствием обстоятельств непреодолимой силы, а
          именно: пожар, землетрясение, наводнение, иные стихийные бедствия,
          забастовки, военные действия, действий органов государственной власти
          и местного самоуправления.
        </p>
        <p>
          <strong>8.2.</strong> Сторона, для которой наступили обстоятельства,
          указанные в п. 8.1. настоящего Договора, должна немедленно известить
          другую сторону о наступлении таковых.
        </p>
        <p>
          <strong>8.3.</strong> Если обстоятельства, указанные в п. 8.1.
          настоящего Договора, будут продолжаться более 6 месяцев, каждая
          Сторона имеет право отказаться от дальнейшего исполнения обязательств
          по настоящему договору, и в этом случае ни одна из Сторон не будет
          иметь права требовать от другой Стороны возмещения возможных убытков.
        </p>

        <h5 class="text-center">9. СПОРЫ И РАЗНОГЛАСИЯ</h5>
        <p>
          <strong>9.1.</strong> Все споры и разногласия по настоящему договору
          будут разрешаться путем переговоров на основе действующего
          законодательства и обычаев делового оборота.
        </p>
        <p>
          <strong>9.2.</strong> При не урегулировании спорных вопросов в
          процессе переговоров споры разрешаются в суде в порядке, установленном
          действующим законодательством.
        </p>

        <h5 class="text-center">10. АНТИКОРРУПЦИОННАЯ ОГОВОРКА.</h5>
        <p>
          <strong>10.1</strong> Каждая из Сторон Договора, ее аффилированные
          лица, работники или посредники отказываются от стимулирования
          каким-либо образом работников другой Стороны, в том числе путем
          предоставления денежных сумм, подарков, безвозмездного выполнения в их
          адрес работ (услуг) и другими, не поименованными здесь способами,
          ставящего работника в определенную зависимость и направленного на
          обеспечение выполнения этим работником каких-либо действий в пользу
          стимулирующей его Стороны.
        </p>
        <p>
          <strong>10.2</strong>. Под действиями работника, осуществляемыми в
          пользу стимулирующей его Стороны, понимаются:
          <br />
          1) предоставление неоправданных преимуществ по сравнению с другими
          контрагентами;
          <br />
          2) предоставление каких-либо гарантий;
          <br />
          3) ускорение существующих процедур;
          <br />
          4) иные действия, выполняемые работником в рамках своих должностных
          обязанностей, но идущие вразрез с принципами прозрачности и открытости
          взаимоотношений между Сторонами.
        </p>
        <p>
          <strong>10.3</strong>. В случае возникновения у Стороны подозрений,
          что произошло или может произойти нарушение каких-либо положений
          настоящего раздела Договора, соответствующая Сторона обязуется
          уведомить другую Сторону в письменной форме. После письменного
          уведомления, соответствующая Сторона имеет право приостановить
          исполнение обязательств по настоящему Договору до получения
          подтверждения от другой Стороны после проведённой ею проверки, что
          нарушения не произошло или не произойдет. Это подтверждение должно
          быть направлено в течение десяти рабочих дней с даты направления
          письменного уведомления.
        </p>
        <p>
          <strong>10.4</strong>. В случае нарушения одной Стороной обязательств
          воздерживаться от запрещенных настоящим разделом действий и/или
          неполучения другой Стороной в установленный Договором срок
          подтверждения, что нарушения не произошло или не произойдет, другая
          Сторона имеет право расторгнуть Договор в одностороннем порядке,
          направив письменное уведомление о расторжении. Сторона, по чьей
          инициативе был расторгнут настоящий Договор в соответствии с
          положениями настоящей статьи, вправе требовать возмещения реального
          ущерба, возникшего в результате такого расторжения.
        </p>

        <h5 class="text-center">11. КОНФИДЕНЦИАЛЬНОСТЬ.</h5>
        <p>
          <strong>11.1.</strong> В течение срока действия настоящего Договора, а
          также в течение 12 месяцев после его прекращения Стороны не должны
          предоставлять или разглашать иным способом конфиденциальную
          информацию, полученную в результате совместной деятельности, равно как
          и не должны недобросовестно использовать такую информацию для того,
          чтобы самим конкурировать друг с другом.
        </p>

        <h5 class="text-center">12. ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ</h5>
        <p>
          <strong>12.1.</strong> Все изменения и дополнения к настоящему
          Договору являются его неотъемлемыми частями и действительны, если
          совершены в той же форме, что и настоящий договор, и подписаны обеими
          Сторонами или надлежаще уполномоченными на то представителями Сторон.
        </p>
        <p>
          <strong>12.2.</strong> Настоящий Договор составлен в двух экземплярах:
          по одному экземпляру для Исполнителя и Заказчика. Каждый экземпляр
          имеет равную юридическую силу.
        </p>
        <p>
          <strong>12.3.</strong> Все уведомления и сообщения в рамках исполнения
          настоящего Договора должны направляться в письменной форме c
          уведомлением о вручении и описью вложения.
        </p>
        <p>
          <strong>12.4.</strong> Во всем остальном, не предусмотренном настоящим
          договором, Стороны будут руководствоваться действующим
          законодательством РФ.
        </p>

        <h5 class="text-center">
          13. ЮРИДИЧЕСКИЕ АДРЕСА, ПЛАТЕЖНЫЕ РЕКВИЗИТЫ И ПОДПИСИ СТОРОН
        </h5>

        <div class="row">
          <div class="col-sm-12 col-md-6 d-flex flex-column">
            <h5>«ЗАКАЗЧИК»</h5>
            <div class="d-flex flex-colum flex-grow-1">
              <br />
              Фамилия: {{ fizik.lastName }}
              <br />
              Имя: {{ fizik.firstName }}
              <br />
              Отчество: {{ fizik.middleName }}
              <br />
              Электронный адрес: {{ fizik.email }}
              <br />
              Телефон: {{ fizik.phone }}
              <br />
            </div>
            <div class="d-flex flex-row flex-nowrap">
              <div
                class="flex-grow-1"
                style="border-bottom: 1px solid black; height: 25px; "
              >
                <span class="sign">Подписать</span>
              </div>
              <div
                style="border-bottom: 1px solid black; height: 25px; flex-basis: 45%;"
              >
                /
              </div>
            </div>
          </div>
          <div
            class="col-sm-12 col-md-6 d-flex flex-column justify-content-between"
          >
            <div>
              <h5>"ИСПОЛНИТЕЛЬ"</h5>

              <br />
              ИП Кляус Наталья Сергеевна
              <br />
              ОГРНИП: 315500300005930
              <br />
              ИНН 753609484820
              <br />
              Тел./факс +7(967) 21-92-444
              <br />
              Е-mail :info@joma-club.ru
              <br />
              р/с 40802810540000011210
              <br />
              в ПАО Сбербанк
              <br />
              г.Видное ул. Советская 34А
              <br />
              К/с 30101810400000000225
              <br />
              БИК: 044525225
            </div>

            Индивидуальный предприниматель
            <br />
            <br />
            <br />
            <div class="d-flex flex-row flex-nowrap">
              <div
                class="flex-grow-1"
                style="border-bottom: 1px solid black; height: 25px; "
              >
                <span class="stamp">м.п.</span>
              </div>
              <div
                style="border-bottom: 1px solid black; height: 25px; flex-basis: 45%;"
              >
                /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Н.С. Кляус
              </div>
            </div>
          </div>
        </div>
      </section>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: ['data'],
  data: () => ({
    fizik: {
      number: null,
      date: null,
      firstName: '',
      lastName: '',
      middleName: '',
      email: '',
      phone: '',
      price: 0,
      agreeContractNanesenie: false,
      agreeContractBuy: false,
      showContractBuy: false,
      showContractNanesenie: false
    }
  }),
  created() {},
  computed: {
    fio() {
      return (
        this.data.lastName +
        ' ' +
        this.data.firstName +
        ' ' +
        this.data.middleName
      )
    }
  },
  mounted() {
    this.prepareComponent()
  },
  beforeUpdate() {
    this.prepareComponent()
  },
  methods: {
    prepareComponent() {
      this.fizik = this.data
    }
  }
}
</script>
