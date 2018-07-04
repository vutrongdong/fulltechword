import {
  FETCHING_RESOURCES,
  FETCHING_RESOURCES_DONE,
  FETCHING_RESOURCES_FAIL,
  SET_BLOG,
  SET_BLOG_PAGINATION,
  REMOVE_BLOG,
  SET_DETAIL_BLOG
} from '../mutation-types'

/**
 * Blog state
 */
const state = {
  blogs: [],
  blog: {},
  pagination: {}
}

/**
 * Blog actions
 */
const actions = {

  /**
   * Fetch Blog data
   * @param {state}
   */
  async fetchBlogs({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    let { params } = payload ? payload : {}

    try {
      let blogs = await axios.get('/blogs', { params })
      commit(SET_BLOG, blogs.data.data)
      if (blogs.data.meta) {
        commit(SET_BLOG_PAGINATION, blogs.data.meta)
       }
      commit(FETCHING_RESOURCES_DONE)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * Create or update blog
   * @param state
   * @param blog
   */
  async pushBlog({ commit }, payload) {
    commit(FETCHING_RESOURCES)
    const { blog, cb } = payload || {}

    try {
        let response = null
      if (blog.id) {
        response = await axios.put('/blogs/'+blog.id, blog)
      } else {
        response = await axios.post('/blogs', blog)
      }
      commit(FETCHING_RESOURCES_DONE)
      cb && cb(response.data.data)
    } catch (err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },

  /**
   * remote blog
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   id             [description]
   * @return {[type]}                  [description]
   */
  async removeBlog({ commit }, id) {
    commit(FETCHING_RESOURCES)

    try {
      await axios.delete('/blogs/'+id)
      commit(FETCHING_RESOURCES_DONE)
      commit(REMOVE_BLOG, id)
    } catch(err) {
      commit(FETCHING_RESOURCES_FAIL, err)
    }
  },
  /**
   * get blog detail
   * @param  {[type]}   options.commit [description]
   * @param  {[type]}   payload        [description]
   * @return {[type]}                  [description]
   */
  async getBlog({ commit }, payload) {
    const { id, cb } = payload || {}

    if (id) {
      try {
        let blog = await axios.get('/blogs/'+id)
        commit(SET_DETAIL_BLOG, blog.data.data)
        commit(FETCHING_RESOURCES_DONE)
        cb && cb(blog.data.data)
      } catch(err) {
        commit(FETCHING_RESOURCES_FAIL, err)
      }
    }
  }
}

/**
 * Blog mutations
 */
const mutations = {

  /**
   * Set Blog data to state
   */
  [SET_BLOG] (state, blogs) {
    state.blogs = blogs
  },
  /**
   * remote blog
   */
  [REMOVE_BLOG]  (state, id) {
    let i = state.blogs.map(item => item.id).indexOf(id) // find index of your object
    state.blogs.splice(i, 1)
  },
  /**
   * set detail blog
   */
  [SET_DETAIL_BLOG] (state, blog) {
    state.blog = blog
  },
  /**
   * set detail blog
   */
  [SET_BLOG_PAGINATION] (state, pagination) {
    state.pagination = pagination
  }
}

/**
 * Blog getters
 */
const getters = {

  /**
   * Get all Blog
   * @param {state} state
   */
  allBlogs: (state) => state.blogs,
  /**
   * get blog
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  blogDetail: (state) => state.blog,
  /**
   * get blog paginate
   * @param  {[type]}   state [description]
   * @return {[type]}         [description]
   */
  blogPagination: (state) => state.pagination
}

export default {
  state,
  actions,
  mutations,
  getters
}
