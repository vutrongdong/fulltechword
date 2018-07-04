<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                {{ title }}
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/users">User management</router-link></li>
                <li class="breadcrumb-item active">{{ title }}</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <form class="form" role="form" @submit.prevent="formSubmit">
                        <p class="clearfix"></p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_name">Họ tên (<span class="text-danger">*</span>)</label>
                                    <input type="text" id="user_name" :class="{'form-control' : true, 'is-invalid': errors.has('user_name')}" placeholder="Nhập họ tên" v-model="user.name" name="user_name" v-validate="'required'" data-vv-as="họ tên">
                                    <div v-show="errors.has('user_name')" class="text-danger">{{ errors.first('user_name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_phone">Di động</label>
                                    <input type="text" id="user_phone" class="form-control" placeholder="Nhập số di động" v-model="user.phone">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_email">Email (<span class="text-danger">*</span>)</label>
                                    <input type="email" id="user_email" :class="{'form-control' : true, 'is-invalid': errors.has('user_email')}" placeholder="Nhập email" v-model="user.email" name="user_email" v-validate="'required|email'" data-vv-as="email">
                                    <div v-show="errors.has('user_email')" class="text-danger">{{ errors.first('user_email') }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_address">Địa chỉ</label>
                                    <input type="text" id="user_address" class="form-control" placeholder="Nhập địa chỉ" v-model="user.address">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_city">Tỉnh thành phố</label>
                                    <select class="form-control" id="user_city" v-model="user.city_id" @change="loadDistrictByCity">
                                        <option value="">Chọn tỉnh thành phố</option>
                                        <option v-for="city in allCities" :value="city.id" :key="city.id">{{ city.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_district">Quận huyện</label>
                                    <select class="form-control" id="user_district" v-model="user.district_id">
                                        <option value="">Chọn quận huyện</option>
                                        <option v-for="district in allDistricts" :value="district.id" :key="district.id">{{ district.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right">Tài khoản</label>
                                    <input type="text" class="form-control" placeholder="Tài khoản đăng nhập" v-model="user.email" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_password">Mật khẩu (<span class="text-danger">*</span>)</label>
                                    <input type="password" id="user_password" :class="{'form-control' : true, 'is-invalid': errors.has('user_password')}" placeholder="Nhập mật khẩu" v-model="user.password" name="user_password" v-validate="valid_password" data-vv-as="mật khẩu">
                                    <div v-show="errors.has('user_password')" class="text-danger">{{ errors.first('user_password') }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_password_confirmation">Xác nhận mật khẩu (<span class="text-danger">*</span>)</label>
                                    <input type="password" id="user_password_confirmation" :class="{'form-control' : true, 'is-invalid': errors.has('user_password_confirmation')}" placeholder="Nhập lại mật khẩu" v-model="user.password_confirmation" name="user_password_confirmation" v-validate="valid_repassword" data-vv-as="xác nhận mật khẩu" ref="confirmation">
                                    <div v-show="errors.has('user_password_confirmation')" class="text-danger">{{ errors.first('user_password_confirmation') }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_job_title">Vai trò</label>
                                    <div class="custom-control custom-radio" v-for="role in allRoles" :key="role.id">
                                        <input type="radio" :id="'user_role'+role.id" :value="role.id" class="custom-control-input" v-model="user.role">
                                        <label class="custom-control-label" :for="'user_role'+role.id">{{ role.name }} <small class="text-muted">{{ role.slug }}</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="user_send_notify" v-model="user.send_notify">
                                    <label class="custom-control-label" for="user_send_notify">Gửi email thông báo cho tài khoản này.</label>
                                </div>
                                <p class="clearfix"></p>
                                <button class="btn btn-default" type="submit">{{ title }}</button>
                                <router-link to="/users" class="btn btn-link">Trở lại</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import { assign } from 'lodash'

export default {
    data() {
        return {
            title: 'Create a new user',
            formType: true,
            user: {
                email: "",
                phone: "",
                city_id: "",
                district_id: "",
                password: "",
                password_confirmation: "",
                send_notify: true
            }
        }
    },
    methods: {
        ...mapActions(['fetchRoles', 'fetchCities', 'fetchDistrictByCity', 'pushUser', 'getUser']),

        loadDistrictByCity(dID) {
            this.fetchDistrictByCity(this.user.city_id)
                .then(() => {
                    this.user.district_id = dID || "";
                });
        },

        loadUser() {
            let uID = this.$route.params.id || null;
            this.getUser({
                id: uID,
                cb: this.fillUser
            });

            this.title = uID == null ? 'Create a new user' : 'Edit user'
            this.formType = uID == null ? true : false //
        },

        fillUser(user) {
            this.user = assign({}, this.user, user, {
                district_id: user.district.id,
                city_id: user.city.id,
                role: user.roles.length > 0 ? user.roles[0].id : 0,
                send_notify: false
            })
            this.loadDistrictByCity(this.user.district_id)
        },

        formSubmit() {
            this.$validator.validate().then(result => {
                if (result) {
                    this.pushUser({
                        user: this.user,
                        cb: () => {
                            $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Cập nhật dữ liệu thành công.')
                            this.$router.push('/users')
                        }
                    })
                }
            });
        }
    },
    computed: {
        ...mapGetters(['allRoles', 'allCities', 'allDistricts']),
        valid_password() {
            return this.formType ? 'required|min:6|confirmed:confirmation' : ''
        },
        valid_repassword() {
            return this.formType ? 'required|min:6' : ''
        }
    },
    mounted() {
        this.fetchRoles().then(() => this.loadUser());
        this.fetchCities();
    }
}
</script>
