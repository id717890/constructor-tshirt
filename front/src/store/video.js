import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allVideos: []
}

// actions
const actions = {
  async updateVideo({ dispatch }, payload) {
    await context
      .post('api/videos/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/videos')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createVideo({ commit, dispatch }, payload) {
    await context.post('api/videos', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/videos')
    })
  },
  async deleteVideo({ commit, dispatch }, payload) {
    context.post('api/videos/delete/' + payload.id).then(x => {
      dispatch('getAllVideos')
    })
  },
  async getAllVideos({ commit }, payload) {
    context.get('api/videos').then(x => {
      commit(types.GET_ALL_VIDEOS, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_VIDEOS](state, payload) {
    state.allVideos = payload
  }
}

// getters
const getters = {
  getVideoById: state => id => {
    return state.allVideos.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
