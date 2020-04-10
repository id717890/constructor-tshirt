<template>
  <v-app id="inspire">
    <modals-container />
    <v-navigation-drawer v-model="drawer" app permanent dark>
      <v-list dense>
        <v-list-item link to="/">
          <v-list-item-action>
            <v-icon>mdi-check</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Конструктор</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/types">
          <v-list-item-action>
            <v-icon>mdi-tshirt-v</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Типы футболок</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/models">
          <v-list-item-action>
            <v-icon>mdi-tshirt-crew</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Модели</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/colors">
          <v-list-item-action>
            <v-icon>mdi-palette</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Цвета</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider vertical></v-divider>
        <v-list-item link to="/lk/logos">
          <v-list-item-action>
            <v-icon>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Логотипы</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/logo_sizes">
          <v-list-item-action>
            <v-icon>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Лого - размеры</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link to="/lk/logo_types">
          <v-list-item-action>
            <v-icon>mdi-drawing</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Лого - типы</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider vertical></v-divider>
        <v-list-item link to="/lk/number_sizes">
          <v-list-item-action>
            <v-icon>mdi-numeric</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Номер - размеры</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider vertical></v-divider>
        <v-list-item link to="/lk/text_sizes">
          <v-list-item-action>
            <v-icon>mdi-format-text</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Надпись - размеры</v-list-item-title>
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
export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null
  }),
  methods: {
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

<style lang="scss">
// @import '../assets/scss/_app';
</style>
