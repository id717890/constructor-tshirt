<template>
  <v-row>
    <v-col cols="12">
      <v-card class="pa-1">
        <v-card-title>
          Изображение акции
        </v-card-title>
        <v-row>
          <v-col
            cols="12"
            lg="6"
            offset-lg="3"
            md="10"
            offset-md="1"
            sm="12"
            class="text-center"
          >
            <div v-if="homeDiscount">
              <img
                :src="img(homeDiscount)"
                style="width: 100%; border-radius: 5px"
              />
            </div>
            <v-btn
              color="red"
              dark
              class="ma-4"
              @click="$refs.fileHomeDiscount.click()"
            >
              <v-icon class="mr-3">mdi-image</v-icon>
              Загрузить изображение акции
            </v-btn>
            <v-btn
              @click.prevent="saveHomeDiscount"
              class="mt-1"
              fab
              text
              x-large
              color="success"
              title="Сохранить высоту"
            >
              <v-icon>mdi-content-save</v-icon>
            </v-btn>
            <input
              style="display: none"
              ref="fileHomeDiscount"
              type="file"
              @change="uploadHomeDiscount"
            />
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import config from '../../init/config'
import imageMixin from '../../mixins/image'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  mixins: [imageMixin],
  data: () => ({
    homeDiscount: null
  }),
  methods: {
    ...mapActions(['updateDiscountSlide', 'uploadImage']),
    saveHomeDiscount() {
      if (this.homeDiscount)
        this.updateDiscountSlide({
          key: 'home_slide_discount',
          value: this.homeDiscount
        })
    },
    uploadHomeDiscount(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'home-discount-')
      this.uploadImage(fd).then(x => {
        this.homeDiscount = x.fullname
      })
    }
  },
  computed: {
    ...mapGetters(['getConfigByKey']),
    slideHomeDiscount() {
      return this.getConfigByKey('home_slide_discount')
    }
  },
  mounted() {
    if (this.slideHomeDiscount) this.homeDiscount = this.slideHomeDiscount.value
  },
  watch: {
    slideHomeDiscount(value) {
      if (value) this.homeDiscount = value.value
    }
  }
}
</script>
