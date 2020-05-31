import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allPromocodes: []
}

// actions
const actions = {
  async updatePromocode({ dispatch }, payload) {
    await context
      .post('api/promocodes/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/promocodes')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createPromocode({ commit, dispatch }, payload) {
    await context.post('api/promocodes', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/promocodes')
    })
  },
  async deletePromocode({ commit, dispatch }, payload) {
    context.post('api/promocodes/delete/' + payload.id).then(x => {
      dispatch('getAllPromocodes')
    })
  },
  async getAllPromocodes({ commit }, payload) {
    context.get('api/promocodes').then(x => {
      commit(types.GET_ALL_PROMOCODES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_PROMOCODES](state, payload) {
    state.allPromocodes = payload
  }
}

// getters
const getters = {
  getPromocodeById: state => id => {
    return state.allPromocodes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
