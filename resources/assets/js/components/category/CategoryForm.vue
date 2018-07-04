<template>
    <form class="form" role="form" @submit.prevent="formSubmit">
        <p class="clearfix"></p>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="text-right" for="name">Tên (<span class="text-danger">*</span>)</label>
                    <input type="text" id="name" :class="{'form-control' : true, 'is-invalid': errors.has('name')}" placeholder="Nhập tên" v-model="category.name" name="name" v-validate="'required'" data-vv-as="họ tên" @keydown="generateSlug" @change="generateSlug" @keyup="generateSlug">
                    <div v-show="errors.has('name')" class="text-danger">{{ errors.first('name') }}</div>
                </div>
                <div class="form-group">
                    <label class="text-right" for="slug">Slug (<span class="text-danger">*</span>)</label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập slug" v-model="category.slug" v-validate="'required'" data-vv-as="slug">
                    <div v-show="errors.has('slug')" class="text-danger">{{ errors.first('slug') }}</div>
                </div>
                <div class="form-group">
                    <label class="text-right" for="icon">Icon</label>
                    <input type="text" id="icon" class="form-control" placeholder="Nhập icon" v-model="category.icon">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="text-right" for="parent_id">Danh mục cha</label>
                    <select class="form-control" id="parent_id" v-model="category.parent_id">
                        <option :value="null">Chọn danh mục cha</option>
                        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-right" for="priority">Độ ưu tiên</label>
                    <input type="number" id="priority" class="form-control" placeholder="Nhập priority" v-model="category.priority">
                </div>
                <div class="form-group">
                    <label class="text-right">Trạng thái</label>
                    <div class="checkbox checkbox-success">
                        <input id="active" v-model="category.active" type="checkbox">
                        <label for="active" v-if="category.active">
                            Hoạt động
                        </label>
                        <label for="active" v-else>
                            Không hoạt động
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-default" type="submit"><span v-if="this.type === 'create'">Tạo danh mục</span><span v-else>Lưu lại</span></button>
                <router-link v-if="type !== 'modal'" to="/categories" class="btn btn-link">Trở lại</router-link>
            </div>
        </div>
    </form>
</template>
<script>
import { debounce } from 'lodash'
export default {
    name: 'CategoryForm',
    props: {
        type: {
            type: String,
            default: 'create'
        },
        dataCategory: {
            type: Object,
            default: () => {
                return {
                    name: null,
                    slug: null,
                    icon: null,
                    priority: 0,
                    parent_id: null,
                    active: true
                }
            }
        }
    },
    data() {
        return {
            category: {
                name: null,
                slug: null,
                icon: null,
                priority: 0,
                parent_id: null,
                active: true
            },
            categories: []
        }
    },
    methods: {
        generateSlug () {
            this.category.slug = this.stringToSlug(this.category.name)
        },

        async fetchCategoriesForSelect () {
            try {
                let response = await axios.get('/categories/to-select')
                this.categories = response.data.data
            } catch(e) {
                this.categories = []
            }
        },

        stringToSlug(str)
        {
            var slug
            str = str ? str : ''
            //Đổi chữ hoa thành chữ thường
            slug = str.toLowerCase()

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            slug = slug.replace(/đ/gi, 'd')
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\|_/gi, '')
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-")
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-')
            slug = slug.replace(/\-\-\-\-/gi, '-')
            slug = slug.replace(/\-\-\-/gi, '-')
            slug = slug.replace(/\-\-/gi, '-')
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@'
            slug = slug.replace(/\@\-|\-\@|\@/gi, '')
            return slug
        },

        formSubmit () {
            this.$validator.validate().then(result => {
                if (result) {
                    let category = Object.assign(this.category)
                    category.parent_id = category.parent_id !== null ? category.parent_id : 0
                    this.$emit('submit', category)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', 'Vui lòng kiểm tra thông tin cần nhập')
                }
            })

        }
    },
    created () {
        this.category = Object.assign({}, this.category, this.dataCategory)
        this.fetchCategoriesForSelect()
    }
}
</script>
