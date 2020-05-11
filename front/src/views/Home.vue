<template>
  <v-row no-gutters>
    <v-col cols="12" class="pa-0">
      <v-row v-if="slides">
        <v-col md="10" offset-md="1" cols="12" class="pa-0 pt-1">
          <v-carousel height="290" hide-delimiters class="home-slide">
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
            <v-col md="6" cols="12" class=" py-0">
              <v-row>
                <v-col cols="6" class="py-0 pr-1">
                  <v-img
                    aspect-ratio="1.6"
                    src="~@/assets/img/konkurs-img.jpg"
                    height="100%"
                  ></v-img>
                </v-col>
                <v-col cols="6" class=" d-flex flex-column py-0">
                  <v-row>
                    <v-col cols="12" class="py-0 pl-0">
                      <!-- <img
                        src="~@/assets/img/konkurs-img2.jpg"
                        alt=""
                        style="height: 100%"
                      /> -->
                      <v-img
                        aspect-ratio="1.6"
                        height="auto"
                        src="~@/assets/img/konkurs-img2.jpg"
                      ></v-img>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="12" class="py-0 pl-0 ">
                      <!-- <img
                        src="~@/assets/img/konkurs-img2.jpg"
                        alt=""
                        style="height: 100%"
                      /> -->

                      <v-img
                        aspect-ratio="1.6"
                        height="auto"
                        src="~@/assets/img/konkurs-img2.jpg"
                      ></v-img>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-col>
            <v-col md="6" cols="12" class="py-0">
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
                <div
                  class="news-item"
                  v-for="news in news3"
                  :key="news.id"
                  @click="$router.push('/news/' + news.id)"
                  style="cursor: pointer"
                >
                  <div class="date">
                    <div class="day">{{ getDay(news.created_at) }}</div>
                    <div class="month">{{ getMonthYear(news.created_at) }}</div>
                  </div>
                  <div>
                    <div class="title">
                      {{ news.title }}
                    </div>
                    <div class="text" v-html="news.text"></div>
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
            <v-col md="6" cols="12" class="pt-1">
              <v-carousel
                height="auto"
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
                    <div class="d-flex h100 align-end justify-center">
                      <v-btn
                        class="mb-10 px-10"
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
              <v-img
                aspect-ratio="1.5"
                height="290"
                class="mt-1 bg-constructor"
                src="~@/assets/img/konstr-bg.jpg"
              >
                <div class="w100 d-flex flex-column align-center pa-6  ">
                  <div class="t1 align-self-start">
                    Создай свою форму
                  </div>
                  <div class="t2_1 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Minima ullam, expedita aliquid eum, iure cumque cum
                    laudantium consectetur itaque
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
            <v-col
              md="6"
              cols="12"
              class="d-flex flex-column align-center justify-center"
            >
              <v-row class="flex-grow-0">
                <v-col cols="12">
                  <div class="t3 text-center pt-10">Наши партнеры</div>
                </v-col>
              </v-row>
              <v-row>
                <v-col
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
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapState } from 'vuex'
import moment from 'moment'
import imageMixin from '../mixins/image'
import config from '../init/config'
import Correspondent from '../components/Dialog/BecomeCorrestpondent'

export default {
  mixins: [imageMixin],
  data: () => ({
    news3: []
  }),
  computed: {
    ...mapState({
      discounts: state => state.discount.allDiscounts,
      news: state => state.news.allNews,
      slides: state => state.home.allHomeSlides
    })
  },
  watch: {
    news(value) {
      if (value && value.length > 0) {
        this.news3 = value.slice(0, 3)
      }
    }
  },
  mounted() {
    // setTimeout(() => {
    //   if (this.news && this.news.length > 0) {
    //     this.news3 = this.news.slice(0, 3)
    //   }
    // }, 800)
  },
  methods: {
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
