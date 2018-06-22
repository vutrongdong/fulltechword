<template>
    <div class="row">
        <div class="col-12">
            <h4 class="page-title">
                Website's settings
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Bảng điều khiển</router-link></li>
                <li class="breadcrumb-item active">Setting</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" role="form">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_title">Website title</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_title" class="form-control" placeholder="Enter the website title" v-model="setting.title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_keyword">Website keywords</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_keyword" class="form-control" placeholder="Enter the website keywords" v-model="setting.keywords">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_description">Website description</label>
                                    <div class="col-7">
                                        <textarea id="setting_description" class="form-control" v-model="setting.description" placeholder="Enter the website description"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_name">Tên công ty</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_name" class="form-control" placeholder="Nhập tên công ty" v-model="setting.name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_addr">Địa chỉ</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_addr" class="form-control" placeholder="Nhập địa chỉ" v-model="setting.address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_phone">Số điện thoại</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_phone" class="form-control" placeholder="Nhập số điện thoại" v-model="setting.phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_email">Email</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_email" class="form-control" placeholder="Nhập Email" v-model="setting.email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_tax">Mã số thuế</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_tax" class="form-control" placeholder="Nhập mã số thuế doanh nghiệp" v-model="setting.tax_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_bank">Tài khoản ngân hàng</label>
                                    <div class="col-7">
                                        <textarea id="setting_company_bank" class="form-control" v-model="setting.bank" placeholder="Nhập thông tin tài khoản ngân hàng"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_about">Giới thiệu công ty</label>
                                    <div class="col-9">
                                        <tinymce id="t1" :plugins="plugins" v-model="setting.about"></tinymce>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_fb">Facebook</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_fb" class="form-control" placeholder="Nhập link facebook fanpage" v-model="setting.facebook">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_insta">Instagram</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_insta" class="form-control" placeholder="Nhập link instagram" v-model="setting.instagram">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label text-right" for="setting_company_zalo">Zalo</label>
                                    <div class="col-7">
                                        <input type="text" id="setting_company_zalo" class="form-control" placeholder="Nhập link zalo page" v-model="setting.zalo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-7 offset-2">
                                        <button type="button" class="btn btn-default" @click="submitForm"><i class="ti-save"></i> Cập nhật</button>
                                        <router-link to="/" class="btn btn-link">Trở lại</router-link>
                                    </div>
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
import tinymce from 'vue-tinymce-editor'
import { assign } from 'lodash'
import { mapActions, mapGetters } from 'vuex'

export default {
    components: {
        tinymce
    },
    data() {
        return {
            setting: {},
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
        }
    },
    computed: {
        ...mapGetters(['allSettings'])
    },
    methods: {
        ...mapActions(['fetchSetting', 'pushSetting']),
        loadSetting() {
            this.setting = assign({}, this.setting, this.allSettings)
        },
        submitForm() {
            this.pushSetting({
                setting: this.setting,
                cb: $.Notification.autoHideNotify('success', 'top right', 'Thành công','Cập nhật dữ liệu thành công.')
            })
        }
    },
    mounted() {
        this.fetchSetting().then(() => this.loadSetting())
    }
}
</script>
