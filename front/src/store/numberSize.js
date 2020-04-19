import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allNumberSizes: []
}

// actions
const actions = {
  async updateNumberSizePromise({ dispatch }, payload) {
    return await context.post('api/number_sizes/update/' + payload.id, payload)
  },
  async createNumberSizePromise({ commit, dispatch }, payload) {
    return await context.post('api/number_sizes', payload)
  },
  async deleteNumberSizePromise({ commit, dispatch }, payload) {
    return await context.post('api/number_sizes/delete/' + payload.id)
  },
  async updateNumberSize({ dispatch }, payload) {
    await context
      .post('api/number_sizes/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/number_sizes')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createNumberSize({ commit, dispatch }, payload) {
    await context.post('api/number_sizes', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/number_sizes')
    })
  },
  async deleteNumberSize({ commit, dispatch }, payload) {
    context.post('api/number_sizes/delete/' + payload.id).then(x => {
      dispatch('getAllNumberSizes')
    })
  },
  async getAllNumberSizes({ commit }, payload) {
    context.get('api/number_sizes').then(x => {
      commit(types.GET_ALL_NUMBER_SIZES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_NUMBER_SIZES](state, payload) {
    state.allNumberSizes = payload
  }
}

// getters
const getters = {
  getNumberSizeById: state => id => {
    return state.allNumberSizes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
