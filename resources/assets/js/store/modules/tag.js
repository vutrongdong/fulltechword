import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_TAG,
  SET_TAG_PAGINATION,
  REMOVE_TAG,
  SET_DETAIL_TAG
} from '../mutation-types'

/**
 * Tag state
 */
const state = {
  tags: [],
  tag: {},
  pagination: {}
}

/**
 * Tag actions
 */
const actions = {

  /**
   * Fetch Tag data
   * @param {state}
   */
  async fetchTags({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    let { params } = payload ? payload : {}

    try {
      let tags = await axios.get('/tags', { params })
      commit(SET_TAG, tags.data.data)
      if (tags.data.meta) {
        commit(SET_TAG_PAGINATION, tags.data.meta)
       }
      commit(FETCHING_RESOURCES_DONE)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * Create or update tag
   * @param state
   * @param tag
   */
  async pushTag({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    const { tag, cb } = payload || {}

    try {
        let response = null
      if (tag.id) {
        response = await axios.put('/tags/'+tag.id, tag)
      } else {
        response = await axios.post('/tags', tag)
      }
      commit(FETCHING_RESOURCES_DONE)
      cb && cb(response.data.data)
    } catch (err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * remote tag
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   id             [description]
   * @return {[type]}                  [description]
   */
  async removeTag({ commit }, id) {
    commit(FETCHING_RESOURCES)

    try {
      await axios.delete('/tags/'+id)
      commit(FETCHING_RESOURCES_DONE)
      commit(REMOVE_TAG, id)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },
  /**
   * get tag detail
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   payload        [description]
   * @return {[type]}                  [description]
   */
  async getTag({ commit }, payload) {
    const { id, cb } = payload || {}

    if (id) {
      try {
        let tag = await axios.get('/tags/'+id)
        commit(SET_DETAIL_TAG, tag.data.data)
        commit(FETCHING_RESOURCES_DONE)
        cb && cb(tag.data.data)
      } catch(err) {
        commit(FETCHING_RESOURCES_FAIL, err)
      }
    }
  }
}

/**
 * Tag mutations
 */
const mutations = {

  /**
   * Set Tag data to state
   */
  [SET_TAG] (state, tags) {
    state.tags = tags
  },
  /**
   * remote tag
   */
  [REMOVE_TAG]  (state, id) {
    let i = state.tags.map(item => item.id).indexOf(id) // find index of your object
    state.tags.splice(i, 1)
  },
  /**
   * set detail tag
   */
  [SET_DETAIL_TAG] (state, tag) {
    state.tag = tag
  },
  /**
   * set detail tag
   */
  [SET_TAG_PAGINATION] (state, pagination) {
    state.pagination = pagination
  }
}

/**
 * Tag getters
 */
const getters = {

  /**
   * Get all Tag
   * @param {state} state
   */
  allTags: (state) => state.tags,
  /**
   * get tag
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  tagDetail: (state) => state.tag,
  /**
   * get tag paginate
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  tagPagination: (state) => state.pagination
}

export default {
  state,
  actions,
  mutations,
  getters
}
