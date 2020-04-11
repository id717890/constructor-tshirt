<template>
  <v-app id="app" dark style="background: white">
    <v-container>
      <v-row>
        <v-col>
          <v-btn class="w100" to="/lk">ЛК</v-btn>
        </v-col>
      </v-row>
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
      <v-row v-if="this.order === null || order.isDone === false">
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
      <v-row id="row2" v-if="order === null || order.isDone === false">
        <v-col cols="12" v-if="order === null || order.isDone === false">
          <swiper
            ref="mySwiper"
            :options="swiperOptions"
            v-if="order === null || order.isDone === false"
          >
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

      <v-row id="row123" v-if="order === null || order.isDone === false">
        <v-col cols="12">
          <swiper ref="mySwiper" :options="swiperOptions">
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
            <v-col cols="7">
              <h2 v-html="order.titleCanvas"></h2>
              <canvas
                height="350"
                width="700"
                v-bind:id="'orderCanvas_' + order.id"
                ref="canvasImg"
              >
              </canvas>
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
                      v-for="logo in allLogos"
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
                      <v-img
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
                  <v-btn color="primary" class="w100">
                    Загрузить свой логотип
                    <v-icon class="ml-5">mdi-image</v-icon>
                  </v-btn>
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
                      style="flex: 0 1 auto;"
                    >
                      Добавить
                      <v-icon class="ml-3">mdi-plus</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>

    <!-- <v-row v-if="lTypes">
      <v-col cols="1" v-for="type in lTypes" :key="type.id">
        <v-img :src="api + '/' + type.imgFront"></v-img>
        <v-btn
          :color="
            selectedType && selectedType.id === type.id ? 'success' : 'primary'
          "
          class="mt-3"
          @click="selectType(type)"
        >
          Select
        </v-btn>
      </v-col>
      <v-col cols="2">
        <v-btn @click="addLogo(1)">Add Logo 1</v-btn>
        <v-btn @click="addLogo(2)">Add Logo 2</v-btn>
        <v-btn to="/lk">LK</v-btn>
      </v-col>
    </v-row> -->
    <!-- <v-row>
      <v-col cols="12">
        <a
          href="#"
          class="mr-5"
          @click.prevent.stop="currentOrderId = order.id"
          v-for="order in orders"
          :key="order.id"
          >{{ order.id }}</a
        >
      </v-col>
    </v-row> -->
    <!-- <v-row>
      <v-col
        cols="12"
        v-for="order in orders"
        :key="order.id"
        v-show="order.id === currentOrderId"
      >
        <canvas
          height="350"
          width="700"
          v-bind:id="'test' + order.id"
          ref="canvasImg"
        >
        </canvas>
      </v-col>
    </v-row> -->
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
    swiperOptions: {
      slidesPerView: 4,
      spaceBetween: 10,
      slidesPerGroup: 1,
      loop: false,
      loopFillGroupWithBlank: false,
      slidesOffsetBefore: 0,
      slidesOffsetAfter: 40,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      }
    },
    // api: url + 'api/image',
    lTypes: [],
    lLogos: [],
    selectedType: null,
    currentOrderId: 0,
    orders: []
  }),
  async created() {
    await this.getAllTypes()
    await this.getAllModels()
    await this.getAllColors()
    await this.getAllLogos()
    await this.getAllLogoSizes()
  },
  mounted() {
    if (this.allLogoSizes) {
      this.currentLogoSize = this.allLogoSizes[0]
    } else {
      setTimeout(() => {
        this.currentLogoSize = this.allLogoSizes[0]
      }, 800)
    }
    if (this.allLogos) {
      this.currentLogo = this.allLogos[0]
    } else {
      setTimeout(() => {
        this.currentLogo = this.allLogos[0]
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
      showDeleteLogo: state => state.canvas.showDeleteBtn
    }),
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
      return this.getOrder()
    }
  },
  methods: {
    ...mapActions([
      'getAllTypes',
      'getAllModels',
      'getAllColors',
      'getAllLogos',
      'getAllLogoSizes'
    ]),
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
          for (textName in canvases[appData.selectedOrder].texts) {
            if (
              canvases[appData.selectedOrder].texts[textName] == selectedDrawing
            ) {
              // удаляем номер или надпись из заказа
              currentOrder.order.removeNumber(textName)
              currentOrder.order.removeString(textName)
              // удаляем текст с холста
              canvases[appData.selectedOrder].removeText(textName)
            }
          }
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
    addLogo() {
      if (!this.currentLogoSize) {
        alert('Не выбран размер нанесения')
        return
      }
      let canvas = this.order.canvas
      const logoId = this.guid()
      const that = this
      canvas.addImage(
        logoId,
        this.img(this.currentLogo.image),
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
    selectType(type) {
      const id = this.guid()
      this.currentOrderId = id
      let newOrder = {
        id: id,
        type: type,
        canvas: null,
        show: false
      }
      this.orders.push(newOrder)
      setTimeout(() => {
        newOrder.canvas = new Canvas('test' + newOrder.id)
        // return
        if (type.imgBack) {
          let canvas = newOrder.canvas
          // console.log(this.$refs)
          // canvas.ctx = this.$refs['mycanv' + newOrder.id].getContext('2d')
          canvas.addImage(
            'front',
            this.image(type.imgFront),
            function(img) {
              img.set({
                scaleX: canvas.ctx.width / img.width / 2,
                scaleY: canvas.ctx.height / img.height,
                originX: 0,
                originY: 'top',
                selectable: false
              })
            },
            function(img) {
              img.sendToBack()
            }
          )

          canvas.addImage(
            'back',
            this.image(type.imgBack),
            function(img) {
              img.set({
                scaleX: canvas.ctx.width / img.width / 2,
                scaleY: canvas.ctx.height / img.height,
                originX: -1,
                originY: 'top',
                selectable: false
              })
            },
            function(img) {
              img.sendToBack()
            }
          )
        }
      }, 500)

      this.selectedType = type
    },
    // image(image) {
    //   return this.api + '/' + image
    // },
    getCanvasByOrderId() {
      const order = this.orders.find(x => x.id === this.currentOrderId)
      if (order && order.canvas) return order.canvas
      return null
    },
    guid() {
      return Math.floor(Math.random() * 1000000000000000)
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
