<template>
    <form class="form" role="form" @submit.prevent="formSubmit">
        <p class="clearfix"></p>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="text-right" for="title">Tiêu đề (<span class="text-danger">*</span>)</label>
                    <input type="text" id="title" :class="{'form-control' : true, 'is-invalid': errors.has('title')}" placeholder="Nhập tên" v-model="blog.title" name="title" v-validate="'required'" data-vv-as="họ tên" @keydown="generateSlug" @change="generateSlug" @keyup="generateSlug">
                    <div v-show="errors.has('title')" class="text-danger">{{ errors.first('title') }}</div>
                </div>
                <div class="form-group">
                    <label class="text-right" for="slug">Slug (<span class="text-danger">*</span>)</label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập slug" v-model="blog.slug" v-validate="'required'" data-vv-as="slug">
                    <div v-show="errors.has('slug')" class="text-danger">{{ errors.first('slug') }}</div>
                </div>
                <div class="form-group">
                    <label class="text-right" for="category_id">Chọn danh mục</label>
                    <select class="form-control" id="category_id" v-model="blog.category_id">
                        <option :value="null">Chọn danh mục</option>
                        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-right">Trạng thái</label>
                    <div class="checkbox checkbox-success">
                        <input id="active" v-model="blog.active" type="checkbox">
                        <label for="active" v-if="blog.active">
                            Hiển thị
                        </label>
                        <label for="active" v-else>
                            Không hiển thị
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-right">Hot</label>
                    <div class="checkbox checkbox-success">
                        <input id="hot" v-model="blog.hot" type="checkbox">
                        <label for="hot" v-if="blog.hot">
                            Hot
                        </label>
                        <label for="hot" v-else>
                            Bình thường
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="text-right" for="image">Ảnh</label>
                    <input class="form-control" id="image" type="file" name="image" @change="handerSelectImage">
                    <img width="100" v-if="blog.image" :src="getImageUrl()" />
                </div>
                <div class="form-group">
                    <label class="text-right" for="teaser">Mô tả ngắn</label>
                    <textarea rows="11" id="teaser" class="form-control" v-model="blog.teaser" placeholder="Mô tả ngắn"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="text-right" for="content">Nội dung</label>
                    <tinymce
                        id="content"
                        :plugins="plugins"
                        v-model="blog.content"
                        :other_options="{ height: '300px', images_upload_handler: handleImageAdded }"
                        @editorInit="e => e.setContent(blog.content ? blog.content : '')"
                    ></tinymce>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-default" type="submit"><span v-if="this.type === 'create'">Tạo bài viết</span><span v-else>Lưu lại</span></button>
                <router-link v-if="type !== 'modal'" to="/blogs" class="btn btn-link">Trở lại</router-link>
            </div>
        </div>
    </form>
</template>
<script>
import { debounce } from 'lodash'
import tinymce from 'vue-tinymce-editor'
export default {
    name: 'BlogForm',
    components: {
        tinymce
    },
    props: {
        type: {
            type: String,
            default: 'create'
        },
        dataBlog: {
            type: Object,
            default: () => {
                return {
                    title: null,
                    slug: null,
                    image: null,
                    teaser: null,
                    content: null,
                    active: true,
                    hot: false,
                    category_id: null
                }
            }
        }
    },
    data() {
        return {
            blog: {
                title: null,
                slug: null,
                image: null,
                teaser: null,
                content: null,
                active: true,
                hot: false,
                category_id: null
            },
            categories: [],
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ]
        }
    },
    methods: {
        generateSlug () {
            this.blog.slug = this.stringToSlug(this.blog.title)
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

        handerSelectImage (evt) {
            this.blog.image = evt.target.files[0]
        },

        getImageUrl () {
            if (this.blog.image) {
                return URL.createObjectURL(this.blog.image)
            }
        },

        handleImageAdded: async function (file, success, failure) {
          let formData = new FormData()
          formData.append('file', file.blob())
          let response = await axios.post('/blogs/upload', formData)
          if (response.data.code === 1) {
            success(response.data.data.path)
          } else {
            return false
          }
        },

        formSubmit () {
            this.$validator.validate().then(result => {
                if (result) {
                    let blog = Object.assign({}, this.blog)
                    this.$emit('submit', blog)
                } else {
                    $.Notification.autoHideNotify('warning', 'top right', 'Cảnh báo', 'Vui lòng kiểm tra thông tin cần nhập')
                }
            })

        }
    },
    created () {
        this.blog = Object.assign({}, this.blog, this.dataBlog)
        this.fetchCategoriesForSelect()
    }
}
</script>
