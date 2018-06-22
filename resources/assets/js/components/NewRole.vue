<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">{{ title }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/role">Role management</router-link></li>
                <li class="breadcrumb-item active">{{ title }}</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form" @submit.prevent="submitForm" novalidate>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="role_title">Role name (<b class="text-danger">*</b>)</label>
                                            <input type="text" id="role_name" name="role_name" :class="{'form-control' : true, 'is-invalid': errors.has('role_name')}" placeholder="Moderator, member..." v-model="role.name" @keyup="makeSlug" v-validate="{required:true}" data-vv-as="role name">
                                            <div v-show="errors.has('role_name')" class="text-danger">{{ errors.first('role_name') }}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="role_slug">Role slug</label>
                                            <input type="text" id="role_slug" class="form-control" v-model="role.slug" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <permission-list :permissions="this.allPermissions" :defaultPermission="role" v-on:selectedPermissions="selectedPermissions" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default" type="submit">{{ title }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { kebabCase, toLower, filter, assign } from 'lodash'
import { mapGetters, mapActions } from 'vuex'
import PermissionList from './partials/PermissionList'

export default {
    name: 'new-role',
    components: {
        PermissionList
    },
    data() {
        return {
            role: {
                name: '',
                slug: '',
                permissions: {}
            },
            title: 'Create new a role'
        }
    },
    computed: {
        ...mapGetters(['allPermissions', 'allRoles'])
    },
    methods: {
        ...mapActions(['fetchPermissions', 'fetchRoles', 'pushRole']),

        makeSlug(ev) {
            let _slug = kebabCase(toLower(ev.target.value))
            this.role.slug = _slug
        },

        selectedPermissions(permission) {
            this.role.permissions = assign({}, this.role.permissions, permission)
        },

        getRole() {
            let rID = this.$route.params.id || null;
            let role = filter(this.allRoles, r => r.id == rID)[0];
            this.role = assign({}, this.role, role);
        },

        loadRole() {
            let rID = this.$route.params.id || null;
            this.getRole(rID);

            this.title = rID == null ? 'Create a new role' : 'Edit role'
        },

        submitForm() {
            this.$validator.validate().then(result => {
                if (result) {
                    this.pushRole({
                        role: this.role,
                        cb: () => {
                            $.Notification.autoHideNotify('success', 'top right', 'Thành công','Cập nhật dữ liệu thành công.')
                            this.$router.push('/role')
                        }
                    })
                }
            });
        }
    },
    mounted() {
        this.fetchRoles().then(() => this.loadRole());
        this.fetchPermissions();
    }
}
</script>
