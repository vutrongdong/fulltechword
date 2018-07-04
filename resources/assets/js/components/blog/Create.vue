<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới bài viết
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/blogs">Bài viết</router-link></li>
                <li class="breadcrumb-item active">Tạo mới bài viết</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <blog-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import { debounce } from 'lodash'
import BlogForm from './BlogForm'
export default {
    components: {
        BlogForm
    },
    methods: {
        ...mapActions(['pushBlog']),
        formSubmit(blog) {
            this.pushBlog({
                blog: blog,
                cb: () => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                    this.$router.push('/blogs')
                }
            })
        }
    }
}
</script>
