<template>
  <v-row no-gutters>
    <v-col cols="12" class="pa-0">
      <v-row v-if="slides">
        <v-col md="10" offset-md="1" cols="12" class="pa-0 pt-3">
          <v-carousel
            :height="slidesHeight"
            hide-delimiters
            class="home-slide"
            :interval="slidesInterval"
            :cycle="true"
          >
            <v-carousel-item
              :src="img(slide.image)"
              v-for="slide in slides"
              :key="slide.id"
            >
              <div class="home-slide__content">
                <div></div>
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
            </v-carousel-item>
            <!-- <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item> -->
          </v-carousel>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="10" offset-md="1" cols="12" class="pa-0 pt-1">
          <v-row>
            <v-col md="6" cols="12" class="pt-2 py-0">
              <v-row>
                <v-col cols="12" class="py-0 pr-3" v-if="slideHomeDiscount">
                  <v-img
                    aspect-ratio="1.6"
                    :src="img(slideHomeDiscount.value)"
                    height="100%"
                    class="home-discount"
                  >
                    <div
                      class="pa-12 h100 w100 d-flex flex-column align-center justify-space-between"
                    >
                      <div
                        v-if="slideHomeDiscountText"
                        v-html="slideHomeDiscountText.value"
                        class="t1 mt-12"
                      ></div>
                      <v-btn
                        dark
                        x-large
                        rounded
                        outlined
                        @click.prevent="designChallengeDialog"
                      >
                        <v-icon class="mr-5">mdi-telegram</v-icon>
                        Отправить заявку
                      </v-btn>
                    </div>
                  </v-img>
                </v-col>
              </v-row>
            </v-col>
            <v-col md="6" cols="12" class="py-0 pt-2 px-0">
              <div
                class="h100 d-flex flex-column justify-space-between"
                v-if="news"
              >
                <v-btn
                  color="#465586"
                  class="w100"
                  outlined
                  @click.prevent="becomeCorrespondentDialog"
                >
                  <v-icon class="mr-4">mdi-lead-pencil</v-icon>
                  Стань нашим корреспондентом</v-btn
                >
                <div class="flex-grow-1 d-flex flex-column">
                  <div
                    class="news-item"
                    v-for="news in news3"
                    :key="news.id"
                    @click="$router.push('/news/' + news.id)"
                    style="cursor: pointer"
                  >
                    <div class="date">
                      <div class="day">{{ getDay(news.created_at) }}</div>
                      <div class="month">
                        {{ getMonthYear(news.created_at) }}
                      </div>
                    </div>
                    <div>
                      <div class="title">
                        {{ news.title }}
                      </div>
                      <div class="text" v-html="news.text"></div>
                    </div>
                  </div>
                </div>

                <v-btn color="#f5a93c" class="w100" outlined to="/news">
                  <v-icon class="mr-4">mdi-newspaper</v-icon>
                  Все новости
                </v-btn>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col md="6" cols="12" class="pt-3">
              <v-carousel
                height="385"
                hide-delimiters
                :interval="7000"
                :cycle="true"
              >
                <v-carousel-item
                  v-for="(discount, index) in discounts"
                  :key="index"
                >
                  <v-img
                    class=" bg-constructor"
                    height="100%"
                    position="center center"
                    :src="img(discount.image)"
                  >
                    <div
                      class="pa-12 d-flex h100 justify-space-between align-center flex-column"
                    >
                      <div class="t1 text-cneter" v-html="discount.title"></div>
                      <v-btn
                        class="px-10"
                        outlined
                        rounded
                        x-large
                        dark
                        to="/discount"
                      >
                        Подробнее
                      </v-btn>
                    </div>
                  </v-img>
                </v-carousel-item>
              </v-carousel>
            </v-col>
            <v-col
              md="6"
              cols="12"
              class="d-flex flex-column align-center justify-center pt-3"
            >
              <!-- <v-row class="flex-grow-0">
                <v-col cols="12">
                  <div class="t3 text-center pt-10">Наши партнеры</div>
                </v-col>
              </v-row> -->
              <v-row>
                <v-col cols="12" class="pa-0">
                  <v-img
                    aspect-ratio="1.5"
                    height="385"
                    class=" bg-constructor"
                    src="~@/assets/img/konstr-bg.jpg"
                  >
                    <div
                      class="w100 h100 d-flex flex-column align-center justify-center pa-6"
                    >
                      <div class="t1 align-self-start">
                        Создай свою форму
                      </div>
                      <div class="t2_1 mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Minima ullam, expedita aliquid eum, iure cumque
                        cum laudantium consectetur itaque
                      </div>
                      <v-btn
                        x-large
                        color="#f5a93c"
                        rounded
                        outlined
                        class="mb-2"
                        to="/constructor"
                      >
                        <img
                          class="mr-3"
                          src="~@/assets/img/toy-brick.png"
                          alt=""
                        />
                        Перейти к конструктору
                      </v-btn>
                      <v-btn large rounded outlined dark>
                        <fai class="mr-3" :icon="['fab', 'youtube']" />
                        Смотреть видеоурок
                      </v-btn>
                    </div>
                  </v-img>
                </v-col>

                <!-- <v-col
                  cols="6"
                  class="d-flex align-center justify-center"
                  style="border-right: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5"
                >
                  <v-img src="~@/assets/img/logo-gb.png"></v-img>
                </v-col>
                <v-col
                  cols="6"
                  class="d-flex align-center justify-center"
                  style="border-bottom: 1px solid #e5e5e5"
                >
                  <v-img src="~@/assets/img/logo-nvd.png"></v-img>
                </v-col>
                <v-col
                  cols="6"
                  class="d-flex align-center justify-center"
                  style="border-right: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5"
                >
                  <v-img src="~@/assets/img/logo-ms.png"></v-img>
                </v-col>
                <v-col
                  cols="6"
                  class="d-flex align-center justify-center"
                  style="border-bottom: 1px solid #e5e5e5"
                >
                  <v-img src="~@/assets/img/logo-google.png"></v-img>
                </v-col>
                <v-col
                  cols="6"
                  class="d-flex align-center justify-center"
                  style="border-right: 1px solid #e5e5e5;"
                >
                  <v-img src="~@/assets/img/logo-asus.png"></v-img>
                </v-col>
                <v-col cols="6" class="d-flex align-center justify-center">
                  <v-img src="~@/assets/img/logo-amd.png"></v-img>
                </v-col> -->
              </v-row>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <div class="t3 text-center pt-10">Наши друзья</div>
              <swiper
                ref="partnerSwiper"
                class="partnerSwiper"
                :options="swiperOptions"
              >
                <swiper-slide
                  v-for="partner in partners"
                  :key="partner.id"
                  class="swiper-element swiper-element__partner"
                >
                  <v-img
                    @click.prevent="openUrlPartner(partner.url)"
                    contain
                    height="100%"
                    aspect-ratio="1.6"
                    :src="img(partner.image)"
                    max-width="370"
                  >
                  </v-img>
                </swiper-slide>
                <!-- Стрелки прокрутки моделей -->
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
              </swiper>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import moment from 'moment'
