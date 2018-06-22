import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_USER,
} from '../mutation-types'

/**
 * User state
 */
const state = {
  users: []
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
      let users = axios.get('/users')
      commit(SET_USER, users)
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
