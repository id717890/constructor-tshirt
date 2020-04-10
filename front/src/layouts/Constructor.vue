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
      <v-row v-if="order === null || order.isDone === false">
        <v-col cols="12">
          <swiper ref="mySwiper" :options="swiperOptions">
            <swiper-slide
              @click.native="selModel(model)"
              v-for="model in modelsByType"
              :key="model.id"
              class="swiper-element"
              :class="{
                'swiper-active': currentModel && model.id === currentModel.id
              }"
              style="background-position: center; max-width: 260px; background-size: contain; background-repeat: no-repeat; cursor: pointer;"
            >
              <v-img :src="img(model.image)" max-width="260"></v-img>
            </swiper-slide>
            <!-- Стрелки прокрутки моделей -->
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
          </swiper>
        </v-col>
      </v-row>

      <v-row v-if="order === null || order.isDone === false">
        <v-col>
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
          v-show="order.id === currentOrderId"
        >
          <canvas
            height="350"
            width="700"
            v-bind:id="'orderCanvas_' + order.id"
            ref="canvasImg"
          >
          </canvas>
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
    this.getAllTypes()
    this.getAllModels()
    this.getAllColors()
  },
  mounted() {},
  destroyed() {
    // window.removeEventListener('scroll', this.scroll)
  },
  computed: {
    ...mapState({
      allTypes: state => state.type.allTypes,
      allModels: state => state.model.allModels,
      allColors: state => state.color.allColors
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
    },
    getTitleTab() {
      if (this.order && this.order.model && this.order.color)
        return this.order.model.name + ' ' + this.order.color.name
      return 'N/D'
    }
  },
  methods: {
    ...mapActions(['getAllTypes', 'getAllModels', 'getAllColors']),
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
    addLogo(id) {
      let canvas = this.getCanvasByOrderId()
      const logoId = this.guid()
      canvas.addImage(logoId, this.api + '/' + this.lLogos[id].img, function(
        img
      ) {
        /*считаем коэффициент масштабирования scale, чтобы изображения добавлялись на холст всегда с одинаковыми размерами (или по высоте, или по ширине) */
        if (img.width >= img.height) {
          var scale = 300 / 3 / img.width
        } else {
          var scale = 300 / 3 / img.height
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
      })
    },
    selType(type) {
      this.currentType = type
    },
    selModel(model) {
      this.currentModel = model
    },
    selColor(color) {
      this.currentColor = color
      const id = this.guid()
      this.currentOrderId = id
      let newOrder = {
        id: id,
        titleTab: this.currentModel.name + ' ' + this.currentColor.name,
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
        }
      }, 1000)
      // this.selectedType = type
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
<style lang="scss">
@import '../assets/scss/_app';
</style>
