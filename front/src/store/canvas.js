import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  showDeleteBtn: false
}

// actions
const actions = {
  async toggleDeleteBtn({ commit }, payload) {
    commit(types.SHOW_DELETE_BTN, payload)
  }
}

// mutations
const mutations = {
  [types.SHOW_DELETE_BTN](state, payload) {
    state.showDeleteBtn = payload
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
