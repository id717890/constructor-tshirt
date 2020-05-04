<template>
  <v-row>
    <v-col
      lg="6"
      offset-lg="3"
      md="8"
      offset-md="2"
      cols="12"
      style="min-height: 80vh"
    >
      <v-row>
        <v-col
          cols="12"
          class="d-flex flex-row flex-wrap justify-space-between"
          v-if="videos"
        >
          <v-pagination
            :length="length"
            v-model="page"
            class="mb-6"
          ></v-pagination>
          <v-row>
            <v-col md="6" cols="12" v-for="item in data" :key="item.id">
              <v-card
                elevation="0"
                class="card-hover card-video mb-12 d-flex flex-column"
              >
                <div class="video-wrapper" v-html="item.text"></div>
                <v-card-text class="d-flex flex-grow-1 font-weight-bold">
                  {{ item.title }}
                </v-card-text>
                <v-card-text class="news-date">
                  {{ date(item.created_at) }}
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
import { mapState, mapActions } from 'vuex'
import moment from 'moment'

export default {
  data: () => ({
    length: 1,
    page: 1,
    perPage: 8,
    data: []
  }),
  async created() {
    this.getAllVideos()
  },
  methods: {
    ...mapActions(['getAllVideos']),
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
      if (this.videos && this.videos.length > 0) {
        if (this.page === 1) {
          this.data = this.videos.slice(0, this.perPage)
        } else {
          const start = (this.page - 1) * this.perPage
          const end = this.perPage * this.page
          this.data = this.videos.slice(start, end)
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
    // const l = Math.trunc(this.total / this.perPage)
    // const ost = this.total % this.perPage
    // this.length = l
    // if (ost !== 0) this.length++
    setTimeout(() => {
      if (this.videos && this.videos.length > 0) {
        const l = Math.trunc(this.videos.length / this.perPage)
        const ost = this.videos.length % this.perPage
        this.length = l
        if (ost !== 0) this.length++
      } else {
        this.length = 1
      }
      this.getData()
    }, 800)
  },
  computed: {
    ...mapState({
      videos: state => state.video.allVideos
    })
  }
}
</script>
