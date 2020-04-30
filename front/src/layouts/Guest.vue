<template>
  <v-app id="app" dark style="background: white">
    <v-container fluid class="pa-0">
      <v-row no-gutters class="header">
        <v-col md="8" offset-md="2" sm="12" cols="12">
          <v-row>
            <v-col cols="2">
              <div>
                <img class="logo" src="~@/assets/img/logo.png" alt="" />
                <div class="phone">
                  8(800)123-45-67
                </div>
              </div>
            </v-col>
            <v-col cols="4">
              <div class="t2">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea
                doloremque facilis quasi molestias veniam cupiditate sit a
                excepturi? Ex, tempore saepe. Dolorem, impedit ratione? Ut in
                modi minus perspiciatis nulla?
              </div>
            </v-col>
            <v-col cols="6" class="d-flex flex-row flex-nowrap align-center">
              <v-btn
                class="btn-social mr-1 pa-0"
                dark
                color="#4a76a8"
                width="45"
                height="45"
                :elevation="1"
                ><i class="fab fa-vk"></i
              ></v-btn>
              <v-btn
                width="45"
                height="45"
                class="btn-social mr-1"
                dark
                color="#3b5998"
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
              >
                <fai :icon="['fab', 'twitter']" />
              </v-btn>
              <v-btn height="45" class="pdf-catalog btn-j mr-1" dark>
                <v-icon>mdi-download</v-icon>
                Скачать каталог в PDF
              </v-btn>
              <v-btn height="45" class="btn-social" color="warning" outlined
                >Оставить заявку</v-btn
              >
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" class="menu pa-0">
          <router-link
            :to="item.url"
            v-for="(item, index) in menu"
            :key="index"
            class="d-flex flex-column item"
            :class="{ active: isActive(item.url) }"
          >
            <v-icon dark>{{ item.icon }}</v-icon>
            <span class="text-center">{{ item.title }}</span>
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
        <v-col md="8" offset-md="2" sm="12" cols="12">
          <v-row>
            <v-col cols="3" class="d-flex align-center">
              <img class="" src="~@/assets/img/logo2.png" alt="" />
            </v-col>
            <v-col cols="3" class="d-flex flex-column">
              <router-link
                v-for="(item, index) in menu"
                :key="index"
                class="footer-link"
                :to="item.url"
                >{{ item.title }}</router-link
              >
            </v-col>
            <v-col cols="3">
              <div class="t4">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Mollitia fugiat quae suscipit dignissimos accusamus.
                Reprehenderit eveniet, ipsum laboriosam nostrum quas asperiores
                cumque nesciunt vitae? Totam ipsum eligendi veniam nisi autem?
              </div>
            </v-col>
            <v-col cols="3">
              <div class="t5 mb-5">Мы в соцсетях</div>
              <div>
                <v-btn
                  class="btn-social mr-1 pa-0"
                  dark
                  color="#4a76a8"
                  width="45"
                  height="45"
                  :elevation="1"
                  ><i class="fab fa-vk"></i
                ></v-btn>
                <v-btn
                  width="45"
                  height="45"
                  class="btn-social mr-1"
                  dark
                  color="#3b5998"
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
import { mapGetters } from 'vuex'
export default {
  data: () => ({
    menu: [
      { icon: 'mdi-home', title: 'Главная', url: '/' },
      { icon: 'mdi-information', title: 'О компании', url: '/about' },
      { icon: 'mdi-image-multiple', title: 'Фотогалерея', url: '/photos' },
      { icon: 'mdi-video', title: 'Видеогалерея', url: '/videos' },
      {
        icon: 'mdi-message-outline',
        title: 'Отзывы и пожелания',
        url: '/feedbacks'
      },
      { icon: 'mdi-help-circle', title: 'Вопрос-ответ', url: '/faq' }
    ]
  }),
  methods: {
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
