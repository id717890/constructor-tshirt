import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allHomeSlides: []
}

// actions
const actions = {
  async updateHomeSlide({ dispatch }, payload) {
    await context
      .post('api/home/slides/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/home')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createHomeSlide({ commit, dispatch }, payload) {
    await context.post('api/home/slides', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/home')
    })
  },
  async deleteHomeSlide({ commit, dispatch }, payload) {
    context.post('api/home/slides/delete/' + payload.id).then(x => {
      dispatch('getAllHomeSlides')
    })
  },
  async getAllHomeSlides({ commit }, payload) {
    context.get('api/home/slides').then(x => {
      commit(types.GET_ALL_HOME_SLIDES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_HOME_SLIDES](state, payload) {
    state.allHomeSlides = payload
  }
}

// getters
const getters = {
  getHomeSlideById: state => id => {
    return state.allHomeSlides.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
