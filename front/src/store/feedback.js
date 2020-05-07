import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allFeedbacks: []
}

// actions
const actions = {
  async updateFeedback({ dispatch }, payload) {
    await context
      .post('api/feedbacks/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/feedbacks')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createFeedback({ commit, dispatch }, payload) {
    return context.post('api/feedbacks', payload)
  },
  async deleteFeedback({ commit, dispatch }, payload) {
    context.post('api/feedbacks/delete/' + payload.id).then(x => {
      dispatch('getAllFeedbacks')
    })
  },
  async getAllFeedbacks({ commit }, payload) {
    context.get('api/feedbacks').then(x => {
      commit(types.GET_ALL_FEEDBACKS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_FEEDBACKS](state, payload) {
    state.allFeedbacks = payload
  }
}

// getters
const getters = {
  getFeedbackById: state => id => {
    return state.allFeedbacks.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
