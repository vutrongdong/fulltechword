<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link to="/role/create" class="btn btn-default waves-effect waves-light">Add a new role</router-link>
            </div>
            <h4 class="page-title">
                Role management
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Role management</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <role-list :roles="this.allRoles" :delRole="delRole"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import RoleList from './partials/RoleList'

export default {
    components: {
        RoleList
    },
    methods: {
        ...mapActions(['fetchRoles', 'removeRole']),

        delRole(id) {
            let confirm = window.confirm('Are you sure you want to remove this role?');
            if (confirm) {
                this.removeRole(id)
                    .then(() => {
                        $.Notification.autoHideNotify('success', 'top right', 'Thành công','Xóa dữ liệu thành công.')
                    });
            }
        }
    },

    computed: {
        ...mapGetters(['allRoles'])
    },

    mounted() {
        this.fetchRoles();
    }
}
</script>
<style>
    .btn-action {
        padding: 0 5px;
    }
</style>