import imageMixin from '../mixins/image'
import config from '../init/config'
import Correspondent from '../components/Dialog/BecomeCorrestpondent'
import DesignChallengeDialog from '../components/Dialog/DesignChallenge'

export default {
  mixins: [imageMixin],
  data: () => ({
    slidesHeight: 290,
    slidesInterval: 5000,
    news3: [],
    swiperOptions: {
      ...config.swiperOptions,
      autoplay: {
        delay: 5000
      }
    }
  }),
  computed: {
    ...mapGetters(['getConfigByKey']),
    ...mapState({
      partners: state => state.home.allPartners,
      discounts: state => state.discount.allDiscounts,
      news: state => state.news.allNews,
      slides: state => state.home.allHomeSlides
    }),
    slidesIntervalCfg() {
      return this.getConfigByKey('home_slider_interval')
    },
    slidesHeightCfg() {
      return this.getConfigByKey('home_slider_height')
    },
    slideHomeDiscount() {
      return this.getConfigByKey('home_slide_discount')
    },
    slideHomeDiscountText() {
      return this.getConfigByKey('home_slide_discount_text')
    }
  },
  watch: {
    news(value) {
      if (value && value.length > 0) {
        this.news3 = value.slice(0, 3)
      }
    },
    slidesHeightCfg(value) {
      if (value) this.slidesHeight = parseInt(value.value)
    },
    slidesIntervalCfg(value) {
      if (value) this.slidesInterval = parseInt(value.value) * 1000
    }
  },
  mounted() {
    if (this.news && this.news.length > 0) {
      this.news3 = this.news.slice(0, 3)
    }
    if (this.slidesHeightCfg)
      this.slidesHeight = parseInt(this.slidesHeightCfg.value)
    if (this.slidesIntervalCfg)
      this.slidesInterval = parseInt(this.slidesIntervalCfg.value) * 1000
  },
  methods: {
    designChallengeDialog() {
      this.$modal.show(
        DesignChallengeDialog,
        {
          title: this.slideHomeDiscountText
            ? this.slideHomeDiscountText.value
            : ''
        },
        { ...config.modalSettings, clickToClose: true, maxWidth: 400 },
        {}
      )
    },
    openUrlPartner(url) {
      if (url) {
        if (
          !url.toLowerCase().includes('https') ||
          !url.toLowerCase().includes('http')
        ) {
          url = 'https://' + url
        }
        window.open(url, '_blank')
      }
    },
    openUrl(url) {
      if (
        url.toLowerCase().includes('https') ||
        url.toLowerCase().includes('http')
      ) {
        window.open(url, '_blank')
      } else this.$router.push(url)
    },
    becomeCorrespondentDialog() {
      this.$modal.show(
        Correspondent,
        {},
        { ...config.modalSettings, clickToClose: true, maxWidth: 400 },
        {}
      )
    },
    getMonthYear(date) {
      return moment(date).format('MM.YY')
    },
    getDay(date) {
      return moment(date).date()
    }
  }
}
</script>

<style></style>
