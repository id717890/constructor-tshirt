<template>
  <v-row>
    <v-col md="10" offset-md="1" cols="12">
      <v-row>
        <v-col
          cols="12"
          class="d-flex flex-row flex-wrap justify-space-between"
          v-if="news"
        >
          <v-pagination
            :length="length"
            v-model="page"
            class="mb-6"
          ></v-pagination>
          <v-card
            :to="'/news/' + item.id"
            v-for="item in data"
            :key="item.id"
            width="260"
            elevation="0"
            class="card-hover card-news mr-6 mb-6 d-flex flex-column"
          >
            <v-img
              height="260px"
              aspect-ratio="1.6"
              :src="img(item.image)"
              class="align-end white--text image-text"
            >
            </v-img>
            <v-card-text class="d-flex flex-grow-1 font-weight-bold">
              {{ item.title }}
            </v-card-text>
            <v-card-text class="news-date">
              {{ date(item.created_at) }}
            </v-card-text>
          </v-card>
          <v-pagination
            :length="length"
            v-model="page"
            class="mt-6"
          ></v-pagination>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapState } from 'vuex'
import imageMix from '../../mixins/image'
import config from '../../init/config'
import UseDiscountDialog from '../Dialog/UseDiscount'
import moment from 'moment'

export default {
  mixins: [imageMix],
  data: () => ({
    length: 1,
    page: 1,
    perPage: 9,
    data: []
  }),
  methods: {
    date(value) {
      moment.locale('ru')
      return (
        moment(value).format('DD') +
        ' ' +
        moment(value).format('MMMM') +
        ' ' +
        moment(value).format('YYYY')
      )
    },
    getData() {
      if (this.news && this.news.length > 0) {
        if (this.page === 1) {
          this.data = this.news.slice(0, this.perPage)
        } else {
          const start = (this.page - 1) * this.perPage
          const end = this.perPage * this.page
          this.data = this.news.slice(start, end)
        }
      }
    }
  },
  watch: {
    page(value) {
      this.getData()
    }
  },
  mounted() {
    if (this.news && this.news.length > 0) {
      const l = Math.trunc(this.news.length / this.perPage)
      const ost = this.news.length % this.perPage
      this.length = l
      if (ost !== 0) this.length++
    } else {
      this.length = 1
    }
    this.getData()
  },
  computed: {
    ...mapState({
      news: state => state.news.allNews
    })
  }
}
</script>

<style></style>
