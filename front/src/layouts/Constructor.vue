<template>
  <v-app id="app" dark>
    <v-row v-if="lTypes">
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
    </v-row>
    <v-row>
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
          v-bind:id="'test' + order.id"
          ref="canvasImg"
        >
        </canvas>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
const url = 'http://localhost/jomafull/back/public/'
import api from '../api/api'
import Canvas from '../Canvas'
export default {
  components: {},
  props: {
    source: String
  },
  data: () => ({
    api: url + 'api/image',
    lTypes: [],
    lLogos: [],
    selectedType: null,
    currentOrderId: 0,
    orders: []
  }),
  created() {
    api.getTypes().then(x => {
      this.lTypes = x
    })
    api.getLogos().then(x => {
      this.lLogos = x
    })
  },
  destroyed() {
    // window.removeEventListener('scroll', this.scroll)
  },
  methods: {
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
    image(image) {
      return this.api + '/' + image
    },
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
