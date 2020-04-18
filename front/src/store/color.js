import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allColors: []
}

// actions
const actions = {
  async updateColorPromise({ dispatch }, payload) {
    return await context.post('api/colors/update/' + payload.id, payload)
  },
  async createColorPromise({ commit, dispatch }, payload) {
    return await context.post('api/colors', payload)
  },
  async updateColor({ dispatch }, payload) {
    await context
      .post('api/colors/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/colors')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createColor({ commit, dispatch }, payload) {
    await context.post('api/colors', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/colors')
    })
  },
  async deleteColor({ commit, dispatch }, payload) {
    context.post('api/colors/delete/' + payload.id).then(x => {
      dispatch('getAllColors')
    })
  },
  async deleteColorPromise({ commit, dispatch }, payload) {
    return await context.post('api/colors/delete/' + payload.id)
  },
  async getAllColors({ commit }, payload) {
    context.get('api/colors').then(x => {
      commit(types.GET_ALL_COLORS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_COLORS](state, payload) {
    state.allColors = payload
  }
}

// getters
const getters = {
  getColorosByModelId: state => id => {
    if (state.allColors && state.allColors.length > 0)
      return state.allColors.filter(x => Number(x.model_id) === Number(id))
    return []
  },
  getColorById: state => id => {
    return state.allColors.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
