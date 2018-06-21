<template>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(role, idx) in roles" :key="role.id">
                <td>
                    {{ ++idx }}
                </td>
                <td>
                    {{ role.name }} <small class="text-muted">{{ role.slug }}</small>
                </td>
                <td>
                    <router-link class="btn btn-link btn-action text-muted" :to="{name: 'role.edit', params: {id: role.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                    <a class="btn btn-link btn-action text-danger" @click="delRole(role.id)"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    name: "role-list",
    props: {
        roles: {
            type: Array,
            required: true,
            default: []
        },
        delRole: {
            type: Function,
            required: true
        }
    }
}
</script>
