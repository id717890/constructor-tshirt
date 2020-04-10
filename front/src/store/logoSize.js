import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allLogoSizes: []
}

// actions
const actions = {
  async updateLogoSize({ dispatch }, payload) {
    await context
      .post('api/logo_sizes/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/logo_sizes')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createLogoSize({ commit, dispatch }, payload) {
    await context.post('api/logo_sizes', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/logo_sizes')
    })
  },
  async deleteLogoSize({ commit, dispatch }, payload) {
    context.post('api/logo_sizes/delete/' + payload.id).then(x => {
      dispatch('getAllLogoSizes')
    })
  },
  async getAllLogoSizes({ commit }, payload) {
    context.get('api/logo_sizes').then(x => {
      commit(types.GET_ALL_LOGO_SIZES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_LOGO_SIZES](state, payload) {
    state.allLogoSizes = payload
  }
}

// getters
const getters = {
  getLogoSizeById: state => id => {
    return state.allLogoSizes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
