import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'
import Vue from 'vue'

const state = {
  allModels: []
}

// actions
const actions = {
  async updateModelSize({ dispatch, commit }, payload) {
    await context
      .post('api/models/update_size/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        Vue.noty.success('Сохранено!')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
        Vue.noty.error('Ошибка!')
      })
  },
  async updateModelOrder({ dispatch, commit }, payload) {
    await context
      .post('api/models/update_order/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        commit(types.GET_ALL_MODELS, x.models)
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async updateModel({ dispatch }, payload) {
    await context
      .post('api/models/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/models')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createModel({ commit, dispatch }, payload) {
    await context.post('api/models', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/models')
    })
  },
  async deleteModel({ commit, dispatch }, payload) {
    context.post('api/models/delete/' + payload.id).then(x => {
      dispatch('getAllModels')
    })
  },
  async getAllModels({ commit }, payload) {
    context.get('api/models').then(x => {
      commit(types.GET_ALL_MODELS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_MODELS](state, payload) {
    state.allModels = payload
  }
}

// getters
const getters = {
  getModelById: state => id => {
    return state.allModels.find(x => Number(x.id) === Number(id))
  },
  isSizeOfModelShouldShow: state => (model_id, size) => {
    let result = false
    if (state.allModels) {
      const findModel = state.allModels.find(
        x => Number(x.id) === Number(model_id)
      )
      if (findModel && findModel.model_sizes) {
        const findSize = findModel.model_sizes.find(
          x => x.size.toLowerCase() === size.toLowerCase()
        )
        if (findSize && findSize.is_show) return Number(findSize.is_show) === 1
      }
    }

    return result
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
