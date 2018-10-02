import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_CATEGORY,
  SET_CATEGORY_PAGINATION,
  REMOVE_CATEGORY,
  SET_DETAIL_CATEGORY
} from '../mutation-types'

/**
 * Category state
 */
const state = {
  categories: [],
  category: {},
  pagination: {}
}

/**
 * Category actions
 */
const actions = {

  /**
   * Fetch Category data
   * @param {state}
   */
  async fetchCategories({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    let { params } = payload ? payload : {}

    try {
      let categories = await axios.get('/categories', { params })
      commit(SET_CATEGORY, categories.data.data)
      if (categories.data.meta) {
        commit(SET_CATEGORY_PAGINATION, categories.data.meta)
       }
      commit(FETCHING_RESOURCES_DONE)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * Create or update category
   * @param state
   * @param category
   */
  async pushCategory({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    const { category, cb } = payload || {}

    try {
        let response = ''
      if (category.id) {
        response = await axios.put('/categories/'+category.id, category)
      } else {
        response = await axios.post('/categories', category)
      }
      commit(FETCHING_RESOURCES_DONE)
      cb && cb(response.data.data)
    } catch (err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * remote category
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   id             [description]
   * @return {[type]}                  [description]
   */
  async removeCategory({ commit }, id) {
    commit(FETCHING_RESOURCES)

    try {
      await axios.delete('/categories/'+id)
      commit(FETCHING_RESOURCES_DONE)
      commit(REMOVE_CATEGORY, id)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },
  /**
   * get category detail
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   payload        [description]
   * @return {[type]}                  [description]
   */
  async getCategory({ commit }, payload) {
    const { id, cb } = payload || {}

    if (id) {
      try {
        let category = await axios.get('/categories/'+id)
        commit(SET_DETAIL_CATEGORY, category.data.data)
        commit(FETCHING_RESOURCES_DONE)
        cb && cb(category.data.data)
      } catch(err) {
        commit(FETCHING_RESOURCES_FAIL, err)
      }
    }
  }
}

/**
 * Category mutations
 */
const mutations = {

  /**
   * Set Category data to state
   */
  [SET_CATEGORY] (state, categories) {
    state.categories = categories
  },
  /**
   * remote category
   */
  [REMOVE_CATEGORY]  (state, id) {
    let i = state.categories.map(item => item.id).indexOf(id) // find index of your object
    state.categories.splice(i, 1)
  },
  /**
   * set detail category
   */
  [SET_DETAIL_CATEGORY] (state, category) {
    state.category = category
  },
  /**
   * set detail category
   */
  [SET_CATEGORY_PAGINATION] (state, pagination) {
    state.pagination = pagination
  }
}

/**
 * Category getters
 */
const getters = {

  /**
   * Get all Category
   * @param {state} state
   */
  allCategories: (state) => state.categories,
  /**
   * get category
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  categoryDetail: (state) => state.category,
  /**
   * get category paginate
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  categoryPagination: (state) => state.pagination
}

export default {
  state,
  actions,
  mutations,
  getters
}
