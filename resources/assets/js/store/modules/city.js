import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_CITY,
  SET_DISTRICT
} from '../mutation-types'

/**
 * City state
 */
const state = {
  cities: [],
  districts: []
}

/**
 * City actions
 */
const actions = {

  /**
   * Fetch City data
   * @param {state}
   */
  async fetchCities({ commit }) {
    commit(FETCHING_RESOURCES)
    try {
      let cities = await axios.get('/cities')
      commit(FETCHING_RESOURCES_DONE)
      commit(SET_CITY, cities.data)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  async fetchDistrictByCity({ commit }, cID) {
    commit(FETCHING_RESOURCES)
    try {
      let districts = await axios.get('/districts/city/'+cID)
      commit(FETCHING_RESOURCES_DONE)
      commit(SET_DISTRICT, districts.data)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  }
}

/**
 * City mutations
 */
const mutations = {

  /**
   * Set City data to state
   */
  [SET_CITY] (state, cities) {
    state.cities = cities
  },

  /**
   * Set district data to state
   */
  [SET_DISTRICT] (state, districts) {
    state.districts = districts
  },
}

/**
 * City getters
 */
const getters = {

  /**
   * Get all city
   * @param {state} state
   */
  allCities (state) {
    return state.cities
  },

  /**
   * Get all district
   * @param {state} state
   */
  allDistricts (state) {
    return state.districts
  },
}

export default {
  state,
  actions,
  mutations,
  getters
}
