<template>
  <v-card>
    <v-card-title>
      ПРАВИЛА УХОДА ЗА СПОРТИВНОЙ ФОРМОЙ И ЭКИПИРОВКОЙ С НАНЕСЕНИЕМ
      <v-spacer></v-spacer>
      <v-btn
        color="success"
        text
        class="mr-25 px-10"
        large
        @click="$emit('close')"
      >
        Закрыть
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <div class="rules-for-form" ref="rules-for-form">
        <p>
          Чтобы спортивная форма, экипировка с нанесением долго служили и
          выполняли свое предназначение нужен правильный уход. Всего несколько
          советов помогут продлить срок службы.
        </p>
        <p>
          В первую очередь ознакомьтесь с правилами стирки указанными на вшивном
          ярлыке с изнаночной стороны вашего изделия.
        </p>
        <p>
          Самым важным советом по уходу за вещами, будет стирать её после каждой
          тренировки, не откладывая. Так как на тренировках мы потеем, а пот -
          это раствор солей и органических веществ, которые могут разрушать
          ткань. Еще очень важно, не бросать мокрые вещи сразу в сумку. Лучше
          если это будет пакет, а затем уже сумка, и тогда не придется стирать
          сумку каждый раз.
        </p>
        <ul>
          <li><strong>Стирайте вещи вывернутыми наизнанку.</strong></li>
          <li><strong>Замки должны быть застегнуты.</strong></li>
          <li><strong>Температура не больше 30-40 градусов.</strong></li>
          <li>
            <strong>Программу стирки выбираем с минимальным временем.</strong>
            Так как особых загрязнений нет, этого будет достаточно. Есть
            программы типа повседневной стирки или быстрой, около полу часа
            стирки будет более чем достаточно.
          </li>
          <li>
            <strong>Пониженные обороты отжима.</strong> Если есть возможность
            снизить обороты в вашей стиральной машинке, будет очень кстати, веди
            высокие обороты разрушают ткань. А такая одежда и так быстро сохнет.
          </li>
          <li>
            <strong>Выбирайте мягкое средство для стирки</strong> (cейчас даже
            есть специальные, с отметкой SPORT).
          </li>
          <li><strong>Не добавляйте смягчающий кондиционер.</strong></li>
          <li><strong>Не добавляйте отбеливатель.</strong></li>
          <li>
            Если требуется
            <strong>глажка, лучше это сделать отпаривателем,</strong> или на
            минимальной температуре утюга,
            <strong>выворачивая наизнанку.</strong>
          </li>
        </ul>
        <p>
          Эти простые советы помогут продлить срок эксплуатации вашей одежды для
          тренировок. Проставьте галочку в окне «Я ОЗНАКОМЛЕН С ПРАВИЛАМИ УХОДА»
          Только после этого вы сможете перейти к подписанию договора.
        </p>
      </div>
      <div class="text-center">
        <a
          href="#"
          class="rules-btn"
          @click.prevent.stop="toggleRules"
          v-if="!showAllRules"
          >Читать далее</a
        >
        <a
          href="#"
          class="rules-btn"
          @click.prevent.stop="toggleRules"
          v-if="showAllRules"
          >Скрыть</a
        >
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          v-model="agreeRules"
          :value="agreeRules"
          id="defaultCheck1"
        />
        <label class="form-check-label" for="defaultCheck1">
          Я ОЗНАКОМЛЕН С ПРАВИЛАМИ УХОДА
        </label>
      </div>
      <div v-if="agreeRules === true">
        <h3 class="text-center">Вы являетесь</h3>
        <div class="row">
          <div class="col-6 text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="exampleRadios"
                id="exampleRadios1"
                value="fizik"
                v-model="typeCustomer"
              />
              <label class="form-check-label" for="exampleRadios1">
                Физическим лицом
              </label>
            </div>
          </div>
          <div class="col-6 text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="exampleRadios"
                id="exampleRadios2"
                value="yurik"
                v-model="typeCustomer"
              />
              <label class="form-check-label" for="exampleRadios2">
                Юридическим лицом
              </label>
            </div>
          </div>
        </div>

        <fiz
          v-if="typeCustomer === 'fizik'"
          :data="fizik"
          @fizikChanged="fizikChanged($event)"
        />
        <yur v-if="typeCustomer === 'yurik'" :data="yurik" />
      </div>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn
        @click="sendForm"
        :disabled="allowSendFormFizik"
        large
        color="success"
        class="px-10"
      >
        <v-icon>mdi-check</v-icon>
        Оформить заказ
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import Fiz from '../Docs/Fiz'
import Yur from '../Docs/Yur'
import context from '../../api/api'
export default {
  props: ['orders'],
  components: {
    Fiz,
    Yur
  },
  data: () => ({
    showAllRules: false,
    agreeRules: true,
    typeCustomer: 'fizik',
    zakazTovar: [],
    zakazTovarSum: 0,
    zakazNumberName: [],
    zakazLogos: [],
    zakazLogosSum: 0,
    fizik: {
      number: 1,
      date: 2,
      firstName: 'qwe',
      lastName: '2',
      middleName: '3',
      email: '3',
      phone: '4',
      price: 111,
      agreeContractNanesenie: true,
      agreeContractBuy: true,
      showContractBuy: false,
      showContractNanesenie: false
    },
    yurik: {
      number: null,
      date: null,
      field1: '',
      field2: '',
      field3: '',
      email: '',
      phone: '',
      price: 0,
      agreeContractNanesenie: false,
      agreeContractBuy: false,
      showContractBuy: false,
      showContractNanesenie: false
    }
  }),
  created() {
    this.prepareZakazTovar()
    this.prepareZakazFio()
    this.prepareZakazLogos()
    this.fizik.price = this.zakazLogosSum + this.zakazTovarSum
  },
  methods: {
    sendForm() {
      let fd = new FormData()
      const config = {
        'content-type': 'multipart/form-data',
        responseType: 'blob'
      }
      context.post('api/callback/create', fd, config).then(response => {
        // const url = window.URL.createObjectURL(new Blob([response.data]))
        // const link = document.createElement('a')
        // link.href = url
        // link.setAttribute('download', 'file.pdf')
        // document.body.appendChild(link)
        // link.click()
        FileSaver.saveAs(new Blob([response.data]))
      })
    },
    prepareZakazLogos() {
      let result = []
      let sumTotal = 0
      if (this.orders) {
        this.orders.forEach(order => {
          let totalSizes = 0
          if (order.orderedSizes) {
            order.orderedSizes.forEach(size => {
              if (size.total) totalSizes += size.total
            })
          }

          if (order.orderedLogos) {
            let logos = order.orderedLogos
            logos.forEach(logo => {
              let sum = 0
              let find = result.find(
                x =>
                  x.logoTypeId === logo.logoTypeId &&
                  x.logoSizeId === logo.logoSizeId
              )
              if (!find) {
                sum = totalSizes * logo.logoType.price
                result.push({
                  name: logo.logoType.name + ' ' + logo.logoSize.name,
                  count: totalSizes,
                  sum: sum,
                  logoTypeId: logo.logoTypeId,
                  logoSizeId: logo.logoSizeId
                })
              } else {
                sum = totalSizes * logo.logoType.price
                find.count += totalSizes
                find.sum += sum
              }
              sumTotal += sum
            })
          }
          if (order.orderedTexts) {
            let texts = order.orderedTexts
            texts.forEach(text => {
              let sum = 0
              let find = result.find(
                x => x.type === text.type && x.textSizeId === text.textSizeId
              )
              if (!find) {
                sum = totalSizes * text.textSize.price
                result.push({
                  name:
                    (text.type === 'text' ? 'Надпись' : 'Номер') +
                    ' ' +
                    text.textSize.name,
                  count: totalSizes,
                  sum: sum,
                  type: text.type,
                  textSizeId: text.textSizeId
                })
              } else {
                sum = totalSizes * text.textSize.price
                find.count += totalSizes
                find.sum += sum
              }
              sumTotal += sum
            })
          }
        })
      }
      this.zakazLogos = result
      this.zakazLogosSum = sumTotal
    },
    prepareZakazFio() {
      if (this.orders)
        this.orders.forEach(order => {
          if (order.orderedFio) {
            order.orderedFio.forEach(size => {
              size.rows.forEach(row => {
                this.zakazNumberName.push({
                  name: order.titleTab,
                  size: size.size,
                  fio: row.fio,
                  number: row.number
                })
              })
            })
          }
        })
    },
    prepareZakazTovar() {
      if (this.orders)
        this.orders.forEach(order => {
          if (order.orderedSizes) {
            order.orderedSizes.forEach(size => {
              this.zakazTovarSum += size.price * size.total
              if (size.total > 0)
                this.zakazTovar.push({
                  name: order.titleTab,
                  ...size
                })
            })
          }
        })
    },
    fizikChanged(e) {
      this.fizik = e
    },
    toggleRules() {
      this.showAllRules = !this.showAllRules
      var rules = this.$refs['rules-for-form']
      if (rules.style.maxHeight) {
        rules.style.maxHeight = null
      } else {
        rules.style.maxHeight = rules.scrollHeight + 'px'
        rules.style.height = rules.scrollHeight + 'px'
      }
    }
  },
  computed: {
    allowSendFormFizik() {
      if (this.typeCustomer === 'fizik')
        return (
          this.fizik.agreeContractBuy === false ||
          this.fizik.agreeContractNanesenie === false ||
          !this.fizik.firstName ||
          !this.fizik.lastName ||
          !this.fizik.middleName ||
          !this.fizik.phone
        )
      if (this.typeCustomer === 'yurik')
        return (
          this.yurik.agreeContractBuy === false ||
          this.yurik.agreeContractNanesenie === false ||
          !this.yurik.field1 ||
          !this.yurik.phone
        )

      return true
    }
  }
}
</script>

<style></style>
