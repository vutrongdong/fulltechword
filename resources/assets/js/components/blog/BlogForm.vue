<template>
    <div>
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
                        <label class="text-right" for="teaser">Mô tả ngắn</label>
                        <textarea rows="15" id="teaser" class="form-control" v-model="blog.teaser" placeholder="Mô tả ngắn"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-right" for="image">Ảnh</label>
                        <div class="upload" :class="{'has-image': blog.image}">
                            <label>
                                <input class="form-control" id="image" type="file" name="image" @change="handerSelectImage">
                                <img v-if="blog.image" :src="blog.image_path" />
                            </label>
                        </div>
                    </div>
                </div>
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
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-right" for="teaser">Tags</label>
                        <div>
                            <span class="label label-default delete-tag" @click="removeTag(index)" :style="{'backgroundColor': tag.color}" v-for="(tag, index) in blog.tags" :index="tag.id">{{tag.name}} <i class="fa fa-times"></i></span>
                            <span class="label add-tag" @click="showAddTag"><i class="fa fa-plus"></i> Thêm tag</span>
                        </div>
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

        <div id="createTagModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="full-width-modalLabel">Thêm tag</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                            <div>
                                <h5>Chọn tag:</h5>
                                <span class="label label-default delete-tag" @click="addTag(tag)" :style="{'backgroundColor': tag.color}" v-for="tag in allTags" :index="tag.id" v-if="checkExistTag(tag)">{{tag.name}}</span>
                            </div>
                            <hr>
                            <div>
                                <h5>Hoặc thêm tag mới: <button class="btn btn-icon waves-effect waves-light btn-primary pull-right"> <i class="fa fa-plus" @click="newTagForm = !newTagForm"></i> </button></h5>
                                <tag-form v-if="newTagForm" @submit="createTag" type="modal" />
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>
<script>
import { debounce, findIndex } from 'lodash'
import { mapActions, mapGetters } from 'vuex'
import tinymce from 'vue-tinymce-editor'
import TagForm from '../tag/TagForm'
export default {
    name: 'BlogForm',
    components: {
        tinymce,
        TagForm
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
                    category_id: null,
                    tags: []
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
                category_id: null,
                tags: []
            },
            categories: [],
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            newTagForm: false
        }
    },
    computed: {
        ...mapGetters(['allTags'])
    },
    methods: {
        ...mapActions(['pushTag', 'fetchTags']),

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

        async handerSelectImage (evt) {
            if (evt.target.files[0]) {
                let formData = new FormData()
                formData.append('file', evt.target.files[0])
                try {
                    let response = await axios.post('/blogs/upload', formData, {params: {resize: 1}})
                    if (response.data.code === 1) {
                        this.blog.image = response.data.data.name
                        this.blog.image_path = response.data.data.path
                    } else {
                        $.Notification.autoHideNotify('error', 'top right', 'Lỗi', 'Upload file thất bại')
                    }
                } catch(err) {
                    if (err.status == 422) {
                        let msg = []
                        forIn(err.data, (err, idx) => {
                            msg.push("&bullet; " + err[0])
                        })
                        $.Notification.autoHideNotify('error', 'top right', 'Thất bại', msg.join("<br>"))
                    } else {
                        $.Notification.autoHideNotify('error', 'top right', 'Lỗi', 'Upload file thất bại')
                    }
                }
            }
        },

        handleImageAdded: async function (file, success, failure) {
          let formData = new FormData()
          formData.append('file', file.blob())
          try{
              let response = await axios.post('/blogs/upload', formData)
              if (response.data.code === 1) {
                success(response.data.data.path)
              } else {
                return false
              }
          } catch (err) {
            if (err.status == 422) {
                let msg = []
                forIn(err.data, (err, idx) => {
                    msg.push("&bullet; " + err[0])
                })
                $.Notification.autoHideNotify('error', 'top right', 'Thất bại', msg.join("<br>"))
            }
          }
        },

        showAddTag () {
            if (!this.allTags.length) {
                this.fetchTags({limit: -1})
            }
            $('#createTagModal').modal('show')
        },

        createTag (tag) {
            this.pushTag({
                tag: tag,
                cb: (response) => {
                    $.Notification.autoHideNotify('success', 'top right', 'Thành công', 'Thêm dữ liệu thành công.')
                    this.addTag(response)
                }
            })
        },

        addTag (tag) {
            if (tag) {
                if (findIndex(this.blog.tags, {id: tag.id}) === -1) {
                    this.blog.tags.push(tag)
                }
                this.tag = null
            }
        },

        removeTag (index) {
            this.blog.tags.splice(index, 1)
        },

        checkExistTag (tag) {
            return findIndex(this.blog.tags, {id: tag.id}) === -1;
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

<style scoped>
.upload.has-image input{
    display: none;
}
.upload label{
    display: block;
    text-align: center;
}
.upload img{
    max-width: 80%;
}
.add-tag{
    cursor: pointer;
    border: 1px dashed #979797;
    color: #979797;
}
.label{
    margin: 2px;
    white-space: normal;
}
.delete-tag{
    cursor: pointer;
}
</style>
