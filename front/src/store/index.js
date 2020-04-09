import Vue from 'vue'
import Vuex from 'vuex'
// import * as types from './mutation-types'
import callback from './callback'
import type from './type'
import dialog from './dialog'
import loading from './loading'

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
    dialog,
    loading
  }
})
