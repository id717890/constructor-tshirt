import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allDiscounts: []
}

// actions
const actions = {
  async updateDiscount({ dispatch }, payload) {
    await context
      .post('api/discounts/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/discounts')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createDiscount({ commit, dispatch }, payload) {
    await context.post('api/discounts', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/discounts')
    })
  },
  async deleteDiscount({ commit, dispatch }, payload) {
    context.post('api/discounts/delete/' + payload.id).then(x => {
      dispatch('getAllDiscounts')
    })
  },
  async getAllDiscounts({ commit }, payload) {
    context.get('api/discounts').then(x => {
      commit(types.GET_ALL_DISCOUNTS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_DISCOUNTS](state, payload) {
    state.allDiscounts = payload
  }
}

// getters
const getters = {
  getDiscountById: state => id => {
    return state.allDiscounts.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
