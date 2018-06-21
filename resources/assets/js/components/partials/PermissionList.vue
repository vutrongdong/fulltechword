<template>
    <div>
        <h3>Permission list {{ this.isObjectEmpty(this.defaultPermission) ? '' : ' :: ' + defaultPermission.name }}</h3>
        <ul class="list-unstyled">
            <li v-for="(p, role) in permissions">
                <b class="text-primary">{{ p.title }}</b>
                <ul class="list-inline">
                    <li class="list-inline-item" v-for="(title, permission) in p.list" :key="permission">
                        <div class="form-check">
                            <input class="form-check-input" :id="'pers_'+role+'.'+permission" :value="role+'.'+permission" type="checkbox" :checked="filterRole(role, permission)" :disabled="disabled" v-on:change="selectPermission">
                            <label class="font-weight-normal form-check-label" :for="'pers_'+role+'.'+permission">{{ title }}</label>
                        </div>
                    </li>
                </ul>
                <p class="clearfix"></p>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: "permission-list",
    props: {
        permissions: {
            required: true,
            type: Object
        },
        defaultPermission: {
            type: Object,
            default: () => {
                return {}
            }
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        isObjectEmpty(obj) {
            return Object.keys(obj).length == 0;
        },

        filterRole(role, permission) {
            let _permission = role+"."+permission;
            return this.isObjectEmpty(this.defaultPermission) ? false : this.defaultPermission['permissions'][_permission];
        },

        selectPermission(ev) {
            let _permission = ev.target.value
            let selectedPermission;
            if (this.defaultPermission['permissions'][_permission]) {
                selectedPermission = {[_permission]: false}
            } else {
                selectedPermission = {[_permission]: true}
            }
            this.$emit('selectedPermissions', selectedPermission)

        }
    }
}
</script>
