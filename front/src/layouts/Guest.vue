<template>
  <v-app id="app" dark style="background: white">
    <v-container fluid class="pa-0">
      <v-row no-gutters class="header">
        <v-col md="10" offset-md="1" sm="12" cols="12">
          <v-row>
            <v-col class="header-row">
              <img class="logo" src="~@/assets/img/logo3.png" alt="" />
              <!-- <div class="phone">
                  8(800)123-45-67
                </div> -->
              <div>
                <div class="t7">
                  <v-icon>mdi-clock-outline</v-icon>
                  с 8:00 - 20:00
                </div>
                <div class="t7">заявки круглосуточно</div>
              </div>

              <!-- <div class="t2">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea
                doloremque facilis quasi molestias veniam cupiditate sit a
                excepturi? Ex, tempore saepe. Dolorem, impedit ratione? Ut in
                modi minus perspiciatis nulla?
              </div> -->

              <div>
                <!-- <div class="t7">
                  <v-icon>mdi-phone</v-icon>
                  +7 (495) 123-456-6 (Москва)
                </div> -->
                <a href="tel:+79672192444">
                  <div class="t7">
                    <v-icon>mdi-cellphone</v-icon>
                    +7 (967) 21-92-444 (Москва)
                  </div>
                </a>
                <!-- <div class="t7">
                  <v-icon>mdi-cellphone</v-icon>
                  +7 (495) 123-456-6 (Волгоград)
                </div> -->
              </div>

              <div>
                <a href="#" @click.prevent="addressMapDialog">
                  <div class="" style="font-family: 'PTSans'">
                    <v-icon>mdi-map-marker</v-icon>
                    г.Москва, ул.Краснобогатырская 89, стр.5
                  </div>
                </a>
                <!-- <div class="t7">
                  <v-icon>mdi-map-marker</v-icon>
                  г.Москва, 2-й Кабельный пр. 2А стр. 45
                </div>-->
                <a href="mailto:info@joma-club.ru">
                  <div class="t7">
                    <v-icon>mdi-email</v-icon>
                    info@joma-club.ru
                  </div>
                </a>
              </div>

              <div>
                <!-- <v-btn
                  class="btn-social mr-1 pa-0"
                  dark
                  color="#4a76a8"
                  width="45"
                  height="45"
                  :elevation="1"
                  target="_blank"
                  @click="openUrl('https://www.vk.com')"
                  ><i class="fab fa-vk"></i
                ></v-btn>
                <v-btn
                  width="45"
                  height="45"
                  class="btn-social mr-1"
                  dark
                  color="#3b5998"
                  :elevation="1"
                  @click="openUrl('https://facebook.com')"
                >
                  <fai :icon="['fab', 'facebook-f']" />
                </v-btn>
                <v-btn
                  width="45"
                  height="45"
                  class="btn-social mr-1"
                  dark
                  color="#00aeed"
                  @click="openUrl('https://twitter.com')"
                  :elevation="1"
                >
                  <fai :icon="['fab', 'twitter']" />
                </v-btn> -->
                <!-- <v-btn
                height="45"
                class="pdf-catalog btn-j mr-1"
                dark
                @click="downloadCatalog"
              >
                <v-icon>mdi-download</v-icon>
                Скачать каталог в PDF
              </v-btn> -->
                <v-btn
                  height="45"
                  class="btn-social"
                  color="warning"
                  outlined
                  @click.prevent="callMeDialog"
                >
                  <v-icon class="mr-2">mdi-phone</v-icon>
                  Заказать звонок
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" class="menu pa-0">
          <router-link
            to="/constructor"
            class="d-flex flex-column item cogs"
            :class="{ 'cogs-active': isActive('/constructor') }"
          >
            <v-icon dark>mdi-cogs</v-icon>
            <span class="text-center">Конструктор</span>
          </router-link>
          <router-link
            :to="item.url"
            v-for="(item, index) in menu"
            :key="index"
            class="d-flex flex-column item"
            :class="{ active: isActive(item.url) }"
          >
            <v-icon dark>{{ item.icon }}</v-icon>
            <span class="text-center" v-html="item.title"></span>
          </router-link>
          <router-link to="/catalogs" class="d-flex flex-column item">
            <v-icon dark>mdi-download</v-icon>
            <span class="text-center">
              Скачать каталог - <br />
              Цена - Склад</span
            >
          </router-link>
          <router-link to="/lk" class="d-flex flex-column item" v-if="isAuth">
            <v-icon dark>mdi-cogs</v-icon>
            <span class="text-center">ЛК</span>
          </router-link>
        </v-col>
      </v-row>
      <transition name="router-fade" mode="out-in">
        <router-view name="guest"></router-view>
      </transition>
      <v-row class="footer">
        <v-col md="10" offset-md="1" sm="12" cols="12">
          <v-row>
            <v-col cols="3" class="d-flex align-center">
              <img class="logo" src="~@/assets/img/logo3.png" alt="" />
            </v-col>
            <v-col cols="2" class="d-flex flex-column justify-space-between">
              <router-link
                class="footer-link"
                to="/constructor"
                color="#fb8c00"
              >
                Конструктор
              </router-link>
              <router-link
                v-for="(item, index) in menu"
                :key="index"
                class="footer-link"
                :to="item.url"
                >{{ item.title }}</router-link
              >
            </v-col>
            <v-col cols="5">
              <div class="white--text mb-6">
                <div class="t7">
                  <v-icon color="#cdcdcd">mdi-clock-outline</v-icon>
                  с 8:00 - 20:00
                </div>
              </div>
              <div class="white--text mb-6">
                <a href="tel:+79672192444">
                  <div class="t7">
                    <v-icon color="#cdcdcd">mdi-phone</v-icon>
                    +7 (967) 21-92-444 (Москва)
                  </div>
                </a>
                <!-- <div class="t7">
                  <v-icon>mdi-cellphone</v-icon>
                  +7 (495) 123-456-6 (Москва)
                </div>
                <div class="t7">
                  <v-icon>mdi-cellphone</v-icon>
                  +7 (495) 123-456-6 (Волгоград)
                </div> -->
              </div>
              <div class="white--text">
                <!-- <div class="t7">
                  <v-icon>mdi-map-marker</v-icon>
                  г.Москва, 2-й Кабельный пр. 2А стр. 45
                </div> -->
                <a href="#" @click.prevent="addressMapDialog">
                  <div class="t7">
                    <v-icon color="#cdcdcd">mdi-map-marker</v-icon>
                    г.Москва, ул.Краснобогатырская 89, стр.5
                  </div>
                </a>

                <a href="mailto:info@joma-club.ru">
                  <div class="t7">
                    <v-icon color="#cdcdcd">mdi-email</v-icon>
                    info@joma-club.ru
                  </div>
                </a>
              </div>
              <!-- <div class="t4">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Mollitia fugiat quae suscipit dignissimos accusamus.
                Reprehenderit eveniet, ipsum laboriosam nostrum quas asperiores
                cumque nesciunt vitae? Totam ipsum eligendi veniam nisi autem?
              </div> -->
            </v-col>
            <v-col cols="2">
              <div class="t5 mb-5">Мы в соцсетях</div>
              <div>
                <v-btn
                  class="btn-social mr-1 pa-0"
                  dark
                  color="#4a76a8"
                  width="45"
                  height="45"
                  :elevation="1"
                  @click="openUrl('https://www.vk.com')"
                  ><i class="fab fa-vk"></i
                ></v-btn>
                <v-btn
                  width="45"
                  height="45"
                  class="btn-social mr-1"
                  dark
                  color="#3b5998"
                  @click="openUrl('https://facebook.com')"
                  :elevation="1"
                >
                  <fai :icon="['fab', 'facebook-f']" />
                </v-btn>
                <v-btn
                  width="45"
                  height="45"
                  class="btn-social mr-1"
                  dark
                  color="#00aeed"
                  :elevation="1"
                  @click="openUrl('https://twitter.com')"
                >
                  <fai :icon="['fab', 'twitter']" />
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import Vue from 'vue'
import context from '../api/api'
import config from '../init/config'
import CallMeDialog from '../components/Dialog/CallDialog'
import AddressMapDialog from '../components/Dialog/AddressMap'
import { mapGetters } from 'vuex'
export default {
  data: () => ({
    menu: [
      { icon: 'mdi-home', title: 'Главная', url: '/' },
      { icon: 'mdi-information', title: 'О компании', url: '/about' },
      { icon: 'mdi-image-multiple', title: 'Фотогалерея', url: '/albums' },
      { icon: 'mdi-video', title: 'Видеогалерея', url: '/videos' },
      { icon: 'mdi-sale', title: 'Акции', url: '/discount' },
      {
        icon: 'mdi-message-outline',
        title: 'Отзывы и пожелания',
        url: '/feedbacks'
      },
      { icon: 'mdi-help-circle', title: 'Вопрос-ответ', url: '/faq' }
    ]
  }),
  methods: {
    addressMapDialog() {
      this.$modal.show(
        AddressMapDialog,
        {},
        {
          ...config.modalSettings,
          clickToClose: true,
          width: '100%',
          height: '100%'
        },
        {}
      )
    },
    callMeDialog() {
      this.$modal.show(
        CallMeDialog,
        {},
        { ...config.modalSettings, clickToClose: true, maxWidth: 400 },
        {}
      )
    },
    openUrl(url) {
      window.open(url, '_blank')
    },
    downloadCatalog() {
      context
        .post('api/export/catalog', null, {
          // 'content-type': 'application/vnd.ms-excel;charset=UTF-8',
          responseType: 'blob'
        })
        .then(x => {
          console.log(x)
          let fileUrl = window.URL.createObjectURL(new Blob([x]))
          let fileLink = document.createElement('a')
          fileLink.href = fileUrl
          fileLink.setAttribute('download', 'catalog.pdf')
          document.body.appendChild(fileLink)
          fileLink.click()
          fileLink.remove()
        })
    },
    isActive(path) {
      return path === this.$route.path
    }
  },
  computed: {
    isAuth() {
      let credetnrials = Vue.auth.getCredentials()
      if (credetnrials === null || credetnrials === undefined) return false
      return true
    }
  }
}
</script>

<style></style>
