<template>
    <div>
        <div v-if="loading" class="d-flex align-items-center justify-content-center m-5" style="height: 400px">
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
            <h3 class="pt-2">{{ __('Users') }}</h3>
            <router-link  :to="{ name: 'adduser'}" class="btn btn-outline-primary "><i class="fa fa-user-plus" aria-hidden="true"></i>
                {{__("Add User")}}</router-link>



            <div class="input-group mt-3 mb-3">
                <input v-model="finds" @keyup="get_users" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('full name') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('phone') }}</th>
                        <th scope="col">{{ __('role') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="users &&editFields">
                    <tr v-for="(user,index) in filterBy(users, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span >
                            {{ user.fullname }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ user.email }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ user.phone }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ user.role }}
                        </span>
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                  <button v-if="!user.id"
                                        class="btn btn-primary" @click="showModal(index)"
                                        type="button">
                                    {{ __('Add') }}
                                </button>
                       <router-link :to="{ name: 'edituser', params: { id: user.id }}"  class="btn w3-teal btn-xs pull-right"><i class="fa fa-edit"></i></router-link>


                        <a v-if="user.id" class="btn btn-danger"
                                   @click.prevent="deluser(index)">{{ __('Del') }}</a>
                                <a v-if="!user.id" class="btn btn-danger"
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
                                                <h5 id="exampleModalLabel" class="modal-title">{{ __('why Section') }}</h5>
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
                                                                 v-model="user.icon"
                                                                 :options="[ { icon: 'heartbeat' },{ icon: 'pills'},
                                                                             { icon: 'hospital-user' }, { icon: 'dna'},
                                                                             { icon: 'wheelchair' },{ icon: 'notes-medical'},
                                                                             { icon: 'gift' }, { icon: 'fingerprint' } ,
                                                                              { icon: 'atom' },
                                                                             { icon: 'images' }, { icon: 'cube-alt' } ,
                                                                              { icon: 'receipt' }
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
                                                            __('name:')
                                                        }}</label>
                                                    <Field
                                                        id="headline" v-model="user.name"
                                                        :data-vv-as="__('name')"
                                                        class="form-control w3-text-red" name="name" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="name"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('email:')
                                                        }}</label>
                                                    <Field
                                                        id="headline" v-model="user.email"
                                                        :data-vv-as="__('email')"
                                                        class="form-control w3-text-red" name="email" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="email"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Paragraph:')
                                                        }}</label>
                                                    <Field as="textarea" id="paragraph" v-model="user.paragraph"
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
                                                        id="headline_ar" v-model="user.headline_ar"
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
                                                           v-model="user.paragraph_ar"
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
                                                <button v-if="!user.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="adduser(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="user.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="edituser(index)">{{ __('Save changes') }}
                                                </button>
                                            </div>
                                        </Form>

                                    </div>
                                </div>
                            </div>
                            </div>
                        </td>

                    </tr>

                    </tbody>
                    <tbody v-if="wating">
                      <tr>
                        <td colspan="6">
                            <div  class="d-flex align-items-center justify-content-center  m-5"  style="height: 400px;">
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
                        </td>

                    </tr>

                    </tbody>
                </table>
                <pagination v-model="page" :records="count" :per-page="15" @paginate="get_users"/>

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
import Pagination from 'v-pagination-3';

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
    name: "users",

    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            users: [],
            editFields: [],
            finds: '',
            success: [],
            fail: [],
            output: [],
            myModal: null,

            //user:auth_user,
            files: [],
            uploaded: [],
            page: 1,
            count:0,
            wating:true,


        }
    },
    mixins: [Vue2Filters.mixin],

    components: {
        Multiselect,
        Form,
        Field,
        ErrorMessage,
        Pagination,
    },
    mounted() {
        this.get_users();
        this.get_users_count();
    }
    ,
    methods: {
        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_users() {
            this.users=[];
            this.wating = true;
            if (this.finds){
                this.page=1;
            }
            axios.get('/api/getusers?page=' + this.page+'&&search=' +this.finds)
                .then(response => {
                    this.users = response.data.data;
                    let len = this.users.length;
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
                    this.wating = false

                }).catch((err) => alert('there is an error try again,or Refresh page'));

            this.loading = false;
        },
    get_users_count() {
        axios.get('/api/getuserscount/')
            .then(response => {
                this.count = response.data;

          this.loading = false;
            }).catch((err) => alert('there is an error try again,or Refresh page'));

        this.loading = false;
    },
        adduser(index) {
            axios.post('/api/adduser', {
                headline: this.users[index].headline,
                paragraph_ar: this.users[index].paragraph_ar,
                headline_ar: this.users[index].headline_ar,
                paragraph: this.users[index].paragraph,
                icon: this.users[index].icon,

            })
                .then((response) => {
                    this.users[index] = response.data.att;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        }, edituser(index) {

            axios.put('/api/edituser/' + this.users[index].id, {
                headline: this.users[index].headline,
                paragraph_ar: this.users[index].paragraph_ar,
                headline_ar: this.users[index].headline_ar,
                paragraph: this.users[index].paragraph,
                icon: this.users[index].icon,

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
            this.users.push(my_object);
            this.errorFS.push(Object.assign({}, {
                'icon':'',
                'headline':'',
                'paragraph':'',
                'headline_ar':'',
                'paragraph_ar':'',

            }));


        },
        deluser(x) {
            let d = this.users[x];
            axios.delete('/api/deleteuser/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        user: this.user,
                        notification: response.data.notification.notification
                    });
                    this.users.splice(x, 1);
                    this.errorFS.splice(x, 1);
                }).catch(error => {
                if (error.response.status === 422) {
                    this.error = error.response.data.message;
                } else {
                    alert('Unkown error!')
                }
            });
        }, removeItem(x) {
            this.users.splice(x, 1);
            this.errorFS.splice(x, 1);

        },
        removeFile: function (e, index) {
            axios.delete('/api/delfile', {params: {path: this.users[index].image}})
                .then((response) => {
                    this.users[index].image = '';
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
                    currentObj.users[index].image = response.data.name;
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
