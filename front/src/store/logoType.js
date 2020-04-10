import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allLogoTypes: []
}

// actions
const actions = {
  async updateLogoType({ dispatch }, payload) {
    await context
      .post('api/logo_types/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/logo_types')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createLogoType({ commit, dispatch }, payload) {
    await context.post('api/logo_types', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/logo_types')
    })
  },
  async deleteLogoType({ commit, dispatch }, payload) {
    context.post('api/logo_types/delete/' + payload.id).then(x => {
      dispatch('getAllLogoTypes')
    })
  },
  async getAllLogoTypes({ commit }, payload) {
    context.get('api/logo_types').then(x => {
      commit(types.GET_ALL_LOGO_TYPES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_LOGO_TYPES](state, payload) {
    state.allLogoTypes = payload
  }
}

// getters
const getters = {
  getLogoTypeById: state => id => {
    return state.allLogoTypes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
