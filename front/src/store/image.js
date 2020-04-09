import context from '../api/api'

const state = {}

// actions
const actions = {
  async uploadImage({}, payload) {
    return await context.post('api/imagesUpload', payload)
  }
}

// mutations
const mutations = {}

// getters
const getters = {}

export default {
  state,
  getters,
  actions,
  mutations
}
