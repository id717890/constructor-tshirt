import * as types from './mutation-types'
import context from '../api/api'
import Vue from 'vue'
import router from '../router'

const state = {
  user: null,
  token: null,
  role: null,
  name: null
}

// getters
const getters = {
  getUser(state) {
    return state.user
  },
  getError(state) {
    return state.error
  },
  getLoading(state) {
    return state.loading
  },
  isAuth: state => state.user != null && state.token != null,
  isAdmin: state => state.role !== null && state.role === 'admin'
}

// actions
const actions = {
  async resetPassword({}) {
    return await context.post('api/auth/reset')
  },
  async signUserIn({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      context
        .post('api/auth/login', payload)
        .then(x => {
          if (x) {
            let token = x.access_token
            let expiration = x.expires_in
            let user = x.id
            let role = x.role
            let name = x.name
            commit(types.SET_USER, user)
            commit(types.SET_TOKEN, token)
            commit(types.SET_ROLE, role)
            commit(types.SET_NAME, name)
            Vue.auth.setToken(token, expiration * 1000 + Date.now())
            Vue.auth.setUser(user)
            Vue.auth.setRole(role)
            Vue.auth.setName(name)
            resolve()
          } else {
            reject('auth error')
          }
        })
        .catch(x => {
          reject(x.response)
        })
    })
  },

  async logout({ commit, dispatch }) {
    Vue.auth.logout()
    commit(types.SET_USER, null)
    commit(types.SET_TOKEN, null)
    commit(types.SET_ROLE, null)
    commit(types.SET_NAME, null)
  }
}

// mutations
const mutations = {
  [types.SET_USER](state, payload) {
    state.user = payload
  },
  [types.SET_LOADING](state, payload) {
    state.loading = payload
  },
  [types.SET_TOKEN](state, payload) {
    state.token = payload
  },
  [types.SET_ROLE](state, payload) {
    state.role = payload
  },
  [types.SET_NAME](state, payload) {
    state.name = payload
  },
  [types.SIGN_UP](state, payload) {}
}

export default {
  state,
  getters,
  actions,
  mutations
}
