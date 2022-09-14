<template>
    <div>
        <div v-if="loading" class="d-flex justify-content-center m-5">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-info" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-if="error">

        </div>
        <div v-if="!loading">
            <h3 class="pt-2">{{ __('About Section') }}</h3>
            <div class="input-group mt-3 mb-3">
                <input v-model="finds" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('name') }}</th>
                        <th scope="col">{{ __('name_ar') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="about_paragraphs &&editFields">
                    <tr v-for="(about_paragraph,index) in filterBy(about_paragraphs, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span >
                            {{ about_paragraph.headline }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ about_paragraph.headline_ar }}
                        </span>
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                  <button v-if="!about_paragraph.id"
                                        class="btn btn-primary" @click="showModal(index)"
                                        type="button">
                                    {{ __('Add') }}
                                </button>
                                <button v-if="about_paragraph.id"
                                        class="btn btn-warning" @click="showModal(index)"
                                         type="button">
                                    {{ __('Edit') }}
                                </button>

                                <a v-if="about_paragraph.id" class="btn btn-danger"
                                   @click.prevent="delabout_paragraph(index)">{{ __('Del') }}</a>
                                <a v-if="!about_paragraph.id" class="btn btn-danger"
                                   @click.prevent="removeItem(index)">{{ __('Del') }}</a>

                            </div>
                            <div :id="'exampleModal'+index" aria-hidden="true" aria-labelledby="exampleModalLabel"
                                 class="modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <Form v-slot="{ meta,errors }" class="form-horizontal form_register"
                                              enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ __('About Section') }}</h5>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                                        type="button"></button>
                                            </div>
                                            <div class="modal-body">

                                                <template v-if="Object.keys(errors).length">
                                                    <p class="text-danger">
                                                        {{ __('Please correct the following errors') }}</p>
                                                    <ul>
                                                        <li v-for="(message, field) in errors" :key="field"
                                                            class="w3-text-red">
                                                            {{ message }}
                                                        </li>
                                                    </ul>
                                                </template>

                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="recipient-name">{{ __('Icon:') }}</label>
                                                    <Multiselect id="icon"
                                                                 v-model="about_paragraph.icon"
                                                                 :options="[ { icon: 'heartbeat' },{ icon: 'pills'},
                                                                             { icon: 'hospital-user' }, { icon: 'dna'},
                                                                             { icon: 'wheelchair' },{ icon: 'notes-medical'},
                                                                             { icon: 'gift' }, { icon: 'fingerprint' } ,
                                                                              { icon: 'atom' }
                                                                             ]"
                                                                 :placeholder="__('Select an Icon')"
                                                                 label="name"
                                                                 value-prop="icon">
                                                        <template v-slot:singlelabel="{ value }">
                                                            <div class="multiselect-single-label">
                                                                <i :class="'fas fa-'+ value.icon" class="text-primary"></i>
                                                            </div>
                                                        </template>

                                                        <template v-slot:option="{ option }">
                                                            <i :class="'fas fa-'+ option.icon" class="text-primary"></i>
                                                        </template>
                                                    </Multiselect>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('headline:')
                                                        }}</label>
                                                    <Field
                                                        id="headline" v-model="about_paragraph.headline"
                                                        :data-vv-as="__('headline')"
                                                        class="form-control w3-text-red" name="headline" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="headline"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Paragraph:')
                                                        }}</label>
                                                    <Field as="textarea" id="paragraph" v-model="about_paragraph.paragraph"
                                                           :data-vv-as="__('paragraph')"
                                                           class="form-control w3-text-red  "
                                                           name="paragraph" required
                                                           rules="required"
                                                           type="text"/>
                                                    <ErrorMessage class="text-danger" name="paragraph"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="message-text">{{ __('Headline_ar:') }}</label>
                                                    <Field
                                                        id="headline_ar" v-model="about_paragraph.headline_ar"
                                                        :data-vv-as="__('headline_ar')"
                                                        class="form-control w3-text-red  "
                                                        name="headline_ar" required
                                                        rules="required" type="text"/>
                                                    <ErrorMessage class="text-danger" name="headline_ar"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="message-text">{{ __('Paragraph_ar:') }}</label>
                                                    <Field id="paragraph_ar"  as="textarea"
                                                           v-model="about_paragraph.paragraph_ar"
                                                           :data-vv-as="__('paragraph_ar')"
                                                           class="form-control w3-text-red  "
                                                           name="paragraph_ar" required
                                                           rules="required" type="text"/>
                                                    <ErrorMessage class="text-danger" name="paragraph_ar"/>

                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                                    {{ __('Close') }}
                                                </button>
                                                <button v-if="!about_paragraph.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="addabout_paragraph(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="about_paragraph.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="editabout_paragraph(index)">{{ __('Save changes') }}
                                                </button>
                                            </div>
                                        </Form>

                                    </div>
                                </div>
                            </div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td colspan="5">
                            <button class="btn btn-info" type="button" @click.prevent="InsertRow()">
                                +{{ __('Add about section') }}
                            </button>
                        </td>

                    </tr>
                    </tbody>
                </table>

            </div>


        </div>
    </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'
import Vue2Filters from 'vue2-filters'
import _ from 'lodash'

import {Field, Form, ErrorMessage, defineRule, configure} from 'vee-validate';
import {required} from '@vee-validate/rules';
import {localize} from '@vee-validate/i18n';

import en from '@vee-validate/i18n/dist/locale/en.json';
import ar from '@vee-validate/i18n/dist/locale/ar.json';

defineRule('required', required);
import __ from "lodash/fp/__";

if (_locale === 'ar') {
    configure({

        generateMessage: localize(
            'ar', {
                names: {
                    headline: 'العنوان بالانجليزية',
                    paragraph: 'المحتوى بالانجليزية',
                    paragraph_ar: 'المحتوى بالعربية',
                    headline_ar: 'العنوان بالعربية',
                }
            }),
    });
} else {
    configure({

        generateMessage: localize({
            en,
        }),
    });

}
export default {
    name: "about_paragraphs",
    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            about_paragraphs: [],
            editFields: [],
            finds: null,
            success: [],
            fail: [],
            output: [],
            myModal: null,

            //user:auth_user,
            files: [],
            uploaded: [],
        }
    },
    mixins: [Vue2Filters.mixin],

    components: {
        Multiselect,
        Form,
        Field,
        ErrorMessage
    },
    mounted() {
        this.get_about_paragraphs();
    }
    ,
    methods: {
        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_about_paragraphs() {
            axios.get('/api/getabout_paragraphs/')
                .then(response => {
                    this.about_paragraphs = response.data;
                    let len = this.about_paragraphs.length;
                    for (let i = 0; i < len; i++) {
                        this.files.push(Object.assign({}, null));
                        this.success.push(Object.assign({}, null));
                        this.fail.push(Object.assign({}, null));
                        this.uploaded.push(Object.assign({}, 0));
                        this.output.push(Object.assign({}, ''));

                        this.errorFS.push(Object.assign({}, {
                            'icon':'',
                            'headline':'',
                            'paragraph':'',
                            'headline_ar':'',
                            'paragraph_ar':'',
                        }));

                    }
                    this.loading = false;
                }).catch((err) => alert('there is an error try again,or Refresh page'));

            this.loading = false;
        },
        addabout_paragraph(index) {
            axios.post('/api/addabout_paragraph', {
                headline: this.about_paragraphs[index].headline,
                paragraph_ar: this.about_paragraphs[index].paragraph_ar,
                headline_ar: this.about_paragraphs[index].headline_ar,
                paragraph: this.about_paragraphs[index].paragraph,
                icon: this.about_paragraphs[index].icon,

            })
                .then((response) => {
                    this.about_paragraphs[index] = response.data.att;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        }, editabout_paragraph(index) {

            axios.put('/api/editabout_paragraph/' + this.about_paragraphs[index].id, {
                headline: this.about_paragraphs[index].headline,
                paragraph_ar: this.about_paragraphs[index].paragraph_ar,
                headline_ar: this.about_paragraphs[index].headline_ar,
                paragraph: this.about_paragraphs[index].paragraph,
                icon: this.about_paragraphs[index].icon,

            })
                .then((response) => {
                    console.log('sucess');
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },
        InsertRow() {
            var my_object = {
                headline: '',
                paragraph: '',
                headline_ar: '',
                paragraph_ar: '',
                icon:'',


            };
            this.about_paragraphs.push(my_object);
            this.errorFS.push(Object.assign({}, {
                'icon':'',
                'headline':'',
                'paragraph':'',
                'headline_ar':'',
                'paragraph_ar':'',

            }));


        },
        delabout_paragraph(x) {
            let d = this.about_paragraphs[x];
            axios.delete('/api/deleteabout_paragraph/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        user: this.user,
                        notification: response.data.notification.notification
                    });
                    this.about_paragraphs.splice(x, 1);
                    this.errorFS.splice(x, 1);
                }).catch(error => {
                if (error.response.status === 422) {
                    this.error = error.response.data.message;
                } else {
                    alert('Unkown error!')
                }
            });
        }, removeItem(x) {
            this.about_paragraphs.splice(x, 1);
            this.errorFS.splice(x, 1);

        },
        removeFile: function (e, index) {
            axios.delete('/api/delfile', {params: {path: this.about_paragraphs[index].image}})
                .then((response) => {
                    this.about_paragraphs[index].image = '';
                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },

        onFileChange(e, index) {
            this.files[index] = e.target.files[0];
            this.submitForm(e, index);
        }
        ,
        submitForm(e, index) {
            let f = this.files[index];
            this.fail = '';
            this.success = '';
            let currentObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
// form data
            let formData = new FormData();
            formData.append('file', f);
            formData.append('path', 'images/mainpage/');

// send upload request
            axios.post('/api/store_file', formData,
                {
                    onUploadProgress: function (progressEvent) {
                        //console.log('soso')
                        let vm = this;
                        let p = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total));

                        this.uploaded[index] = p;
                    }.bind(this)
                }
            )
                .then(function (response) {
                    console.log(response.data);
                    currentObj.errorFS[index].image = response.data.fail;
                    currentObj.errorFS[index].image = response.data.success;
                    currentObj.about_paragraphs[index].image = response.data.name;
                })
                .catch(function (error) {
                    currentObj.output[index] = error;
                });
        },
    }
}


</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
