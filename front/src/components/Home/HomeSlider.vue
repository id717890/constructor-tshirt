<template>
  <v-row>
    <v-col cols="12">
      <v-card class="pa-1">
        <v-carousel v-if="slides" :height="slidesHeight" hide-delimiters>
          <v-carousel-item
            class="home-slide"
            v-for="slide in slides"
            :key="slide.id"
          >
            <v-img
              :src="img(slide.image)"
              v-if="slide.type === 'image'"
              height="100%"
            >
              <div class="home-slide__content">
                <div>
                  <v-btn
                    fab
                    text
                    title="Редакитровать"
                    color="primary"
                    :to="'/lk/home/slide/edit/' + slide.id"
                  >
                    <v-icon>mdi-pen</v-icon>
                  </v-btn>
                  <v-btn
                    color="error"
                    fab
                    text
                    @click.prevent="deleteItem(slide)"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </div>
                <div class="text-center">
                  <v-btn
                    v-if="slide.url"
                    color="warning"
                    large
                    outlined
                    target="_blank"
                    @click.prevent="openUrl(slide.url)"
                  >
                    Подробнее
                  </v-btn>
                </div>
              </div>
            </v-img>
            <div v-else>
              <div v-html="slide.iframe"></div>
              <div style="position: absolute; top: 0" class="">
                <div class="home-slide__content">
                  <div>
                    <v-btn
                      fab
                      text
                      title="Редакитровать"
                      color="primary"
                      :to="'/lk/home/slide/edit/' + slide.id"
                    >
                      <v-icon>mdi-pen</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      fab
                      text
                      @click.prevent="deleteItem(slide)"
                    >
                      <v-icon>mdi-delete</v-icon>
                    </v-btn>
                  </div>
                  <!-- <div class="text-center">
                    <v-btn
                      v-if="slide.url"
                      color="warning"
                      large
                      outlined
                      target="_blank"
                      @click.prevent="openUrl(slide.url)"
                    >
                      Подробнее
                    </v-btn>
                  </div> -->
                </div>
              </div>
            </div>
          </v-carousel-item>
        </v-carousel>
        <v-row>
          <v-col cols="12" lg="3" md="4" sm="12" class="d-flex">
            <v-btn color="primary" class="ma-4" to="/lk/home/slide/create">
              <v-icon>mdi-plus</v-icon>
              Добавить слайд
            </v-btn>
            <v-text-field
              class="flex-shrink-0 ma-3"
              type="number"
              v-model="slidesHeight"
              label="Высота слайдера"
              outlined
            ></v-text-field>
            <v-text-field
              class="flex-shrink-0 ma-3"
              type="number"
              v-model="slidesInterval"
              label="Интервал"
              outlined
            ></v-text-field>
            <v-btn
              @click.prevent="saveConfig"
              class="mt-1"
              fab
              text
              x-large
              color="success"
              title="Сохранить высоту"
            >
              <v-icon>mdi-content-save</v-icon>
            </v-btn>
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
    slidesHeight: 290,
    slidesInterval: 5,
    removedItem: null
  }),
  methods: {
    ...mapActions([
      'setConfig',
      'getAllHomeSlides',
      'resetConfirmDialogResult',
      'deleteHomeSlide'
    ]),
    guid() {
      return Math.floor(Math.random() * 1000000000000000)
    },
    saveConfig(cfg) {
      this.setConfig({ key: 'home_slider_height', value: this.slidesHeight })
      this.setConfig({
        key: 'home_slider_interval',
        value: this.slidesInterval
      })
    },
    openUrl(url) {
      if (
        url.toLowerCase().includes('https') ||
        url.toLowerCase().includes('http')
      ) {
        window.open(url, '_blank')
      } else this.$router.push(url)
    },
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        config.modalSettings,
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deleteHomeSlide(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapGetters(['getConfigByKey']),
    ...mapState({
      slides: state => state.home.allHomeSlides,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    }),
    slidesHeightCfg() {
      return this.getConfigByKey('home_slider_height')
    },
    slidesIntervalCfg() {
      return this.getConfigByKey('home_slider_interval')
    }
  },
  async created() {
    await this.getAllHomeSlides()
  },
  mounted() {
    if (this.slidesHeightCfg)
      this.slidesHeight = parseInt(this.slidesHeightCfg.value)
    if (this.slidesIntervalCfg)
      this.slidesInterval = parseInt(this.slidesIntervalCfg.value)
  },
  watch: {
    slidesHeightCfg(value) {
      if (value) this.slidesHeight = parseInt(value.value)
    },
    slidesIntervalCfg(value) {
      if (value) this.slidesInterval = parseInt(value.value)
    }
  }
}
</script>
