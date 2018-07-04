<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Chỉnh sửa danh mục
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/categories">Danh mục</router-link></li>
                <li class="breadcrumb-item active">Chỉnh sửa danh mục</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <category-form v-if="category.id" @submit="formSubmit" type="edit" :dataCategory="category" />
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
    data () {
        return {
            category: {}
        }
    },
    methods: {
        ...mapActions(['pushCategory', 'getCategory']),
        formSubmit(category) {
            this.pushCategory({
                category: category,
                cb: () => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Cập nhật dữ liệu thành công.')
                    this.$router.push('/categories')
                }
            })
        }
    },
    mounted() {
        this.getCategory({
            id: this.$route.params.id,
            cb: (category) => {
                this.category = Object.assign({}, this.category, category)
            }
        })
    }
}
</script>
