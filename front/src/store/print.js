import * as types from './mutation-types'

const state = {
  zakazAll: {}
}

// actions
const actions = {
  async setPrintZakaz({ commit }, payload) {
    commit(types.SET_PRINT_ZAKAZ_ALL, x)
  }
}

// mutations
const mutations = {
  [types.SET_PRINT_ZAKAZ_ALL](state, payload) {
    state.zakazAll = payload
  }
}

// getters
const getters = {}

export default {
  state,
  getters,
  actions,
  mutations
}
