import Vue from 'vue'
import Vuex from 'vuex'
// import * as types from './mutation-types'
import callback from './callback'
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

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [
    store => {
      store.subscribeAction((action, state) => {})
    }
  ],
  modules: {
    callback,
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
    canvas
  }
})
