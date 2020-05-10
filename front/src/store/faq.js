import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allFaqs: []
}

// actions
const actions = {
  async updateFaq({ dispatch }, payload) {
    await context
      .post('api/faqs/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/faqs')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createFaq({ commit, dispatch }, payload) {
    await context.post('api/faqs', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/faqs')
    })
  },
  async deleteFaq({ commit, dispatch }, payload) {
    context.post('api/faqs/delete/' + payload.id).then(x => {
      dispatch('getAllFaqs')
    })
  },
  async getAllFaqs({ commit }, payload) {
    context.get('api/faqs').then(x => {
      commit(types.GET_ALL_FAQS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_FAQS](state, payload) {
    state.allFaqs = payload
  }
}

// getters
const getters = {
  getFaqById: state => id => {
    return state.allFaqs.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
