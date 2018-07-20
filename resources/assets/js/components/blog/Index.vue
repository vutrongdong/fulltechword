<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link to="/blogs/create" class="btn btn-default waves-effect waves-light">Thêm mới bài viết</router-link>
            </div>
            <h4 class="page-title">
                Bài viết
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Bài viết</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-header">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input v-model="filters.q" type="text" class="form-control" placeholder="Tìm kiếm..." @keydown="filter()">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Hiển thị</th>
                                        <th>Hot</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>




                                    <tr v-for="(blog, idx) in allBlogs" :key="blog.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ blog.title }}</td>
                                        <td><i class="fa fa-check text-success" v-if="blog.active"></i></td>
                                        <td><i class="fa fa-check text-success" v-if="blog.hot"></i></td>
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'blog.edit', params: {id: blog.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="deleteBlog(blog.id)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer" v-if="blogPagination.last_page > 1">
                    <nav class="pull-right">
                        <paginate
                        :page-count="blogPagination.last_page"
                        :page-range="5"
                        :margin-pages="2"
                        :click-handler="paginationChange"
                        prev-text="«"
                        next-text="»"
                        container-class="pagination"
                        page-class="page-item"
                        page-link-class="page-link"
                        next-class="page-item"
                        next-link-class="page-link"
                        prev-class="page-item"
                        prev-link-class="page-link">
                      </paginate>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { debounce } from 'lodash'
export default {
    data () {
        return {
            filters: {
                q: null,
                page: null
            }
        }
    },
    methods: {
        ...mapActions(['fetchBlogs', 'removeBlog']),
        paginationChange (page) {
            this.filters.page = page
            this.filter()
        },

        filter: debounce(function () {
            this.fetchBlogs({params: this.filters})
        }, 500),

        deleteBlog (id) {
            swal({
              title: 'Cảnh báo?',
              text: "Bạn chắc chắn muốn xóa bản ghi này?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Xóa',
              cancelButtonText: 'Không',
              reverseButtons: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger mr-2',
              buttonsStyling: false,
            }).then((result) => {
              if (result) {
                this.removeBlog(id)
                this.filter()
              }
            })
        }
    },
    computed: {
        ...mapGetters(['allBlogs', 'blogPagination'])
    },
    mounted() {
        this.fetchBlogs()
    }
}
</script>

<style scoped>
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
</style>
