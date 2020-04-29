<template>
  <v-app id="app" dark style="background: white">
    <v-container fluid>
      <v-row>
        <v-col cols="12" md="10" offset-md="1">
          <v-btn
            style="position: fixed; left: 50px; top: 25px"
            text
            icon
            large
            class="w100"
            to="/lk"
          >
            <v-icon>mdi-format-align-justify</v-icon>
          </v-btn>

          <!-- Вкладки заказов -->
          <v-row v-if="orders && orders.length > 0">
            <v-col>
              <v-tabs v-model="tab">
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
                <v-tab @click="newOrder">Добавить артикул</v-tab>
              </v-tabs>
            </v-col>
          </v-row>
          <!-- Выбор типов -->
          <v-row v-if="showPanelTypes && allTypes" ref="mySwiperTypes">
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
            id="row-model"
            v-if="showPanelModels && modelsByType && modelsByType.length > 0"
          >
            <v-col>
              <h2 class="text-center">Модели</h2>
              <swiper ref="mySwiperModel" :options="swiperOptions">
                <swiper-slide
                  @click.native="selModel(model)"
                  v-for="model in modelsByType"
                  :key="model.id"
                  class="swiper-element"
                  :class="{
                    'swiper-active':
                      currentModel && model.id === currentModel.id
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

          <v-row
            v-if="showPanelColors && colorsByModel && colorsByModel.length > 0"
          >
            <v-col cols="12">
              <h2 class="text-center">Цвета</h2>
              <swiper ref="myswipercolors" :options="swiperOptions">
                <swiper-slide
                  @click.native="selColor(color)"
                  v-for="color in colorsByModel"
                  :key="color.id"
                  class="swiper-element"
                  :class="{
                    'swiper-active':
                      currentColor && color.id === currentColor.id
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
                <v-col cols="7" style="position: relative">
                  <v-btn
                    text
                    fab
                    title="Копировать нанесения"
                    @click="openDialogCopy"
                    style="position: absolute; top: 20px; left: 30px"
                  >
                    <v-icon>mdi-content-copy</v-icon>
                  </v-btn>
                  <h2 v-html="order.titleCanvas" class="text-center mb-0"></h2>
                  <canvas
                    height="350"
                    width="700"
                    v-bind:id="'orderCanvas_' + order.id"
                    :ref="'canvasImg_' + order.id"
                  >
                  </canvas>
                  <div class="mt-4">
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
                <v-col cols="5" class="pt-0">
                  <div>
                    <div class="" style="height: 40px">
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

                    <h3 class="text-center mb-0">Нанесения логотипа</h3>
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
                        <div
                          class="swiper-button-prev"
                          slot="button-prev"
                        ></div>
                        <div
                          class="swiper-button-next"
                          slot="button-next"
                        ></div>

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
                      <v-col cols="12">
                        <div style="height: 42px">
                          <v-select
                            dense
                            :items="logoTypesBySize"
                            label="Тип логотипа"
                            item-text="name"
                            return-object
                            v-model="currentLogoType"
                            outlined
                          >
                            <template v-slot:item="{ item }">
                              <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                  <div class="w100" v-on="on">
                                    {{ item.name }}
                                  </div>
                                </template>
                                <span class="pt-10 pb-10 px-5">{{
                                  item.description
                                }}</span>
                              </v-tooltip>
                            </template>
                          </v-select>
                        </div>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" class="d-flex flex-flow">
                        <v-btn
                          :color="
                            currentLogoSize &&
                            currentLogoSize.id === logoSize.id
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
                      <div
                        class="d-flex flex-row flex-nowrap"
                        style="height: 55px"
                      >
                        <div style="flex: 1 1 auto">
                          <v-text-field
                            label="Номер"
                            type="number"
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
                            @change="changeFont($event, 'number')"
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
                              :style="
                                'background-color: ' + textColor.code + ';'
                              "
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
                      <div
                        class="d-flex flex-row flex-nowrap"
                        style="height: 55px"
                      >
                        <div style="flex: 1 1 auto">
                          <v-text-field
                            label="Фамилия или текст"
                            class="custom-dense mr-3"
                            dense
                            outlined
                            v-model="currentFioText"
                            @input="changeFioText"
                          ></v-text-field>
                        </div>
                        <div style="flex: 0 1 150px">
                          <v-select
                            dense
                            :items="allFonts"
                            label="Шрифт"
                            class="mr-3"
                            v-model="currentFontFio"
                            @change="changeFont($event, 'text')"
                            outlined
                          ></v-select>
                        </div>
                        <div style="position: relative">
                          <div
                            :style="
                              'background-color: ' +
                                currentTextColorFio.code +
                                ';'
                            "
                            :title="currentTextColorFio.text"
                            @click="showColorPanelFio = !showColorPanelFio"
                            class="nav-item boxColor boxColorActive boxColor-single"
                          ></div>
                          <div
                            class="boxSelectColors"
                            v-show="showColorPanelFio"
                          >
                            <div
                              :class="['nav-item boxColor']"
                              :style="
                                'background-color: ' + textColor.code + ';'
                              "
                              :title="textColor.text"
                              @click="selTextColorFio(textColor)"
                              v-for="textColor in allTextColors"
                              v-show="
                                currentTextColorFio.code !== textColor.code
                              "
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
                            currentTextSize &&
                            currentTextSize.id === textSize.id
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
                        <!-- <v-btn
                          tile
                          color="primary"
                          @click.prevent.stop="addString"
                          style="flex: 0 1 140px;"
                        >
                          Добавить
                          <v-icon class="ml-1">mdi-plus</v-icon>
                        </v-btn> -->
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" class="pt-0">
                        <div
                          style="margin-bottom: -10px"
                          class="d-flex flex-row flex-nowrap align-end justify-space-between"
                        >
                          <span style="font-size: 0.8rem">Кривая</span>
                          <span>Кривизна надписи ({{ diameter }} ед.)</span>
                          <span style="font-size: 0.8rem">Прямая</span>
                        </div>
                        <v-slider
                          v-model="diameter"
                          class="range-diameter"
                          min="1"
                          step="1"
                          color="red"
                          max="8"
                        >
                        </v-slider>
                      </v-col>
                      <v-col cols="12">
                        <v-btn
                          tile
                          color="primary"
                          @click.prevent.stop="addStringCurved"
                          class="w100"
                        >
                          Добавить
                          <v-icon class="ml-1">mdi-plus</v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>
                  </div>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  <table-size
                    ref="tableSize"
                    :sizes="order.orderedSizes"
                    @changeOrderedSizes="changeOrderedSizes($event)"
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="6">
                  <v-btn
                    large
                    @click="openDialogZakazTovar"
                    color="primary"
                    class="w100"
                    >Заказ Товар</v-btn
                  >
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn
                    large
                    @click="openDialogLogos"
                    color="primary"
                    class="w100"
                    >Заказ Нанесение</v-btn
                  >
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn
                    large
                    @click="openDialogNomerFio"
                    color="primary"
                    class="w100"
                    >ТЗ Нанесение</v-btn
                  >
                </v-col>
                <v-col cols="12" md="6">
                  <v-btn
                    large
                    @click="openDialogZakazAll"
                    color="success"
                    class="w100"
                    >Оформить заказ</v-btn
                  >
                </v-col>
              </v-row>
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
import TableSize from './ConstructorSize'
import DialogZakazTovar from '../components/Dialog/ZakazTovar'
import DialogZakazNomerFio from '../components/Dialog/ZakazNomerFio'
import DialogZakazLogos from '../components/Dialog/ZakazLogos'
import DialogZakazAll from '../components/Dialog/ZakazAll'
import DialogCopy from '../components/Dialog/CopyDialog'
export default {
  components: {
    TableSize
  },
  props: {
    source: String
  },
  data: () => ({
    // tableSizesData: [],
    tab: 0,
    showPanelTypes: false,
    showPanelModels: false,
    showPanelColors: false,
    diameter: 8,
    currentType: null,
    currentModel: null,
    currentColor: null,
    currentLogo: null,
    currentLogoSize: null,
    currentLogoType: null,
    currentNumberSize: null,
    currentNumberText: null,
    currentFont: 'Nike',
    fontExample: 'Nike',
    currentTextColor: { text: 'Черный', code: '#000000' },
    currentTextSize: null,
    currentFioText: '',
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
    await this.getAllLogoTypes()
    await this.getAllNumberSizes()
    await this.getAllTextSizes()
  },
  mounted() {
    if (this.allTypes && this.allTypes.length > 0) this.showPanelTypes = true
    else {
      setTimeout(() => {
        this.getAllTypes()
        this.showPanelTypes = true
      }, 800)
    }
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
      allLogoTypes: state => state.logoType.allLogoTypes,
      allNumberSizes: state => state.numberSize.allNumberSizes,
      allTextSizes: state => state.textSize.allTextSizes,
      showDeleteLogo: state => state.canvas.showDeleteBtn,
      copyDialogResult: state => state.dialog.copyDialogResult
    }),
    logoTypesBySize() {
      if (this.currentLogoSize) {
        return this.allLogoTypes.filter(
          x => x.logo_size_id === this.currentLogoSize.id
        )
      }
      if (this.allLogoTypes && this.allLogoTypes.length > 0) {
        const findFirstLogoSizeId = this.allLogoTypes[0]
        return this.allLogoTypes.filter(
          x => x.logo_size_id === findFirstLogoSizeId.logo_size_id
        )
      }
      return []
    },
    allLogosList() {
      return [...this.allLogos, ...this.allCustomLogos]
    },
    modelsByType() {
      if (this.currentType && this.currentType.id && this.allModels)
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
      'getAllLogoTypes',
      'getAllNumberSizes',
      'getAllTextSizes',
      'resetCopyDialogResult'
    ]),
    changeFioText(e) {
      this.currentFioText = e.toUpperCase()
    },
    openDialogCopy() {
      this.$modal.show(
        DialogCopy,
        { orders: this.orders },
        {
          ...config.modalSettings,
          clickToClose: true
        },
        {
          closed: this.selectedOrderForCopy
        }
      )
    },
    selectedOrderForCopy() {
      if (this.copyDialogResult) {
        let orderId = this.copyDialogResult
        let order = this.getOrder()
        let canvas = order.canvas
        let targetOrder = this.orders.find(
          x => Number(x.id) === Number(orderId)
        )
        if (targetOrder) {
          Object.keys(targetOrder.canvas.images).forEach(objKey => {
            if (objKey !== 'front' && objKey !== 'back') {
              let obj = targetOrder.canvas.images[objKey]
              obj.clone(x => {
                x.set({
                  left: x.left,
                  top: x.top,
                  evented: true,
                  centeredScaling: true,
                  padding: 10,
                  transparentCorners: false,
                  borderColor: '#000000',
                  cornerColor: '#000000',
                  cornerStrokeColor: '#000000'
                })
                x.setControlVisible('ml', false)
                x.setControlVisible('mr', false)
                x.setControlVisible('mt', false)
                x.setControlVisible('mb', false)
                x.setControlVisible('mtr', false)
                order.canvas.ctx.add(x)
                order.canvas.images[this.guid()] = x
                // order.canvas.ctx.sendToFront(x)
              })
            }
          })

          Object.keys(targetOrder.canvas.texts).forEach(objKey => {
            let obj = targetOrder.canvas.texts[objKey]
            if (obj.type !== 'textcurved') {
              obj.clone(x => {
                x.set({
                  left: x.left,
                  top: x.top,
                  evented: true,
                  centeredScaling: true,
                  padding: 10,
                  transparentCorners: false,
                  borderColor: '#000000',
                  cornerColor: '#000000',
                  cornerStrokeColor: '#000000'
                })
                x.setControlVisible('ml', false)
                x.setControlVisible('mr', false)
                x.setControlVisible('mt', false)
                x.setControlVisible('mb', false)
                x.setControlVisible('mtr', false)
                order.canvas.ctx.add(x)
                order.canvas.texts[this.guid()] = x
              })
            } else {
              // console.log(obj)
              // console.log('CLONED')
              // let cop = obj.clone()
              // order.canvas.ctx.add(obj)
              // order.canvas.texts[this.guid()] = obj

              obj.clone(x => {
                // console.log(1)
                x.set({
                  flipped: false,
                  diameter: x.diameter,
                  fontFamily: x.fontFamily,
                  left: x.left,
                  top: x.top,
                  evented: true,
                  centeredScaling: true,
                  padding: 10,
                  transparentCorners: false,
                  borderColor: '#000000',
                  cornerColor: '#000000',
                  cornerStrokeColor: '#000000'
                })
                x.setControlVisible('ml', false)
                x.setControlVisible('mr', false)
                x.setControlVisible('mt', false)
                x.setControlVisible('mb', false)
                x.setControlVisible('mtr', false)
                order.canvas.ctx.add(x)
                order.canvas.texts[this.guid()] = x
                order.canvas.ctx.bringForward(x)
              })
            }
          })

          order.orderedLogos = [
            ...order.orderedLogos,
            ...targetOrder.orderedLogos
          ]
          order.orderedTexts = [
            ...order.orderedTexts,
            ...targetOrder.orderedTexts
          ]
        }
        this.resetCopyDialogResult()
      }
    },
    delTextFromOrder(textId) {
      let order = this.getOrder()
      if (order && order.orderedTexts) {
        const find = order.orderedTexts.find(
          x => Number(x.id) === Number(textId)
        )
        if (find) {
          const pos = order.orderedTexts.indexOf(find)
          order.orderedTexts.splice(pos, 1)
        }
      }
    },
    addTextToOrder(textSize, type, text, textId, curved) {
      let order = this.getOrder()
      if (!order.orderedTexts) order.orderedTexts = []
      order.orderedTexts.push({
        id: textId,
        type: type,
        text: text,
        textSize: textSize,
        textSizeId: textSize.id,
        curved: curved
      })
    },
    delLogoFromOrder(logoId) {
      let order = this.getOrder()
      if (order && order.orderedLogos) {
        const find = order.orderedLogos.find(
          x => Number(x.id) === Number(logoId)
        )
        if (find) {
          const pos = order.orderedLogos.indexOf(find)
          order.orderedLogos.splice(pos, 1)
        }
      }
    },
    addLogoToOrder(logoType, logoSize, logo, logoId) {
      let order = this.getOrder()
      if (!order.orderedLogos) order.orderedLogos = []
      order.orderedLogos.push({
        id: logoId,
        logo: logo,
        logoType: logoType,
        logoSize: logoSize,
        logoTypeId: logoType.id,
        logoSizeId: logoSize.id
      })
    },
    openDialogZakazAll() {
      this.$modal.show(
        DialogZakazAll,
        { orders: this.orders },
        {
          pivotY: 0.1,
          width: '90%',
          height: 'auto',
          ...config.modalSettings,
          scrollable: true
        }
      )
    },
    openDialogLogos() {
      this.$modal.show(
        DialogZakazLogos,
        { orders: this.orders },
        { width: '80%', ...config.modalSettings, scrollable: true }
      )
    },
    openDialogNomerFio() {
      this.$modal.show(
        DialogZakazNomerFio,
        { orders: this.orders },
        { width: '80%', ...config.modalSettings, scrollable: true }
      )
    },
    openDialogZakazTovar() {
      this.$modal.show(
        DialogZakazTovar,
        { orders: this.orders },
        { width: '95%', ...config.modalSettings }
      )
    },
    scrollTo(elementName, delay) {
      setTimeout(() => {
        let element = this.$refs[elementName]
        var top = element.offsetTop
        window.scrollTo({ top: top, left: 0, behavior: 'smooth' })
        this.drawer = false
      }, delay)
    },
    changeOrderedSizes(e) {
      let order = this.getOrder()
      order.orderedSizes = [...e]
    },
    changeModelTshirt() {
      this.currentType = this.order.type
      // this.currentModel = this.order.model
      // this.currentColor = this.order.color
      this.isChangeType = true
      this.isChangeColor = true
      this.showPanelTypes = true
      // this.showPanelModels = true
      // this.showPanelColors = true
    },
    changeColorTshirt() {
      this.currentModel = this.order.model
      this.isChangeColor = true
      this.showPanelColors = true
    },
    changeFont(event, type) {
      this.fontExample = event
      this.changeActiveObject(type)
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
      this.changeActiveObject('text')
    },
    selTextColor(textColor) {
      this.currentTextColor = textColor
      this.showColorPanel = false
      this.changeActiveObject('number')
    },
    changeActiveObject(changedField) {
      const order = this.getOrder()
      let selectedObj = order.canvas.ctx.getActiveObject()
      if (selectedObj && this.currentTextColor) {
        switch (changedField) {
          case 'text': {
            selectedObj.set('fill', this.currentTextColorFio.code)
            selectedObj.set('fontFamily', this.currentFontFio)
            break
          }
          case 'number': {
            selectedObj.set('fill', this.currentTextColor.code)
            selectedObj.set('fontFamily', this.currentFont)
            break
          }
        }
      }
      order.canvas.ctx.renderAll()
    },
    // функция удаления выбранного нанесения
    deleteSelectedDrawing() {
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
              this.delLogoFromOrder(key)
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
        else if (
          selectedDrawing.type == 'text' ||
          selectedDrawing.type == 'textcurved'
        ) {
          console.log(' - Выбрали текст')
          Object.keys(canvas.texts).forEach(key => {
            if (canvas.texts[key] === selectedDrawing) {
              canvas.removeText(key)
              this.delTextFromOrder(key)
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
      if (this.orders.length === 1) {
        this.tab = 0
      } else this.tab = this.orders.length
      if (this.orders.length === 0) {
        this.showPanelTypes = true
        this.currentType = null
        this.currentModel = null
        this.currentColor = null
      }
    },
    clearSelection() {
      this.currentType = null
      this.currentModel = null
      this.currentColor = null
      this.currentOrderId = null
    },
    newOrder() {
      this.currentOrderId = null
      this.currentType = null
      this.currentModel = null
      this.currentColor = null
      this.showPanelColors = false
      this.showPanelModels = false
      this.showPanelTypes = true
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
    addStringCurved() {
      // если строки нет, выходим из функции
      if (!this.currentTextSize || !this.currentFioText) return

      let canvas = this.order.canvas
      const stringId = this.guid()
      let curved = this.diameter === 8 ? '(прямая)' : '(кривая)'
      this.addTextToOrder(
        this.currentTextSize,
        'text',
        this.currentFioText,
        stringId,
        curved
      )

      let options = {
        diameter: this.diameter * 300,
        kerning: 0,
        flipped: false,
        originX: 'center',
        originY: 'center',
        left: canvas.ctx.width * 0.5,
        top: canvas.ctx.height * 0.5,
        fontFamily: this.currentFontFio,
        fill: this.currentTextColorFio.code,
        centeredScaling: true,
        padding: 10,
        transparentCorners: false,
        borderColor: '#000000',
        cornerColor: '#000000',
        cornerStrokeColor: '#000000'
      }

      if (this.currentTextSize.size <= 100)
        options.fontSize = this.currentTextSize.size * 0.35
      if (this.currentTextSize.size > 100 && this.currentTextSize.size <= 200)
        options.fontSize = this.currentTextSize.size * 0.3
      if (this.currentTextSize.size > 200)
        options.fontSize = this.currentTextSize.size * 0.21

      // добавляем строку на холст
      canvas.addTextCurved(stringId, this.currentFioText, options)
    },
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
      let curved = this.diameter === 8 ? '(прямая надпись)' : '(кривая надпись)'
      this.addTextToOrder(
        this.currentTextSize,
        'text',
        this.currentFioText,
        stringId,
        curved
      )
      // добавляем строку на холст
      canvas.addText(stringId, this.currentFioText, {
        originX: 'center',
        originY: 'center',
        left: canvas.ctx.width * 0.5,
        top: canvas.ctx.height * 0.5,
        fontFamily: this.currentFontFio,
        fontSize: this.currentTextSize.size * 0.35,
        fill: this.currentTextColorFio.code,
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

      this.addTextToOrder(
        this.currentNumberSize,
        'number',
        this.currentNumberText,
        numberId,
        ''
      )
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
      if (!this.currentLogoSize || !this.currentLogoType) {
        alert('Не выбран размер или тип нанесения')
        return
      }
      let canvas = this.order.canvas
      const logoId = this.guid()
      const url = this.currentLogo.custom
        ? this.currentLogo.image
        : this.img(this.currentLogo.image)
      this.addLogoToOrder(
        this.currentLogoType,
        this.currentLogoSize,
        this.currentLogo,
        logoId
      )
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
      this.currentModel = null
      this.showPanelModels = true
      this.showPanelColors = false
    },
    selModel(model) {
      this.currentModel = model
      this.showPanelColors = true
    },
    selLogo(logo) {
      this.currentLogo = logo
    },
    selColor(color) {
      this.currentColor = color
      // this.tableSizesData = color.sizes.map
      if (
        (this.isChangeColor && this.isChangeColor === true) ||
        (this.isChangeType && this.isChangeType === true)
      ) {
        let order = this.getOrder()
        let canvas = order.canvas
        order.isDone = false

        order.type = this.currentType
        order.model = this.currentModel
        order.color = this.currentColor
        order.orderedSizes = this.currentColor.sizes
        // this.$set(order, 'orderedSizes', this.currentColor.sizes)
        // console.log()
        // this.$refs.tableSize.$forceUpdate()
        // console.log('SEL COLOR')
        // console.log(order.orderedSizes)
        order.titleTab = this.currentModel.name + ' ' + this.currentColor.name
        order.titleCanvas =
          this.currentModel.name +
          '<br/>' +
          'Артикул: ' +
          this.currentColor.article

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
          300,
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
          300,
          function(img) {
            img.sendToBack()
          }
        )
        this.isChangeColor = false
        this.isChangeType = false
        order.isDone = true
        this.showPanelTypes = false
        this.showPanelModels = false
        this.showPanelColors = false
        // this.$forceUpdate()
        this.$refs['tableSize'][0].$forceUpdate()
        return
      }

      const id = this.guid()
      this.currentOrderId = id
      let newOrder = {
        id: id,
        titleTab: this.currentModel.name + ' ' + this.currentColor.name,
        titleCanvas:
          this.currentModel.name +
          '<br/>' +
          'Артикул: ' +
          this.currentColor.article,
        type: this.currentType,
        model: this.currentModel,
        color: this.currentColor,
        canvas: null,
        isDone: false,
        orderedSizes: color.sizes,
        orderedLogos: [],
        orderedTexts: []
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
      this.$forceUpdate()
      this.showPanelTypes = false
      this.showPanelModels = false
      this.showPanelColors = false
    },
    guid() {
      return Math.floor(Math.random() * 1000000000000000)
    }
  },
  watch: {
    currentLogoSize(value) {
      if (this.logoTypesBySize && this.logoTypesBySize.length > 0) {
        this.currentLogoType = this.logoTypesBySize[0]
      } else this.currentLogoType = null
    },
    allLogoTypes(value) {
      if (value && value.length > 0) this.currentLogoType = value[0]
    },
    allTextSizes(value) {
      if (value && value.length > 0) this.currentTextSize = value[0]
    },
    allNumberSizes(value) {
      if (value && value.length > 0) this.currentNumberSize = value[0]
    },
    allLogoSizes(value) {
      if (value && value.length > 0) this.currentLogoSize = value[0]
    },
    allLogos(value) {
      if (value && value.length > 0) this.currentLogo = value[0]
    }
  }
}
</script>

<style lang="scss">
// @import '../assets/scss/_app';
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
