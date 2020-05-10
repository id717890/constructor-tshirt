<template>
  <v-row>
    <v-col
      md="10"
      offset-md="1"
      cols="12"
      class="pa-12"
      style="min-height: 90vh"
    >
      <h2 v-if="album">
        <v-btn to="/albums" text fab class="mr-4">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        "{{ album.name }}"
      </h2>
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
import { mapActions, mapState, mapGetters } from 'vuex'
import moment from 'moment'
import config from '../../init/config'
import ImageSliderDialog from '../../components/Dialog/ImageSlider'
export default {
  mixins: [imageMix],
  props: ['id'],
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
    album(value) {
      if (value && value.images && value.images.length > 0) {
        const l = Math.trunc(value.images.length / this.perPage)
        const ost = value.images.length % this.perPage
        this.length = l
        if (ost !== 0) this.length++
      } else {
        this.length = 1
      }
      this.getData()
    }
  },
  mounted() {
    if (this.album && this.album.images && this.album.images.length > 0) {
      const l = Math.trunc(this.album.images.length / this.perPage)
      const ost = this.album.images.length % this.perPage
      this.length = l
      if (ost !== 0) this.length++
    } else {
      this.length = 1
    }
    this.getData()
  },
  methods: {
    ...mapActions(['getAllAlbums']),
    openImageSlider(image) {
      let images = []
      let buf = [...this.album.images]
      const find = this.album.images.indexOf(image)
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
      if (this.album && this.album.images && this.album.images.length > 0) {
        if (this.page === 1) {
          this.data = this.album.images.slice(0, this.perPage)
        } else {
          const start = (this.page - 1) * this.perPage
          const end = this.perPage * this.page
          this.data = this.album.images.slice(start, end)
        }
      }
    }
  },
  computed: {
    ...mapGetters(['getAlbumById']),
    ...mapState({
      albums: state => state.album.allAlbums
    }),
    album() {
      return this.getAlbumById(this.id)
    }
  }
}
</script>
