<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Tạo mới tag
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/tags">Tag</router-link></li>
                <li class="breadcrumb-item active">Tạo mới tag</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <tag-form @submit="formSubmit" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import { debounce } from 'lodash'
import TagForm from './TagForm'
export default {
    components: {
        TagForm
    },
    methods: {
        ...mapActions(['pushTag']),
        formSubmit(tag) {
            this.pushTag({
                tag: tag,
                cb: () => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                    this.$router.push('/tags')
                }
            })
        }
    }
}
</script>
