<template>
    <div class="container-fluid">
        <vue-simple-spinner
            class="loading"
            v-if="loading"
            size="small"
            line-fg-color="#5fbeaa"
            line-bg-color="#f2f2f2"
            message="Loading...">
        </vue-simple-spinner>
        <router-view></router-view>
    </div>
</template>
<script>
import Spinner from 'vue-simple-spinner'
import { mapGetters } from 'vuex'
import { forIn } from 'lodash'

export default {
    components: {
        Spinner
    },
    computed: {
        ...mapGetters(['loading', 'app_errors'])
    },
    methods: {
        errorNotify(n, o) {
            if (this.app_errors && this.app_errors.status == 422) {
                let msg = []
                forIn(this.app_errors.data, (err, idx) => {
                    msg.push("&bullet; " + err[0])
                })
                $.Notification.autoHideNotify('error', 'top right', 'Thất bại', msg.join("<br>"))
            } else if (this.app_errors && this.app_errors.status == 403) {
                $.Notification.autoHideNotify('error', 'top right', 'Thất bại', "Bạn không có quyền thao tác hoặc truy cập.")
                this.$router.push('/')
            }
        }
    },
    watch: {
        'app_errors': 'errorNotify'
    }
}
</script>
<style>
    .loading {
        position: fixed;
        bottom: 20px; right: 40px;
        z-index: 99999;
    }
</style>
