<template>
  <v-app id="inspire" dark>
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
import api from './api/api'
import Canvas from './Canvas'
export default {
  components: {},
  props: {
    source: String
  },
  data: () => ({
    api: url + 'api/image',
    lTypes: [],
    selectedType: null,
    currentOrderId: 0,
    orders: []
  }),
  created() {
    api.getTypes().then(x => {
      this.lTypes = x
    })
  },
  destroyed() {
    // window.removeEventListener('scroll', this.scroll)
  },
  methods: {
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
    guid() {
      return Math.floor(Math.random() * 1000000000000000)
    }
  }
}
</script>
<style lang="scss">
@import './assets/scss/_app';
</style>
