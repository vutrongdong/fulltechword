import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_ROLE,
  REMOVE_ROLE,
  VIEW_ROLE,
} from '../mutation-types'

/**
 * Role state
 */
const state = {
  roles: []
}

/**
 * Role actions
 */
const actions = {

  /**
   * Fetch role data
   * @param {state}
   */
  async fetchRoles({ commit }) {
    commit(FETCHING_RESOURCES)
    try {
      let roles = await axios.get('/roles')
      commit(FETCHING_RESOURCES_DONE)
      commit(SET_ROLE, roles.data)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  async removeRole({ commit }, id) {
    commit(FETCHING_RESOURCES)

    try {
      await axios.delete('/roles/'+id)
      commit(FETCHING_RESOURCES_DONE)
      commit(REMOVE_ROLE, id)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  async pushRole({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    const { role, cb } = payload || {}

    try {
      if (role.id) {
        await axios.put('/roles/'+role.id, role)
      } else {
        await axios.post('/roles', role)
      }
      commit(FETCHING_RESOURCES_DONE)
      cb && cb()
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  }
}

/**
 * Role mutations
 */
const mutations = {

  /**
   * Set Role data to state
   */
  [SET_ROLE] (state, roles) {
    state.roles = roles
  },

  [REMOVE_ROLE]  (state, id) {
    let i = state.roles.map(item => item.id).indexOf(id) // find index of your object
    state.roles.splice(i, 1)
  }
}

/**
 * Role getters
 */
const getters = {

  /**
   * Get all role
   * @param {state} state
   */
  allRoles (state) {
    return state.roles
  }
}

export default {
  state,
  actions,
  mutations,
  getters
}
