<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Create a new user
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item"><router-link to="/users">User management</router-link></li>
                <li class="breadcrumb-item active">Create a new user</li>
            </ol>
            <p class="clearfix"></p>
            <div class="card">
                <div class="card-body">
                    <form class="form" role="form">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Phân loại</h5>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="user_type" value="0" class="custom-control-input" v-model="user.type">
                                    <label class="custom-control-label" for="user_type">Cá nhân</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="user_type2" value="1" class="custom-control-input" v-model="user.type">
                                    <label class="custom-control-label" for="user_type2">Doanh nghiệp</label>
                                </div>
                            </div>
                        </div>
                        <p class="clearfix"></p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_name">Họ tên</label>
                                    <input type="text" id="user_name" class="form-control" placeholder="Nhập họ tên" v-model="user.name">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_dob">Ngày sinh</label>
                                    <input type="text" id="user_dob" class="form-control datepicker" placeholder="Nhập ngày sinh" v-model="user.dob">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_gender">Giới tính</label>
                                    <select class="form-control" id="user_gender" v-model="user.gender">
                                        <option value="">Chọn giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_mobile">Di động</label>
                                    <input type="text" id="user_mobile" class="form-control" placeholder="Nhập số di động" v-model="user.mobile">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_phone">Số điện thoại</label>
                                    <input type="text" id="user_phone" class="form-control" placeholder="Nhập số điện thoại khác" v-model="user.phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_email">Email</label>
                                    <input type="email" id="user_email" class="form-control" placeholder="Nhập email" v-model="user.email">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_address">Địa chỉ</label>
                                    <input type="text" id="user_address" class="form-control" placeholder="Nhập địa chỉ" v-model="user.address">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_city">Tỉnh thành phố</label>
                                    <select class="form-control" id="user_city" v-model="user.city">
                                        <option value="">Chọn tỉnh thành phố</option>
                                        <option value="1">Hà Nội</option>
                                        <option value="2">Hồ Chí Minh</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_district">Quận huyện</label>
                                    <select class="form-control" id="user_district" v-model="user.district">
                                        <option value="">Chọn quận huyện</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-right" for="user_job">Nghề nghiệp</label>
                                    <input type="text" id="user_job" class="form-control" placeholder="Nhập nghề nghiệp" v-model="user.job">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_company">Công ty hiện tại</label>
                                    <input type="text" id="user_company" class="form-control" placeholder="Nhập tên công ty" v-model="user.company">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_com_address">Địa chỉ</label>
                                    <input type="text" id="user_com_address" class="form-control" placeholder="Nhập địa chỉ công ty" v-model="user.com_address">
                                </div>
                                <div class="form-group">
                                    <label class="text-right" for="user_job_title">Vị trí công việc</label>
                                    <input type="text" id="user_job_title" class="form-control" placeholder="Nhập vị trí công việc" v-model="user.job_title">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                gender: "",
                dob: "",
                city: "",
                district: "",
                type: 0
            }
        }
    },
    mounted() {
        const that = this;
        $(function() {
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy",
            }).on(
              'changeDate', () => { that.user.dob = $('#user_dob').val() }
            );
        });
    }
}
</script>
