<template>
    <div class="row">
        <div class="col-12">
            <div class="btn-group pull-right m-t-15">
                <router-link to="/users/create" class="btn btn-default waves-effect waves-light">Create new user</router-link>
            </div>
            <h4 class="page-title">
                User management
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">User management</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Vai trò</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, idx) in allUsers" :key="user.id">
                                        <td>{{ ++idx }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <td>{{ roleList(user.roles) }}</td>
                                        <td>
                                            <router-link class="btn btn-link btn-action text-muted" :to="{name: 'user.edit', params: {id: user.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                                            <a class="btn btn-link btn-action text-danger" @click="delUser(user.id)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { map } from 'lodash'

export default {
    methods: {
        ...mapActions(['fetchUsers']),

        roleList(roles) {
            let _roleList = map(roles, r => r.name)
            return _roleList.join(", ")
        },

        delUser(uID) {

        }
    },
    computed: {
        ...mapGetters(['allUsers'])
    },
    mounted() {
        this.fetchUsers()
    }
}
</script>
