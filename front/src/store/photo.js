import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allPhotos: []
}

// actions
const actions = {
  async updatePhoto({ dispatch }, payload) {
    await context
      .post('api/photos/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/photos')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createPhoto({ commit, dispatch }, payload) {
    await context.post('api/photos', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/photos')
    })
  },
  async deletePhoto({ commit, dispatch }, payload) {
    context.post('api/photos/delete/' + payload.id).then(x => {
      dispatch('getAllPhotos')
    })
  },
  async getAllPhotos({ commit }, payload) {
    context.get('api/photos').then(x => {
      commit(types.GET_ALL_PHOTOS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_PHOTOS](state, payload) {
    state.allPhotos = payload
  }
}

// getters
const getters = {
  getPhotoById: state => id => {
    return state.allPhotos.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
