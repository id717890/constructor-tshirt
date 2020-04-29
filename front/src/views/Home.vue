<template>
  <v-row no-gutters>
    <v-col cols="12" class="pa-0">
      <v-row>
        <v-col md="8" offset-md="2" cols="12" class="pa-0 pt-1">
          <v-carousel height="290" hide-delimiters>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="8" offset-md="2" cols="12" class="pa-0 pt-1">
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
            <v-col md="6" cols="12">
              <div class="h100 d-flex flex-column justify-space-between">
                <v-btn color="#465586" class="w100" outlined>
                  <v-icon class="mr-4">mdi-lead-pencil</v-icon>
                  Стань нашим корреспондентом</v-btn
                >
                <div class="news-item" v-for="i in 3" :key="i">
                  <div class="date">
                    <div class="day">{{ i * 3 }}</div>
                    <div class="month">04.20</div>
                  </div>
                  <div>
                    <div class="title">
                      Lorem ipsum dolor sit amet
                    </div>
                    <div class="text">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do Lorem ipsum dolor sit amet, consectetur adipiscing
                      elit, sed do Lorem ipsum dolor sit amet, consectetur
                      adipiscing elit, sed do Lorem ipsum dolor sit amet,
                      consectetur adipiscing elit, sed doLorem ipsum dolor sit
                      amet, consectetur adipiscing elit, sed do Lorem ipsum
                      dolor sit amet, consectetur adipiscing elit, sed doLorem
                      ipsum dolor sit amet, consectetur adipiscing elit, sed do
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                      sed do
                    </div>
                  </div>
                </div>
                <v-btn color="#f5a93c" class="w100" outlined>
                  <v-icon class="mr-4">mdi-newspaper</v-icon>
                  Все новости
                </v-btn>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col md="6" cols="12" class="pt-1">
              <v-carousel
                height="390"
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
                height="262"
                class="mt-1 bg-constructor"
                src="~@/assets/img/konstr-bg.jpg"
              >
                <div class="w100 d-flex flex-column align-center pa-6 ">
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
import config from '../init/config'
import { mapState } from 'vuex'
export default {
  computed: {
    ...mapState({
      discounts: state => state.discount.allDiscounts
    })
  },
  methods: {
    img(url) {
      return config.apiAddress + 'api/image/' + url
    }
  }
}
</script>

<style></style>
