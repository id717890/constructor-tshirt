<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <v-btn @click="print" class="w100" tile large text outlined
          >Печать</v-btn
        >
      </v-col>
    </v-row>
    <v-row class="v-application">
      <v-col cols="12" lg="6" offset-lg="3" md="8" offset-md="2">
        <v-row>
          <v-col cols="5">
            <img
              class="logo"
              style="width: 275px"
              src="~@/assets/img/logo3.png"
              alt=""
            />
          </v-col>
          <v-col cols="7">
            <div>{{ zakaz.typeCustomerText }}: {{ zakaz.name }}</div>
            <div>Телефон: {{ zakaz.phone }}</div>
            <div>E-mail: {{ zakaz.email }}</div>
            <div style="font-weight: bold">
              Общая цена: {{ zakaz.price }} руб.
            </div>
            <div>Способ доставки: {{ zakaz.delivery }}</div>
            <div>Способ оплаты: {{ zakaz.payment }}</div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="pb-10">
            <h2>Заказ товар</h2>
            <v-simple-table>
              <template v-slot:default>
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
                  <tr v-for="row in zakaz.zakazTovar" :key="row.id">
                    <td>{{ row.name }}</td>
                    <td>{{ row.size }}</td>
                    <td>{{ row.inMoscow }}</td>
                    <td>{{ row.inSpain }}</td>
                    <td>{{ row.total }}</td>
                    <td>{{ row.price }}</td>
                    <td>{{ row.price * row.total }}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>
        </v-row>
        <v-row v-for="order in zakaz.zakazLogosEach" :key="order.id">
          <v-col cols="12" class="pb-10">
            <h2>Заказ нанесение "{{ order.name }}"</h2>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th>Нанесение</th>
                    <th>Кол-во</th>
                    <th>Цена (руб.)</th>
                    <th>Сумма (руб.)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in order.rows" :key="row.id">
                    <td>{{ row.logoType }}</td>
                    <td>{{ row.count }}</td>
                    <td>{{ row.price }}</td>
                    <td>{{ row.sum }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right">ИТОГО:</td>
                    <td>{{ order.sum }}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="pb-10">
            <h2>Заказ нанесение "ИТОГО"</h2>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th>Нанесение</th>
                    <th>Кол-во</th>
                    <th>Сумма (руб.)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in zakaz.zakazLogos" :key="row.id">
                    <td>{{ row.name }}</td>
                    <td>{{ row.count }}</td>
                    <td>{{ row.sum }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">ИТОГО:</td>
                    <td>{{ zakaz.zakazLogosSum }}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="pb-12">
            <h2>Размер-Номер-Фамилия</h2>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th>Модель</th>
                    <th>Размер</th>
                    <th>Номер</th>
                    <th>ФИО</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in zakaz.zakazNumberName" :key="row.id">
                    <td>{{ row.name }}</td>
                    <td>{{ row.size }}</td>
                    <td>{{ row.fio }}</td>
                    <td>{{ row.number }}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-col>
        </v-row>
        <v-row v-for="(image, index) in zakaz.images" :key="index">
          <v-col cols="12">
            <h3>{{ image.name }}</h3>
            <img :src="image.imageBase64" alt="" />
          </v-col>
        </v-row>
        <v-row v-if="zakaz.typeCustomer === 'fizik'">
          <v-col cols="12">
            <fiz-for-print :data="zakaz.fizik" />
          </v-col>
        </v-row>
        <v-row v-if="zakaz.typeCustomer === 'yurik'">
          <v-col cols="12">
            <yur-for-print :data="zakaz.yurik" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="mt-12">
            <h3>
              ПРАВИЛА УХОДА ЗА СПОРТИВНОЙ ФОРМОЙ И ЭКИПИРОВКОЙ С НАНЕСЕНИЕМ
            </h3>
            <div ref="rules-for-form">
              <p>
                Чтобы спортивная форма, экипировка с нанесением долго служили и
                выполняли свое предназначение нужен правильный уход. Всего
                несколько советов помогут продлить срок службы.
              </p>
              <p>
                В первую очередь ознакомьтесь с правилами стирки указанными на
                вшивном ярлыке с изнаночной стороны вашего изделия.
              </p>
              <p>
                Самым важным советом по уходу за вещами, будет стирать её после
                каждой тренировки, не откладывая. Так как на тренировках мы
                потеем, а пот - это раствор солей и органических веществ,
                которые могут разрушать ткань. Еще очень важно, не бросать
                мокрые вещи сразу в сумку. Лучше если это будет пакет, а затем
                уже сумка, и тогда не придется стирать сумку каждый раз.
              </p>
              <ul>
                <li><strong>Стирайте вещи вывернутыми наизнанку.</strong></li>
                <li><strong>Замки должны быть застегнуты.</strong></li>
                <li>
                  <strong>Температура не больше 30-40 градусов.</strong>
                </li>
                <li>
                  <strong
                    >Программу стирки выбираем с минимальным временем.</strong
                  >
                  Так как особых загрязнений нет, этого будет достаточно. Есть
                  программы типа повседневной стирки или быстрой, около полу
                  часа стирки будет более чем достаточно.
                </li>
                <li>
                  <strong>Пониженные обороты отжима.</strong> Если есть
                  возможность снизить обороты в вашей стиральной машинке, будет
                  очень кстати, веди высокие обороты разрушают ткань. А такая
                  одежда и так быстро сохнет.
                </li>
                <li>
                  <strong>Выбирайте мягкое средство для стирки</strong>
                  (cейчас даже есть специальные, с отметкой SPORT).
                </li>
                <li>
                  <strong>Не добавляйте смягчающий кондиционер.</strong>
                </li>
                <li><strong>Не добавляйте отбеливатель.</strong></li>
                <li>
                  Если требуется
                  <strong>глажка, лучше это сделать отпаривателем,</strong>
                  или на минимальной температуре утюга,
                  <strong>выворачивая наизнанку.</strong>
                </li>
              </ul>
              <p>
                Эти простые советы помогут продлить срок эксплуатации вашей
                одежды для тренировок. Проставьте галочку в окне «Я ОЗНАКОМЛЕН С
                ПРАВИЛАМИ УХОДА» Только после этого вы сможете перейти к
                подписанию договора.
              </p>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-btn @click="print" class="w100" tile large text outlined
          >Печать</v-btn
        >
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import FizForPrint from '../Docs/FizForPrint'
import YurForPrint from '../Docs/YurForPrint'
export default {
  components: {
    FizForPrint,
    YurForPrint
  },
  data: () => ({
    zakaz: null
  }),
  watch: {},
  created() {
    let zakaz = JSON.parse(localStorage.getItem('printZakaz'))
    console.log(zakaz)
    this.zakaz = zakaz
  },
  methods: {
    print() {
      window.print()
    }
  }
}
</script>

<style></style>
