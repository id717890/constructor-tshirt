import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allSizes: [],
  sizesOfColor: []
}

// actions
const actions = {
  async updateSize({ dispatch }, payload) {
    return await context.post('api/sizes/update/' + payload.id, payload)
  },
  async createSize({ commit, dispatch }, payload) {
    return await context.post('api/sizes', payload)
  },
  async deleteSize({ commit, dispatch }, payload) {
    return await context.post('api/sizes/delete/' + payload.id)
  },
  async getSizes({ commit }, payload) {
    context.get('api/sizes/' + payload).then(x => {
      commit(types.GET_SIZES, x)
    })
  },
  async getAllSizes({ commit }, payload) {
    context.get('api/sizes').then(x => {
      commit(types.GET_ALL_SIZES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_SIZES](state, payload) {
    state.allSizes = payload
  },
  [types.GET_SIZES](state, payload) {
    state.sizesOfColor = payload
  }
}

// getters
const getters = {
  getSizeById: state => id => {
    return state.allSizes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
