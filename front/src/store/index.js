import Vue from 'vue'
import Vuex from 'vuex'
// import * as types from './mutation-types'
import type from './type'
import model from './model'
import color from './color'
import dialog from './dialog'
import loading from './loading'
import image from './image'
import logo from './logo'
import logoSize from './logoSize'
import logoType from './logoType'
import numberSize from './numberSize'
import textSize from './textSize'
import canvas from './canvas'
import size from './size'
import auth from './auth'
import discount from './discount'
import news from './news'
import video from './video'
import photo from './photo'
import feedback from './feedback'
import page from './page'
import faq from './faq'
import album from './album'
import home from './home'
import config from './config'
import print from './print'
import catalog from './catalog'
import promocode from './promocode'
import about from './about'

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [
    store => {
      store.subscribeAction((action, state) => {})
    }
  ],
  modules: {
    type,
    model,
    color,
    dialog,
    loading,
    image,
    logo,
    logoSize,
    logoType,
    numberSize,
    textSize,
    canvas,
    size,
    auth,
    discount,
    news,
    video,
    photo,
    feedback,
    page,
    faq,
    album,
    home,
    config,
    print,
    catalog,
    promocode,
    about
  }
})
