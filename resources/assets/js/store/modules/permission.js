import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_PERMISSION,
} from '../mutation-types'

/**
 * Permission state
 */
const state = {
  permissions: {}
}

/**
 * Permission actions
 */
const actions = {

  /**
   * Fetch Permission data
   * @param {state}
   */
  fetchPermissions({ commit }) {
    commit(FETCHING_RESOURCES)
    axios.get('/permissions')
      .then(res => {
        commit(FETCHING_RESOURCES_DONE)
        commit(SET_PERMISSION, res.data)
      }, err => {
        commit(FETCHING_RESOURCES_FAIL, err)
      })
  }
}

/**
 * Permission mutations
 */
const mutations = {

  /**
   * Set Permission data to state
   */
  [SET_PERMISSION] (state, permissions) {
    state.permissions = permissions
  }
}

/**
 * Permission getters
 */
const getters = {

  /**
   * Get all Permission
   * @param {state} state
   */
  allPermissions (state) {
    return state.permissions
  },
}

export default {
  state,
  actions,
  mutations,
  getters
}
