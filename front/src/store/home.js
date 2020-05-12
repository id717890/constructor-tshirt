import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allHomeSlides: [],
  allPartners: []
}

// actions
const actions = {
  async updatePartner({ dispatch }, payload) {
    await context
      .post('api/partners/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/home')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createPartner({ commit, dispatch }, payload) {
    await context.post('api/partners', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/home')
    })
  },
  async deletePartner({ commit, dispatch }, payload) {
    context.post('api/partners/delete/' + payload.id).then(x => {
      dispatch('getAllPartners')
    })
  },
  async getAllPartners({ commit }, payload) {
    context.get('api/partners').then(x => {
      commit(types.GET_ALL_PARTNERS, x)
    })
  },
  ////////
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
  [types.GET_ALL_PARTNERS](state, payload) {
    state.allPartners = payload
  },
  [types.GET_ALL_HOME_SLIDES](state, payload) {
    state.allHomeSlides = payload
  }
}

// getters
const getters = {
  getPartnerById: state => id => {
    return state.allPartners.find(x => Number(x.id) === Number(id))
  },
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
