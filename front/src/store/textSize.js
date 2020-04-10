import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allTextSizes: []
}

// actions
const actions = {
  async updateTextSize({ dispatch }, payload) {
    await context
      .post('api/text_sizes/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/text_sizes')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createTextSize({ commit, dispatch }, payload) {
    await context.post('api/text_sizes', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/text_sizes')
    })
  },
  async deleteTextSize({ commit, dispatch }, payload) {
    context.post('api/text_sizes/delete/' + payload.id).then(x => {
      dispatch('getAllTextSizes')
    })
  },
  async getAllTextSizes({ commit }, payload) {
    context.get('api/text_sizes').then(x => {
      commit(types.GET_ALL_TEXT_SIZES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_TEXT_SIZES](state, payload) {
    state.allTextSizes = payload
  }
}

// getters
const getters = {
  getTextSizeById: state => id => {
    return state.allTextSizes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
