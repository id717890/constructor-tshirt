import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allCatalogs: []
}

// actions
const actions = {
  async updateCatalog({ dispatch }, payload) {
    await context
      .post('api/catalogs/update/' + payload.id, payload.data)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/catalogs')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createCatalog({ commit, dispatch }, payload) {
    await context.post('api/catalogs', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/catalogs')
    })
  },
  async deleteCatalog({ commit, dispatch }, payload) {
    context.post('api/catalogs/delete/' + payload.id).then(x => {
      dispatch('getAllCatalogs')
    })
  },
  async getAllCatalogs({ commit }, payload) {
    context.get('api/catalogs').then(x => {
      commit(types.GET_ALL_CATALOGS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_CATALOGS](state, payload) {
    state.allCatalogs = payload
  }
}

// getters
const getters = {
  getCatalogById: state => id => {
    return state.allCatalogs.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
