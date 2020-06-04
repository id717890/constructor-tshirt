<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app permanent dark>
      <v-list dense>
        <v-list-item link to="/">
          <v-list-item-action>
            <v-icon small>mdi-cogs</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Конструктор</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/types">
          <v-list-item-action>
            <v-icon small>mdi-tshirt-v</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Типы футболок</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/models">
          <v-list-item-action>
            <v-icon small>mdi-tshirt-crew</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Модели</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <!-- <v-list-item link to="/lk/colors">
          <v-list-item-action>
            <v-icon>mdi-palette</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Цвета</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->
        <!-- <v-divider vertical></v-divider> -->
        <v-list-item link to="/lk/logos">
          <v-list-item-action>
            <v-icon small>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Логотипы</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/logo_sizes">
          <v-list-item-action>
            <v-icon small>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Лого тип-размер</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <!-- <v-list-item link to="/lk/logo_types">
          <v-list-item-action>
            <v-icon>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Лого - типы</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->
        <!-- <v-divider vertical></v-divider> -->
        <v-list-item link to="/lk/number_sizes">
          <v-list-item-action>
            <v-icon small>mdi-numeric</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Номер - размеры</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <!-- <v-divider vertical></v-divider> -->
        <v-list-item link to="/lk/text_sizes">
          <v-list-item-action>
            <v-icon small>mdi-format-text</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Надпись - размеры</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider vertical></v-divider>
        <v-list-item link to="/lk/discounts">
          <v-list-item-action>
            <v-icon small>mdi-sale</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Акции</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/news">
          <v-list-item-action>
            <v-icon small>mdi-newspaper</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Новости</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/videos">
          <v-list-item-action>
            <v-icon small>mdi-youtube</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Видеогалерея</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/photos">
          <v-list-item-action>
            <v-icon small>mdi-image</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Фотогалерея</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/feedbacks">
          <v-list-item-action>
            <v-icon small>mdi-message-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Отзывы</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/page/about">
          <v-list-item-action>
            <v-icon small>mdi-domain</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>О компании</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/faqs">
          <v-list-item-action>
            <v-icon small>mdi-help-circle</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Вопрос-ответ</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/home">
          <v-list-item-action>
            <v-icon small>mdi-wrench</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Главная</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/catalogs">
          <v-list-item-action>
            <v-icon small>mdi-file</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Каталоги</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/promocodes">
          <v-list-item-action>
            <v-icon small>mdi-label</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Промокоды</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider vertical></v-divider>
        <v-list-item link @click="logoutBtn">
          <v-list-item-action>
            <v-icon small>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Выход</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-content>
      <v-container style="max-width: none" fluid>
        <transition name="router-fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </v-container>
    </v-content>

    <!-- <v-footer :color="layoutColor()" class="d-flex flex-row">
      <v-row no-gutters class="hidden-sm-and-down">
        <v-col cols="12" class="text-center">
          123
        </v-col>
      </v-row>
      <v-row no-gutters class="hidden-md-and-up">
        <v-col cols="12" class="text-center">
          <span class="white--text mx-5"
            >&copy; 2012 - {{ year() }} Amway в Урае</span
          >
          <v-btn fab small text dark @click="scrollToTop">
            <v-icon>mdi-chevron-up</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-footer> -->
  </v-app>
</template>

<script>
import moment from 'moment'
import { mapActions } from 'vuex'
export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null
  }),
  methods: {
    ...mapActions(['logout']),
    logoutBtn() {
      this.logout()
      this.$router.push('/login')
    },
    year() {
      return moment().year()
    },
    scrollToTop() {
      window.scrollTo({ top: 0, left: 0, behavior: 'smooth' })
      this.drawer = false
    },
    layoutColor(area) {
      if (this.$router.currentRoute.path === '/') return 'green'
      if (this.$router.currentRoute.path === '/body') return '#f48c3b'
      if (this.$router.currentRoute.path === '/hair') return 'blue darken-3'
      if (this.$router.currentRoute.path === '/home') return '#374584'
      return 'white'
    }
  }
}
</script>
