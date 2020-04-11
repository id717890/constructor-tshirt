<template>
  <v-app id="app" dark style="background: white">
    <v-container>
      <v-row>
        <v-col>
          <v-btn class="w100" to="/lk">ЛК</v-btn>
        </v-col>
      </v-row>
      <!-- Вкладки заказов -->
      <v-row>
        <v-col>
          <v-tabs v-if="orders && orders.length > 0" v-model="tab">
            <v-tab
              v-for="order in orders"
              :key="order.id"
              @click="selectOrder(order)"
            >
              {{ order.titleTab }}
              <v-icon class="ml-6" @click.prevent.stop="deleteOrder(order)"
                >mdi-close</v-icon
              >
            </v-tab>
            <v-tab @click="newOrder">NEW</v-tab>
          </v-tabs>
        </v-col>
      </v-row>
      <!-- Выбор типов -->
      <v-row
        v-if="
          this.order === null || order.isDone === false || isChangeType === true
        "
      >
        <v-col v-for="type in allTypes" :key="type.id">
          <v-btn
            large
            color="primary"
            class="w100"
            @click.native="selType(type)"
            >{{ type.name }}</v-btn
          >
        </v-col>
      </v-row>
      <!-- Выбор моделей -->
      <v-row
        v-if="order === null || order.isDone === false || isChangeType === true"
      >
        <v-col>
          <swiper ref="mySwiperModel" :options="swiperOptions">
            <swiper-slide
              @click.native="selModel(model)"
              v-for="model in modelsByType"
              :key="model.id"
              class="swiper-element"
              :class="{
                'swiper-active': currentModel && model.id === currentModel.id
              }"
              style="
              justify-content: center;
              -webkit-box-align: center;
              -ms-flex-align: center;
              align-items: center;
              transition: 1s;
              background-position: center; max-width: 260px; background-size: contain; background-repeat: no-repeat; cursor: pointer;"
            >
              <v-img :src="img(model.image)" max-width="260"></v-img>
            </swiper-slide>
            <!-- Стрелки прокрутки моделей -->
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
          </swiper>
        </v-col>
      </v-row>

      <v-row v-if="order === null || order.isDone === false || isChangeColor">
        <v-col cols="12">
          <swiper ref="mySwiperColor" :options="swiperOptions">
            <swiper-slide
              @click.native="selColor(color)"
              v-for="color in colorsByModel"
              :key="color.id"
              class="swiper-element"
              :class="{
                'swiper-active': currentColor && color.id === currentColor.id
              }"
              style="background-position: center; max-width: 260px; background-size: contain; background-repeat: no-repeat; cursor: pointer;"
            >
              <v-img :src="img(color.image_front)" max-width="260"></v-img>
            </swiper-slide>
            <!-- Стрелки прокрутки моделей -->
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
          </swiper>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          cols="12"
          v-for="order in orders"
          :key="order.id"
          v-show="currentOrderId === order.id"
        >
          <v-row>
            <v-col>
              <v-btn
                class="w100"
                tile
                color="primary"
                @click="changeModelTshirt"
              >
                Изменить модель
                <v-icon>mdi-tshirt-v</v-icon>
              </v-btn>
            </v-col>
            <v-col>
              <v-btn
                class="w100"
                tile
                color="primary"
                @click="changeColorTshirt"
              >
                Изменить цвет
                <v-icon>mdi-palette</v-icon>
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="7">
              <h2 v-html="order.titleCanvas" class="text-center mb-12"></h2>
              <canvas
                height="350"
                width="700"
                v-bind:id="'orderCanvas_' + order.id"
                ref="canvasImg"
              >
              </canvas>
              <div class="mt-12">
                <v-row>
                  <v-col cols="7">
                    {{ order.model.description }}
                  </v-col>
                  <v-col cols="5">
                    <div
                      :style="
                        'font-family:' + fontExample + '; font-size: 3rem'
                      "
                    >
                      0123456789
                    </div>
                  </v-col>
                </v-row>
              </div>
            </v-col>
            <v-col cols="5">
              <div>
                <div class="mb-3" style="height: 40px">
                  <v-btn
                    v-if="showDeleteLogo"
                    color="error"
                    class="w100"
                    @click="deleteSelectedDrawing"
                  >
                    Удалить выбранное нанесение
                    <v-icon class="ml-4">mdi-delete</v-icon>
                  </v-btn>
                </div>

                <h3 class="text-center mb-5">Нанесения логотипа</h3>
                <div
                  style="position: relative; height: 150px; max-height: 150px;"
                >
                  <swiper :options="swiperOptions" ref="swiperLogos">
                    <!-- Слайды логотипов -->
                    <swiper-slide
                      @click.native="selLogo(logo)"
                      v-for="logo in allLogosList"
                      :key="logo.id"
                      class="swiper-element"
                      :class="{
                        'swiper-active':
                          currentLogo && logo.id === currentLogo.id
                      }"
                      style="
                      background-position: center; background-size: contain; background-repeat: no-repeat; cursor: pointer;'
                    "
                    >
                      <img
                        v-if="logo.custom"
                        :src="logo.image"
                        alt=""
                        style="max-height: 130px; max-width: 82px"
                      />
                      <v-img
                        v-else
                        contain
                        :src="img(logo.image)"
                        max-height="130"
                      ></v-img>
                    </swiper-slide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>

                    <!-- <swiper-slide
                    :class="{ 'swiper-slide_active': i == logoProps.i }"
                    :style="
                      'background-image: url(' +
                        logo.Изображение +
                        '); background-position: center; background-size: contain; background-repeat: no-repeat; cursor: pointer;'
                    "
                    @click.native="setLogoImage(logo.Изображение, i)"
                    v-for="(logo, i) in logos"
                  >
                  </swiper-slide>

                  <div class="swiper-button-prev" slot="button-prev"></div>
                  <div class="swiper-button-next" slot="button-next"></div>
                  -->
                  </swiper>
                </div>

                <div class="mt-3">
                  <v-btn
                    color="primary"
                    class="w100"
                    @click="$refs.uploadLogo[0].click()"
                  >
                    Загрузить свой логотип
                    <v-icon class="ml-5">mdi-image</v-icon>
                  </v-btn>
                  <input
                    @change="addCustomLogo($event)"
                    accept="image/*"
                    id="uploadLogo"
                    ref="uploadLogo"
                    name="uploadLogo"
                    style="display:none"
                    type="file"
                  />
                </div>
                <v-row>
                  <v-col cols="12" class="d-flex flex-flow">
                    <v-btn
                      :color="
                        currentLogoSize && currentLogoSize.id === logoSize.id
                          ? 'success'
                          : ''
                      "
                      tile
                      v-for="logoSize in allLogoSizes"
                      :key="logoSize.id"
                      style="flex: 1 1 auto;"
                      @click="currentLogoSize = logoSize"
                    >
                      {{ logoSize.name }}
                    </v-btn>
                    <v-btn
                      tile
                      color="primary"
                      @click.prevent.stop="addLogo"
                      style="flex: 0 1 140px;"
                    >
                      Добавить
                      <v-icon class="ml-3">mdi-plus</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
                <div>
                  <h3 class="text-center mb-2 mt-4">Нанесения номера</h3>
                  <div class="d-flex flex-row flex-nowrap" style="height: 55px">
                    <div style="flex: 1 1 auto">
                      <v-text-field
                        label="Номер"
                        class="custom-dense mr-3"
                        dense
                        outlined
                        v-model="currentNumberText"
                      ></v-text-field>
                    </div>
                    <div style="flex: 0 1 150px">
                      <v-select
                        dense
                        :items="allFonts"
                        label="Шрифт"
                        class="mr-3"
                        v-model="currentFont"
                        @change="changeFont($event)"
                        outlined
                      ></v-select>
                    </div>
                    <div style="position: relative">
                      <div
                        :style="
                          'background-color: ' + currentTextColor.code + ';'
                        "
                        :title="currentTextColor.text"
                        @click="showColorPanel = !showColorPanel"
                        class="nav-item boxColor boxColorActive boxColor-single"
                      ></div>
                      <div class="boxSelectColors" v-show="showColorPanel">
                        <div
                          :class="['nav-item boxColor']"
                          :style="'background-color: ' + textColor.code + ';'"
                          :title="textColor.text"
                          @click="selTextColor(textColor)"
                          v-for="textColor in allTextColors"
                          v-show="currentTextColor.code !== textColor.code"
                          :key="textColor.text"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>
                <v-row>
                  <v-col cols="12" class="d-flex flex-flow">
                    <v-btn
                      :color="
                        currentNumberSize &&
                        currentNumberSize.id === numberSize.id
                          ? 'success'
                          : ''
                      "
                      tile
                      v-for="numberSize in allNumberSizes"
                      :key="numberSize.id"
                      style="flex: 1 1 auto;"
                      @click="currentNumberSize = numberSize"
                    >
                      {{ numberSize.name }}
                    </v-btn>
                    <v-btn
                      tile
                      color="primary"
                      @click.prevent.stop="addNumber"
                      style="flex: 0 1 140px;"
                    >
                      Добавить
                      <v-icon class="ml-1">mdi-plus</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
                <div>
                  <h3 class="text-center mb-2 mt-4">
                    Нанесение надписи макс. 300 мм
                  </h3>
                  <div class="d-flex flex-row flex-nowrap" style="height: 55px">
                    <div style="flex: 1 1 auto">
                      <v-text-field
                        label="Фамилия или текс"
                        class="custom-dense mr-3"
                        dense
                        outlined
                        v-model="currentFioText"
                      ></v-text-field>
                    </div>
                    <div style="flex: 0 1 150px">
                      <v-select
                        dense
                        :items="allFonts"
                        label="Шрифт"
                        class="mr-3"
                        v-model="currentFontFio"
                        @change="changeFont($event)"
                        outlined
                      ></v-select>
                    </div>
                    <div style="position: relative">
                      <div
                        :style="
                          'background-color: ' + currentTextColorFio.code + ';'
                        "
                        :title="currentTextColorFio.text"
                        @click="showColorPanelFio = !showColorPanelFio"
                        class="nav-item boxColor boxColorActive boxColor-single"
                      ></div>
                      <div class="boxSelectColors" v-show="showColorPanelFio">
                        <div
                          :class="['nav-item boxColor']"
                          :style="'background-color: ' + textColor.code + ';'"
                          :title="textColor.text"
                          @click="selTextColorFio(textColor)"
                          v-for="textColor in allTextColors"
                          v-show="currentTextColorFio.code !== textColor.code"
                          :key="textColor.text"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>
                <v-row>
                  <v-col cols="12" class="d-flex flex-flow">
                    <v-btn
                      :color="
                        currentTextSize && currentTextSize.id === textSize.id
                          ? 'success'
                          : ''
                      "
                      tile
                      v-for="textSize in allTextSizes"
                      :key="textSize.id"
                      style="flex: 1 1 auto;"
                      @click="currentTextSize = textSize"
                    >
                      {{ textSize.name }}
                    </v-btn>
                    <v-btn
                      tile
                      color="primary"
                      @click.prevent.stop="addString"
                      style="flex: 0 1 140px;"
                    >
                      Добавить
                      <v-icon class="ml-1">mdi-plus</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import api from '../api/api'
