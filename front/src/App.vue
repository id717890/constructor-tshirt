<template>
  <v-app id="inspire" ref="home">
    <v-toolbar
      tile
      dense
      max-height="70"
      class="main-bg hidden-sm-and-down main-bg elevation-0 top-menu"
      dark
    >
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
      <!-- <v-toolbar-title>Title</v-toolbar-title> -->
      <!-- <div class="flex-grow-1"></div> -->
      <v-toolbar-items v-if="language === 'en'">
        <div
          class="nav-link-wrapper"
          :class="active === 'home' ? 'active' : ''"
        >
          <a href="#" class="nav-item-link" @click="scrollTo($event, 'home')"
            >Home</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'about' ? 'active' : ''"
        >
          <a href="#" class="nav-item-link" @click="scrollTo($event, 'about')"
            >About</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'products' ? 'active' : ''"
        >
          <a
            href="#"
            class="nav-item-link"
            @click="scrollTo($event, 'products')"
            >Portfolio</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'services' ? 'active' : ''"
        >
          <a
            href="#"
            class="nav-item-link"
            @click="scrollTo($event, 'services')"
            >Services</a
          >
        </div>
        <v-btn text @click="language = 'ru'" v-if="language === 'en'">RU</v-btn>
        <v-btn text @click="language = 'en'" v-if="language === 'ru'">EN</v-btn>
      </v-toolbar-items>
      <v-toolbar-items v-if="language === 'ru'">
        <div
          class="nav-link-wrapper"
          :class="active === 'home' ? 'active' : ''"
        >
          <a href="#" class="nav-item-link" @click="scrollTo($event, 'home')"
            >Главная</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'about' ? 'active' : ''"
        >
          <a href="#" class="nav-item-link" @click="scrollTo($event, 'about')"
            >Обо мне</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'products' ? 'active' : ''"
        >
          <a
            href="#"
            class="nav-item-link"
            @click="scrollTo($event, 'products')"
            >Портфолио</a
          >
        </div>
        <div
          class="nav-link-wrapper"
          :class="active === 'services' ? 'active' : ''"
        >
          <a
            href="#"
            class="nav-item-link"
            @click="scrollTo($event, 'services')"
            >Услуги</a
          >
        </div>
        <v-btn text @click="language = 'ru'" v-if="language === 'en'">RU</v-btn>
        <v-btn text @click="language = 'en'" v-if="language === 'ru'">EN</v-btn>
      </v-toolbar-items>

      <!-- <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn> -->
    </v-toolbar>
    <modals-container />
    <v-navigation-drawer
      v-model="drawer"
      app
      dark
      clipped
      temporary
      class="main-bg"
    >
      <v-list-item @click="scrollTo($event, 'home')">
        <v-list-item-action>
          <i class="fa fa-home"></i>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title v-if="language === 'en'">Home</v-list-item-title>
          <v-list-item-title v-if="language === 'ru'"
            >Главная</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-list dense>
        <v-list-item @click="scrollTo($event, 'about')">
          <v-list-item-action>
            <i class="fa fa-tag"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-if="language === 'en'"
              >About</v-list-item-title
            >
            <v-list-item-title v-if="language === 'ru'"
              >Обо мне</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="scrollTo($event, 'products')">
          <v-list-item-action>
            <i class="fa fa-tag"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-if="language === 'en'"
              >Portfolio</v-list-item-title
            >
            <v-list-item-title v-if="language === 'ru'"
              >Портфолио</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="scrollTo($event, 'services')">
          <v-list-item-action>
            <i class="fa fa-tag"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-if="language === 'en'"
              >Services</v-list-item-title
            >
            <v-list-item-title v-if="language === 'ru'"
              >Услуги</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="changeLanguage('ru')" v-if="language === 'en'">
          <v-list-item-action>
            <i class="fa fa-tag"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Russian</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="changeLanguage('en')" v-if="language === 'ru'">
          <v-list-item-action>
            <i class="fa fa-tag"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>English</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-btn
      class="menu-btn hidden-md-and-up"
      small
      text
      dark
      fab
      @click="showMenu"
    >
      <i class="fa fa-align-justify"></i>
    </v-btn>
    <home :language="language" />
    <about ref="about" :language="language" />
    <skills ref="skills" :language="language" />
    <products :language="language" ref="products" />
    <services :language="language" ref="services" />
    <!-- <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item @click="test">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="test">
          <v-list-item-action>
            <v-icon>mdi-settings</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Settings</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app clipped-left>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col class="shrink">
            <v-tooltip right>
              <template v-slot:activator="{ on }">
                <v-btn :href="source" icon large target="_blank" v-on="on">
                  <v-icon large>mdi-code-tags</v-icon>
                </v-btn>
              </template>
              <span>Source</span>
            </v-tooltip>
            <v-tooltip right>
              <template v-slot:activator="{ on }">
                <v-btn
                  icon
                  large
                  href="https://codepen.io/johnjleider/pen/bXNzZL"
                  target="_blank"
                  v-on="on"
                >
                  <v-icon large>mdi-codepen</v-icon>
                </v-btn>
              </template>
              <span>Codepen</span>
            </v-tooltip>
          </v-col>
        </v-row>
      </v-container>
    </v-content> -->
    <div class="main-bg white--text footer ma-0">
      <v-container>
        <v-row>
          <v-col cols="12" md="3" class="text-center">
            <span class="font-weight-bold">Skype:&nbsp;</span
            ><span style="color: #adc42c">jz_user</span>
          </v-col>
          <v-col cols="12" md="3" class="text-center">
            <span class="font-weight-bold">E-mail:&nbsp;</span
            ><span style="color: #adc42c">jusupovz@gmail.com</span>
          </v-col>
          <v-col cols="12" md="3" class="text-center">
            <span class="font-weight-bold">Phone:&nbsp;</span
            ><span style="color: #adc42c">
              <a style="color: #adc42c" href="tel:+79527247500"
                >+7 (952) 724 7500</a
              >
            </span>
          </v-col>
          <v-col cols="12" md="3" class="text-center">
            <span>All rights reserved &copy; 2019</span>
            <v-btn
              fab
              outlined
              color="white"
              small
              class="ml-5 "
              @click="scrollTo($event, 'home')"
            >
              <i class="fa fa-chevron-up"></i>
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </v-app>
</template>

<script>
import Home from './components/Home'
import About from './components/About'
import Skills from './components/Skills'
import Products from './components/Portfolio'
import Services from './components/Service'

export default {
  components: {
    home: Home,
    about: About,
    skills: Skills,
    products: Products,
    services: Services
  },
  props: {
    source: String
  },
  data: () => ({
    drawer: null,
    active: 'home',
    language: 'en'
  }),
  computed: {},
  created() {
    // window.addEventListener('scroll', this.scroll)
  },
  destroyed() {
    // window.removeEventListener('scroll', this.scroll)
  },
  methods: {
    changeLanguage(language) {
      this.language = language
      this.drawer = false
    },
    scroll(e) {
      console.log(window.scrollY)
    },
    showMenu() {
      this.drawer = !this.drawer
    },
    scrollTo(e, elementName) {
      this.active = elementName
      e.preventDefault()
      let element = this.$refs[elementName].$el
      setTimeout(() => {
        var top = element.offsetTop
        window.scrollTo({ top: top, left: 0, behavior: 'smooth' })
        this.drawer = false
      }, 200)
    }
  }
}
</script>
<style lang="scss">
@import './assets/scss/_app';
</style>
