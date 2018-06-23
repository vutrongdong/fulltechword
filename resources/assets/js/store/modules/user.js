import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_USER,
  SET_DETAIL_USER
} from '../mutation-types'

/**
 * User state
 */
const state = {
  users: [],
  user: {}
}

/**
 * User actions
 */
const actions = {

  /**
   * Fetch User data
   * @param {state}
   */
  async fetchUsers({ commit }) {
    commit(FETCHING_RESOURCES)

    try {
      let users = await axios.get('/users')
      commit(SET_USER, users.data.data)
      commit(FETCHING_RESOURCES_DONE)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * Create or update user
   * @param state
   * @param user
   */
  async pushUser({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    const { user, cb } = payload || {}

    try {
      if (user.id) {
        await axios.put('/users/'+user.id, user)
      } else {
        await axios.post('/users', user)
      }
      commit(FETCHING_RESOURCES_DONE)
      cb && cb()
    } catch (err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  async getUser({ commit }, payload) {
    const { id, cb } = payload || {}

    if (id) {
      try {
        let user = await axios.get('/users/'+id)
        commit(SET_DETAIL_USER, user.data.data)
        commit(FETCHING_RESOURCES_DONE)
        cb && cb(user.data.data)
      } catch(err) {
        commit(FETCHING_RESOURCES_FAIL, err)
      }
    }
  }
}

/**
 * User mutations
 */
const mutations = {

  /**
   * Set User data to state
   */
  [SET_USER] (state, users) {
    state.users = users
  },

  [SET_DETAIL_USER] (state, user) {
    state.user = user
  }
}

/**
 * User getters
 */
const getters = {

  /**
   * Get all User
   * @param {state} state
   */
  allUsers (state) {
    return state.users
  },
}

export default {
  state,
  actions,
  mutations,
  getters
}