import Canvas from '../Canvas'
import { mapActions, mapState } from 'vuex'
import config from '../init/config'
export default {
  components: {},
  props: {
    source: String
  },
  data: () => ({
    tab: 0,
    currentType: null,
    currentModel: null,
    currentColor: null,
    currentLogo: null,
    currentLogoSize: null,
    currentNumberSize: null,
    currentNumberText: null,
    currentFont: 'Nike',
    fontExample: 'Nike',
    currentTextColor: { text: 'Черный', code: '#000000' },
    currentTextSize: null,
    currentFioText: null,
    currentFontFio: 'Nike',
    currentTextColorFio: { text: 'Черный', code: '#000000' },
    allFonts: ['Nike', 'Adidas', 'Alternativ', 'Atletico', 'Real'],
    allTextColors: [
      { text: 'Белый', code: '#ffffff' },
      { text: 'Черный', code: '#000000' },
      { text: 'Желтый', code: '#FFFF00' },
      { text: 'Оранжевый', code: '#FFA500' },
      { text: 'Красный', code: '#FF0000' },
      { text: 'Бордовый', code: '#9B2D30' },
      { text: 'Зеленый', code: '#008000' },
      { text: 'Темно-синий', code: '#002137' },
      { text: 'Синий', code: '#0000FF' },
      { text: 'Голубой', code: '#42AAFF' },
      { text: 'Мята', code: '#AAF0D1' },
      { text: 'Серый', code: '#Серый' },
      { text: 'Зеленый неон', code: '#66FF00' },
      { text: 'Розовый неон', code: '#FC0FC0' },
      { text: 'Золотой', code: '#CDA434' },
      { text: 'Серебряный', code: '#C0C0C0' }
    ],
    allCustomLogos: [],
    // api: url + 'api/image',
    // lTypes: [],
    // lLogos: [],
    // selectedType: null,
    currentOrderId: 0,
    orders: [],
    showColorPanel: false,
    showColorPanelFio: false,
    isChangeColor: false,
    isChangeType: false,
    swiperOptions: config.swiperOptions
  }),
  async created() {
    await this.getAllTypes()
    await this.getAllModels()
    await this.getAllColors()
    await this.getAllLogos()
    await this.getAllLogoSizes()
    await this.getAllNumberSizes()
    await this.getAllTextSizes()
  },
  mounted() {
    // if (this.allTextSizes) {
    //   this.currentTextSize = this.allTextSizes[0]
    // } else {
    //   setTimeout(() => {
    //     this.currentTextSize = this.allTextSizes[0]
    //   }, 800)
    // }
    // if (this.allNumberSizes) {
    //   this.currentNumberSize = this.allNumberSizes[0]
    // } else {
    //   setTimeout(() => {
    //     this.currentNumberSize = this.allNumberSizes[0]
    //   }, 800)
    // }
    // if (this.allLogoSizes) {
    //   this.currentLogoSize = this.allLogoSizes[0]
    // } else {
    //   setTimeout(() => {
    //     this.currentLogoSize = this.allLogoSizes[0]
    //   }, 800)
    // }
    // if (this.allLogos) {
    //   this.currentLogo = this.allLogos[0]
    // } else {
    //   setTimeout(() => {
    //     this.currentLogo = this.allLogos[0]
    //   }, 800)
    // }
  },
  destroyed() {
    // window.removeEventListener('scroll', this.scroll)
  },
  computed: {
    ...mapState({
      allTypes: state => state.type.allTypes,
      allModels: state => state.model.allModels,
      allColors: state => state.color.allColors,
      allLogos: state => state.logo.allLogos,
      allLogoSizes: state => state.logoSize.allLogoSizes,
      allNumberSizes: state => state.numberSize.allNumberSizes,
      allTextSizes: state => state.textSize.allTextSizes,
      showDeleteLogo: state => state.canvas.showDeleteBtn
    }),
    allLogosList() {
      return [...this.allLogos, ...this.allCustomLogos]
    },
    modelsByType() {
      if (this.currentType && this.currentType.id)
        return this.allModels.filter(x => x.type_id === this.currentType.id)
      return []
    },
    colorsByModel() {
      if (this.currentModel && this.currentModel.id)
        return this.allColors.filter(x => x.model_id === this.currentModel.id)
      return []
    },
    order() {
      if (this.currentOrderId && this.orders && this.orders.length > 0)
        return this.orders.find(x => x.id === this.currentOrderId)
      return null
    }
  },
  methods: {
    ...mapActions([
      'getAllTypes',
      'getAllModels',
      'getAllColors',
      'getAllLogos',
      'getAllLogoSizes',
      'getAllNumberSizes',
      'getAllTextSizes'
    ]),
    changeModelTshirt() {
      this.currentType = this.order.type
      this.currentModel = this.order.model
      this.currentColor = this.order.color
      this.isChangeType = true
      this.isChangeColor = true
    },
    changeColorTshirt() {
      this.currentModel = this.order.model
      this.isChangeColor = true
    },
    changeFont(event) {
      this.fontExample = event
    },
    addCustomLogo(event) {
      var input = event.target
      var reader = new FileReader()
      let that = this
      reader.onload = function() {
        // console.log(reader.result)
        // добавляем изображение в массив логотипов
        const id = that.guid()
        that.allCustomLogos.push({
          id: id,
          name: id,
          image: reader.result,
          custom: true
        })
        // appData.logos.splice(0, 0, {
        //   Изображение: reader.result
        // })
        // выбираем добавленный логотип
        // that.setLogoImage(reader.result, 0)
        console.log(reader.result)
      }
      reader.readAsDataURL(input.files[0])
      input.value = null
    },
    selTextColorFio(textColor) {
      this.currentTextColorFio = textColor
      this.showColorPanelFio = false
    },
    selTextColor(textColor) {
      this.currentTextColor = textColor
      this.showColorPanel = false
    },
    // функция удаления выбранного нанесения
    deleteSelectedDrawing: function() {
      console.log('Удаление выбранного нанесения...')
      try {
        let canvas = this.order.canvas
        // выделенное нанесение
        var selectedDrawing = canvas.ctx.getActiveObject()
        // если выбрали изображение
        if (selectedDrawing.type == 'image') {
          console.log(' - Выбрали изображение')
          Object.keys(canvas.images).forEach(key => {
            if (canvas.images[key] === selectedDrawing) {
              canvas.removeImage(key)
            }
          })
          // for (imageId in canvas.images) {
          //   console.log(imageId)
          //   if (canvas.images[imageId] === selectedDrawing) {
          //     console.log(' - ID удаляемого изображения: ' + imageId)
          //     // удаляем логотип из заказа
          //     // currentOrder.order.removeLogotype(imageId)
          //     // удаляем изображение логотипа с холста
          //     canvas.removeImage(imageId)
          //   }
          // }
        }
        // если выбрали текст
        else if (selectedDrawing.type == 'text') {
          console.log(' - Выбрали текст')
          Object.keys(canvas.texts).forEach(key => {
            if (canvas.texts[key] === selectedDrawing) {
              canvas.removeText(key)
            }
          })
          // for (textName in canvases[appData.selectedOrder].texts) {
          //   if (
          //     canvases[appData.selectedOrder].texts[textName] == selectedDrawing
          //   ) {
          //     // удаляем номер или надпись из заказа
          //     currentOrder.order.removeNumber(textName)
          //     currentOrder.order.removeString(textName)
          //     // удаляем текст с холста
          //     canvases[appData.selectedOrder].removeText(textName)
          //   }
          // }
        }
      } catch {}
    },
    selectOrder(order) {
      this.currentOrderId = order.id
    },
    deleteOrder(order) {
      const find = this.orders.indexOf(order)
      if (find !== -1) this.orders.splice(find, 1)
      if (this.orders.length > 0) {
        this.currentOrderId = this.orders[this.orders.length - 1].id
      }
      if (this.orders.length === 1) this.tab = 0
      else this.tab = this.orders.length
    },
    clearSelection() {
      this.currentType = null
      this.currentModel = null
      this.currentColor = null
      this.currentOrderId = null
    },
    newOrder() {
      this.currentOrderId = null
    },
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    getOrder() {
      if (this.currentOrderId && this.orders && this.orders.length > 0)
        return this.orders.find(x => x.id === this.currentOrderId)
      return null
    },
    // добавление строки
    addString() {
      // если строки нет, выходим из функции
      if (!this.currentTextSize || !this.currentFioText) return

      let canvas = this.order.canvas
      const stringId = this.guid()
      // добавляем строку к текущему заказу
      // stringId = currentOrder.order.addString(
      //   appData.stringProps.size,
      //   appData.stringProps.price,
      //   appData.stringProps.value,
      //   appData.fontName,
      //   appData.stringProps.color
      // )
      // console.log(stringId)

      // добавляем строку на холст
      canvas.addText(stringId, this.currentFioText, {
        originX: 'center',
        originY: 'center',
        left: canvas.ctx.width * 0.5,
        top: canvas.ctx.height * 0.5,
        fontFamily: this.currentFontFio,
        fontSize: this.currentTextSize.size * 0.35,
        fill: this.currentTextColor.code,
        centeredScaling: true,
        padding: 10,
        transparentCorners: false,
        borderColor: '#000000',
        cornerColor: '#000000',
        cornerStrokeColor: '#000000'
      })
    },
    addNumber() {
      if (!this.currentNumberSize || !this.currentNumberText) return
      // если номера нет, выходим из функции
      // // добавляем номер к текущему заказу
      // numberId = currentOrder.order.addNumber(
      //   appData.numberProps.size,
      //   appData.numberProps.price,
      //   appData.numberProps.value,
      //   appData.fontName,
      //   appData.numberProps.color
      // )
      // console.log(numberId)
      let canvas = this.order.canvas
      const numberId = this.guid()

      // добавляем номер на холст
      canvas.addText(numberId, this.currentNumberText, {
        originX: 'center',
        originY: 'center',
        left: canvas.ctx.width * 0.5,
        top: canvas.ctx.height * 0.5,
        fontFamily: this.currentFont,
        fontSize: this.currentNumberSize.size * 0.35,
        fill: this.currentTextColor.code,
        centeredScaling: true,
        padding: 10,
        transparentCorners: false,
        borderColor: '#000000',
        cornerColor: '#000000',
        cornerStrokeColor: '#000000'
      })
    },
    addLogo() {
      if (!this.currentLogoSize) {
        alert('Не выбран размер нанесения')
        return
      }
      let canvas = this.order.canvas
      const logoId = this.guid()
      const url = this.currentLogo.custom
        ? this.currentLogo.image
        : this.img(this.currentLogo.image)
      canvas.addImage(
        logoId,
        url,
        function(img, context) {
          /*считаем коэффициент масштабирования scale, чтобы изображения добавлялись на холст всегда с одинаковыми размерами (или по высоте, или по ширине) */
          if (img.width >= img.height) {
            var scale = context.currentLogoSize.size / 3 / img.width
          } else {
            var scale = context.currentLogoSize.size / 3 / img.height
          }
          // устанавливаем настройки изображения
          img.set({
            scaleX: scale,
            scaleY: scale,
            left: canvas.ctx.width / 2,
            top: canvas.ctx.height / 2,
            originX: 'center',
            originY: 'center',
            centeredScaling: true,
            padding: 10,
            transparentCorners: false,
            borderColor: '#000000',
            cornerColor: '#000000',
            cornerStrokeColor: '#000000'
          })
          // скрываем элементы управления нанесением
          img.setControlVisible('ml', false)
          img.setControlVisible('mr', false)
          img.setControlVisible('mt', false)
          img.setControlVisible('mb', false)
          img.setControlVisible('mtr', false)
        },
        this
      )
    },
    selType(type) {
      this.currentType = type
    },
    selModel(model) {
      this.currentModel = model
    },
    selLogo(logo) {
      this.currentLogo = logo
    },
    selColor(color) {
      this.currentColor = color
      if (
        (this.isChangeColor && this.isChangeColor === true) ||
        (this.isChangeType && this.isChangeType === true)
      ) {
        let order = this.getOrder()
        let canvas = order.canvas
        order.color = color
        order.isDone = false
        canvas.removeImage('front')
        canvas.removeImage('back')

        canvas.addImage(
          'front',
          this.img(order.color.image_front),
          function(img) {
            img.set({
              scaleX: canvas.ctx.width / img.width / 2,
              scaleY: canvas.ctx.height / img.height,
              originX: 0,
              originY: 'top',
              selectable: false
            })
          },
          this,
          function(img) {
            img.sendToBack()
          }
        )

        canvas.addImage(
          'back',
          this.img(order.color.image_back),
          function(img) {
            img.set({
              scaleX: canvas.ctx.width / img.width / 2,
              scaleY: canvas.ctx.height / img.height,
              originX: -1,
              originY: 'top',
              selectable: false
            })
          },
          this,
          function(img) {
            img.sendToBack()
          }
        )
        order.type = this.currentType
        order.model = this.currentModel
        order.color = this.currentColor
        order.titleTab = this.currentModel.name + ' ' + this.currentColor.name
        order.titleCanvas =
          this.currentModel.name + '<br/>' + this.currentColor.article
        this.isChangeColor = false
        this.isChangeType = false
        order.isDone = true
        return
      }

      const id = this.guid()
      this.currentOrderId = id
      let newOrder = {
        id: id,
        titleTab: this.currentModel.name + ' ' + this.currentColor.name,
        titleCanvas:
          this.currentModel.name + '<br/>' + this.currentColor.article,
        type: this.currentType,
        model: this.currentModel,
        color: this.currentColor,
        canvas: null,
        isDone: false
      }
      this.orders.push(newOrder)
      this.currentColor = null
      this.currentModel = null
      this.currentType = null
      let order = this.getOrder()
      if (this.orders.length === 1) this.tab = 0
      else this.tab = this.orders.length
      setTimeout(() => {
        order.canvas = new Canvas('orderCanvas_' + newOrder.id)
        if (order && order.color && order.color.image_back) {
          let canvas = order.canvas
          // console.log(this.$refs)
          // canvas.ctx = this.$refs['mycanv' + newOrder.id].getContext('2d')
          canvas.addImage(
            'front',
            this.img(order.color.image_front),
            function(img) {
              img.set({
                scaleX: canvas.ctx.width / img.width / 2,
                scaleY: canvas.ctx.height / img.height,
                originX: 0,
                originY: 'top',
                selectable: false
              })
            },
            this,
            function(img) {
              img.sendToBack()
            }
          )

          canvas.addImage(
            'back',
            this.img(order.color.image_back),
            function(img) {
              img.set({
                scaleX: canvas.ctx.width / img.width / 2,
                scaleY: canvas.ctx.height / img.height,
                originX: -1,
                originY: 'top',
                selectable: false
              })
            },
            this,
            function(img) {
              img.sendToBack()
            }
          )
          order.isDone = true
          this.$forceUpdate()
        }
      }, 600)
      // this.selectedType = type
      this.$forceUpdate()
    },
    // selectType(type) {
    //   const id = this.guid()
    //   this.currentOrderId = id
    //   let newOrder = {
    //     id: id,
    //     type: type,
    //     canvas: null,
    //     show: false
    //   }
    //   this.orders.push(newOrder)
    //   setTimeout(() => {
    //     newOrder.canvas = new Canvas('test' + newOrder.id)
    //     // return
    //     if (type.imgBack) {
    //       let canvas = newOrder.canvas
    //       // console.log(this.$refs)
    //       // canvas.ctx = this.$refs['mycanv' + newOrder.id].getContext('2d')
    //       canvas.addImage(
    //         'front',
    //         this.image(type.imgFront),
    //         function(img) {
    //           img.set({
    //             scaleX: canvas.ctx.width / img.width / 2,
    //             scaleY: canvas.ctx.height / img.height,
    //             originX: 0,
    //             originY: 'top',
    //             selectable: false
    //           })
    //         },
    //         function(img) {
    //           img.sendToBack()
    //         }
    //       )

    //       canvas.addImage(
    //         'back',
    //         this.image(type.imgBack),
    //         function(img) {
    //           img.set({
    //             scaleX: canvas.ctx.width / img.width / 2,
    //             scaleY: canvas.ctx.height / img.height,
    //             originX: -1,
    //             originY: 'top',
    //             selectable: false
    //           })
    //         },
    //         function(img) {
    //           img.sendToBack()
    //         }
    //       )
    //     }
    //   }, 500)

    //   this.selectedType = type
    // },
    // image(image) {
    //   return this.api + '/' + image
    // },
    // getCanvasByOrderId() {
    //   const order = this.orders.find(x => x.id === this.currentOrderId)
    //   if (order && order.canvas) return order.canvas
    //   return null
    // },
    guid() {
      return Math.floor(Math.random() * 1000000000000000)
    }
  },
  watch: {
    allTextSizes(value) {
      this.currentTextSize = value[0]
    },
    allNumberSizes(value) {
      this.currentNumberSize = value[0]
    },
    allLogoSizes(value) {
      this.currentLogoSize = value[0]
    },
    allLogos(value) {
      this.currentLogo = value[0]
    }
  }
}
</script>

<style scoped>
/* .swiper-container {
  height: 300px;
  width: 100%;
}

.swiper-wrapper {
  margin: auto 50px;
}

.swiper-slide {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  transition: 1s;
} */
</style>
