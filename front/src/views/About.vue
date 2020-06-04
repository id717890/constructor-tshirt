<template>
  <v-row>
    <v-col md="10" offset-md="1" sm="12" cols="12" style="min-height: 90vh">
      <v-card height="100%" flat v-if="about">
        <v-card-title>
          <h2 class="mb-6">{{ about.title }}</h2>
        </v-card-title>
        <v-card-text class="title page text-justify" v-html="about.content">
        </v-card-text>
        <v-card-title
          v-if="images && images.length > 0"
          class=" justify-center"
        >
          <h2 class="mb-6">
            СЕРТИФИКАТЫ, ДИПЛОМЫ, БЛАГОДАРСТВЕННЫЕ ПИСЬМА
          </h2>
        </v-card-title>
        <v-card-text
          v-if="images"
          class="d-flex justify-center flex-row flex-wrap"
        >
          <div class="about-image-item" v-for="image in images" :key="image.id">
            <v-img
              @click="openImageSlider(image)"
              :src="img(image.image)"
            ></v-img>
          </div>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions, mapState } from 'vuex'
import iamgeMixin from '../mixins/image'
import config from '../init/config'
import ImageSliderDialog from '../components/Dialog/ImageSlider2'
export default {
  mixins: [iamgeMixin],
  data: () => ({
    aboutId: 1
  }),
  computed: {
    ...mapGetters(['getPageById']),
    ...mapState({
      images: state => state.about.allAboutImages
    }),
    about() {
      return this.getPageById(this.aboutId)
    }
  },
  methods: {
    ...mapActions(['getAllAboutImages']),
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
          width: '100%',
          height: '100%',
          clickToClose: true
        }
      )
    }
  },
  async created() {
    await this.getAllAboutImages()
  }
}
</script>
