import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allAlbums: []
}

// actions
const actions = {
  async updateAlbum({ dispatch }, payload) {
    await context
      .post('api/albums/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/albums')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createAlbum({ commit, dispatch }, payload) {
    await context.post('api/albums', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/albums')
    })
  },
  async deleteAlbum({ commit, dispatch }, payload) {
    context.post('api/albums/delete/' + payload.id).then(x => {
      dispatch('getAllAlbums')
    })
  },
  async getAllAlbums({ commit }, payload) {
    context.get('api/albums').then(x => {
      commit(types.GET_ALL_ALBUMS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_ALBUMS](state, payload) {
    state.allAlbums = payload
  }
}

// getters
const getters = {
  getAlbumById: state => id => {
    return state.allAlbums.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
