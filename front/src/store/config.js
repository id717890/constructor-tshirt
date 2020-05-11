import context from '../api/api'
import * as types from './mutation-types'
import Vue from 'vue'

const state = {
  allConfigs: []
}

// actions
const actions = {
  async setConfig({ dispatch }, payload) {
    await context
      .post('api/configs/set', payload)
      .then(() => {
        dispatch('getAllConfigs')
        Vue.noty.success('Сохранено!')
      })
      .catch(x => {
        Vue.noty.error('Ошибка сохранения!')
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async getAllConfigs({ commit }, payload) {
    context.get('api/configs/get').then(x => {
      commit(types.GET_ALL_CONFIGS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_CONFIGS](state, payload) {
    state.allConfigs = payload
  }
}

// getters
const getters = {
  getConfigByKey: state => key => {
    if (state.allConfigs) return state.allConfigs.find(x => x.key === key)
    return null
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
