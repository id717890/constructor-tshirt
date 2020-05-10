<template>
  <v-row>
    <v-col
      md="10"
      offset-md="1"
      cols="12"
      class="pa-12"
      style="min-height: 90vh"
    >
      <v-pagination :length="length" v-model="page" class="mb-6"></v-pagination>
      <v-row>
        <v-col md="4" cols="12" v-for="item in data" :key="item.id">
          <v-card
            v-if="item.images && item.images.length > 0"
            :to="'/album/' + item.id"
            elevation="0"
            class="card-hover card-photo card-video mb-12 d-flex flex-column"
          >
            <v-img height="260px" :src="img(item.images[0].image)"></v-img>
            <v-card-text class="d-flex flex-grow-1 font-weight-bold">
              {{ item.name }}
              <v-spacer></v-spacer>
              Изображений: {{ item.images.length }}
            </v-card-text>
            <!-- <v-card-text class="news-date">
              {{ date(item.created_at) }}
            </v-card-text> -->
          </v-card>
        </v-col>
      </v-row>

      <v-pagination :length="length" v-model="page" class="mt-6"></v-pagination>
    </v-col>
  </v-row>
</template>

<script>
import imageMix from '../../mixins/image'
import { mapActions, mapState } from 'vuex'
import moment from 'moment'
import config from '../../init/config'
import ImageSliderDialog from '../../components/Dialog/ImageSlider'
export default {
  mixins: [imageMix],
  data: () => ({
    length: 1,
    page: 1,
    perPage: 12,
    data: []
  }),
  async created() {
    this.getAllAlbums()
  },
  watch: {
    page(value) {
      this.getData()
    },
    albums(value) {
      if (value && value.length > 0) {
        const l = Math.trunc(value.length / this.perPage)
        const ost = value.length % this.perPage
        this.length = l
        if (ost !== 0) this.length++
      } else {
        this.length = 1
      }
      this.getData()
    }
  },
  mounted() {
    if (this.albums && this.albums.length > 0) {
      const l = Math.trunc(this.albums.length / this.perPage)
      const ost = this.albums.length % this.perPage
      this.length = l
      if (ost !== 0) this.length++
    } else {
      this.length = 1
    }
    this.getData()
  },
  methods: {
    ...mapActions(['getAllAlbums']),
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
      if (this.albums && this.albums.length > 0) {
        if (this.page === 1) {
          this.data = this.albums.slice(0, this.perPage)
        } else {
          const start = (this.page - 1) * this.perPage
          const end = this.perPage * this.page
          this.data = this.albums.slice(start, end)
        }
      }
    }
  },
  computed: {
    ...mapState({
      albums: state => state.album.allAlbums
    })
  }
}
</script>
