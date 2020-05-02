<template>
  <v-row>
    <v-col lg="6" offset-lg="3" md="8" offset-md="2" cols="12">
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
          <v-row>
            <v-col md="6" cols="12" v-for="i in perPage" :key="i">
              <v-card
                elevation="0"
                class="card-hover card-video mb-12 d-flex flex-column"
              >
                <iframe
                  width="100%"
                  height="315"
                  src="https://www.youtube.com/embed/DZZwZ5KEiI4"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
                <v-card-text class="d-flex flex-grow-1 font-weight-bold">
                  {{ title }}
                </v-card-text>
                <v-card-text class="news-date">
                  {{ date(dt) }}
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>

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
import moment from 'moment'

export default {
  data: () => ({
    length: 1,
    page: 1,
    perPage: 9,
    data: [],
    title: "urope's borders and coronavirus - BBC News",
    dt: '2020-01-01',
    total: 30
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
    const l = Math.trunc(this.total / this.perPage)
    const ost = this.total % this.perPage
    this.length = l
    if (ost !== 0) this.length++
    // if (this.news && this.news.length > 0) {
    //   const l = Math.trunc(this.news.length / this.perPage)
    //   const ost = this.news.length % this.perPage
    //   this.length = l
    //   if (ost !== 0) this.length++
    // } else {
    //   this.length = 1
    // }
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
