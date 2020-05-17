import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allModels: []
}

// actions
const actions = {
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
