<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới danh mục
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/categories">Danh mục</router-link></li>
                <li class="breadcrumb-item active">Tạo mới danh mục</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <category-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import { debounce } from 'lodash'
import CategoryForm from './CategoryForm'
export default {
    components: {
        CategoryForm
    },
    methods: {
        ...mapActions(['pushCategory']),
        formSubmit(category) {
            this.pushCategory({
                category: category,
                cb: () => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                    this.$router.push('/categories')
                }
            })
        }
    }
}
</script>
