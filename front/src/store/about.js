import context from '../api/api'
import * as types from './mutation-types'
import router from '../router'

const state = {
  allAboutImages: []
}

// actions
const actions = {
  async updateAboutImage({ dispatch }, payload) {
    await context
      .post('api/about_images/update/' + payload.id, payload)
      .then(x => {
        dispatch('setLoading', false)
        router.push('/lk/page/about')
      })
      .catch(x => {
        console.log(x)
        dispatch('setLoading', false)
      })
  },
  async createAboutImage({ commit, dispatch }, payload) {
    await context.post('api/about_images', payload).then(() => {
      dispatch('setLoading', false)
      router.push('/lk/page/about')
    })
  },
  async deleteAboutImage({ commit, dispatch }, payload) {
    context.post('api/about_images/delete/' + payload.id).then(x => {
      dispatch('getAllAboutImages')
    })
  },
  async getAllAboutImages({ commit }, payload) {
    context.get('api/about_images').then(x => {
      commit(types.GET_ALL_ABOUT_IMAGES, x)
    })
  }
}

// mutations
const mutations = {
  [types.GET_ALL_ABOUT_IMAGES](state, payload) {
    state.allAboutImages = payload
  }
}

// getters
const getters = {
  getAboutImageById: state => id => {
    return state.allAboutImages.find(x => Number(x.id) === Number(id))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
