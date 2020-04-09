import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allTypes: []
}

// actions
const actions = {
  async updateType({ dispatch }, payload) {
    await context
      .post('api/types/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/types')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createType({ commit, dispatch }, payload) {
    await context.post('api/types', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/types')
    })
  },
  async deleteType({ commit, dispatch }, payload) {
    context.post('api/types/delete/' + payload.id).then(x => {
      dispatch('getAllTypes')
    })
  },
  async getAllTypes({ commit }, payload) {
    context.get('api/types').then(x => {
      commit(types.GET_ALL_TYPES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_TYPES](state, payload) {
    state.allTypes = payload
  }
}

// getters
const getters = {
  getTypeById: state => id => {
    return state.allTypes.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
