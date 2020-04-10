import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allLogos: []
}

// actions
const actions = {
  async updateLogo({ dispatch }, payload) {
    await context
      .post('api/logos/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/logos')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createLogo({ commit, dispatch }, payload) {
    await context.post('api/logos', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/logos')
    })
  },
  async deleteLogo({ commit, dispatch }, payload) {
    context.post('api/logos/delete/' + payload.id).then(x => {
      dispatch('getAllLogos')
    })
  },
  async getAllLogos({ commit }, payload) {
    context.get('api/logos').then(x => {
      commit(types.GET_ALL_LOGOS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_LOGOS](state, payload) {
    state.allLogos = payload
  }
}

// getters
const getters = {
  getLogoById: state => id => {
    return state.allLogos.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
