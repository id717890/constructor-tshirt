import context from '../api/api'
import * as types from './mutation-types'
import Vue from 'vue'

const state = {
  allPages: []
}

// actions
const actions = {
  async updatePage({ dispatch }, payload) {
    await context
      .post('api/pages/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        // console.log(Vye)
        Vue.noty.success('Сохранено!')
      })
      .catch(x => {
        Vue.noty.error('Ошибка сохранения!')
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async getAllPages({ commit }, payload) {
    context.get('api/pages').then(x => {
      commit(types.GET_ALL_PAGES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_PAGES](state, payload) {
    state.allPages = payload
  }
}

// getters
const getters = {
  getPageById: state => id => {
    return state.allPages.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
