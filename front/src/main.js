import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './registerServiceWorker'
import vuetify from './plugins/vuetify'
import '@fortawesome/fontawesome-free/css/all.css'
import VueJsModal from 'vue-js-modal'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import './assets/scss/_app.scss'
import 'swiper/css/swiper.css'

import AxiosConfig from './api/http-config'
Vue.$http = AxiosConfig

import AOS from 'aos'
import 'aos/dist/aos.css'
AOS.init()

Vue.config.productionTip = false
Vue.use(VueJsModal, { dynamic: true })
Vue.use(VueAwesomeSwiper /* { default options with global component } */)

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
