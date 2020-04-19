import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allLogoTypes: []
}

// actions
const actions = {
  async updateTypePromise({ dispatch }, payload) {
    return await context.post('api/logo_types/update/' + payload.id, payload)
  },
  async createTypePromise({ commit, dispatch }, payload) {
    return await context.post('api/logo_types', payload)
  },
  async deleteTypePromise({ commit, dispatch }, payload) {
    return await context.post('api/logo_types/delete/' + payload.id)
  },
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
  getTypesBySizeId: state => id => {
    if (state.allLogoTypes && state.allLogoTypes.length > 0)
      return state.allLogoTypes.filter(
        x => Number(x.logo_size_id) === Number(id)
      )
    return []
  },
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
