<template>
  <v-row>
    <v-col
      lg="6"
      offset-lg="3"
      md="8"
      offset-md="2"
      cols="12"
      class="pa-12"
      style="min-height: 90vh"
    >
      <v-pagination :length="length" v-model="page" class="mb-6"></v-pagination>
      <v-row>
        <v-col md="4" cols="12" v-for="item in data" :key="item.id">
          <v-card
            @click.prevent="openImageSlider(item)"
            elevation="0"
            class="card-hover card-photo card-video mb-12 d-flex flex-column"
          >
            <v-img :src="img(item.image)"></v-img>
            <v-card-text class="d-flex flex-grow-1 font-weight-bold">
              {{ item.title }}
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
    this.getAllPhotos()
  },
  watch: {
    page(value) {
      this.getData()
    }
  },
  mounted() {
    setTimeout(() => {
      if (this.images && this.images.length > 0) {
        const l = Math.trunc(this.images.length / this.perPage)
        const ost = this.images.length % this.perPage
        this.length = l
        if (ost !== 0) this.length++
      } else {
        this.length = 1
      }
      this.getData()
    }, 800)
  },
  methods: {
    ...mapActions(['getAllPhotos']),
    openImageSlider(image) {
      let images = []
      let buf = [...this.images]
      const find = this.images.indexOf(image)
      if (find !== -1) {
        buf.splice(find, 1)
        images = [image, ...buf]
      }
      this.$modal.show(
        ImageSliderDialog,
        { images: images },
        {
          ...config.modalSettings,
          maxWidth: 800,
          clickToClose: true
        }
      )
    },
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
      if (this.images && this.images.length > 0) {
        if (this.page === 1) {
          this.data = this.images.slice(0, this.perPage)
        } else {
          const start = (this.page - 1) * this.perPage
          const end = this.perPage * this.page
          this.data = this.images.slice(start, end)
        }
      }
    }
  },
  computed: {
    ...mapState({
      images: state => state.photo.allPhotos
    })
  }
}
</script>
