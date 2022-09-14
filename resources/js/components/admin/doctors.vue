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
            <h3 class="pt-2">{{ __('Doctors') }}</h3>

            <div class="input-group mt-3 mb-3">
                <input v-model="finds" @keyup="get_doctors" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('full name') }}</th>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('department') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('phone') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="doctors &&editFields">
                    <tr v-for="(doctor,index) in filterBy(doctors, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span v-if="doctor.user">
                            {{ doctor.user.fullname }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ doctor.specialty }}
                        </span>
                        </td>
                        <td>
                        <span v-if="doctor.department">
                            {{ doctor.department.name }}
                        </span>
                        </td>
                        <td>
                        <span v-if="doctor.user">
                            {{ doctor.user.email }}
                        </span>
                        </td>
                        <td>
                        <span v-if="doctor.user">
                            {{ doctor.user.phone }}
                        </span>
                        </td>

                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                       <a   class="btn w3-teal btn-xs pull-right" @click="showModal(index)"><i class="fa fa-edit"></i></a>


                        <a v-if="doctor.id" class="btn btn-danger"
                                   @click.prevent="deldoctor(index)">{{ __('Del') }}</a>
                            </div>
                            <div :id="'exampleModal'+index" aria-hidden="true" aria-labelledby="exampleModalLabel"
                                 class="modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <Form v-slot="{ meta,errors }" class="form-horizontal form_register"
                                              enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ __('Edit Doctor\'s Details' ) }}</h5>
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
                                                           for="recipient-name">{{ __('Department:') }}</label>
                                                    <Multiselect id="icon"
                                                                 v-model="doctor.department_id"
                                                                 :options="departments"
                                                                 :placeholder="__('Select a Department')"
                                                                 label="id"
                                                                 value-prop="id">
                                                        <template v-slot:singlelabel="{ value }">
                                                            <div class="multiselect-single-label">
                                                                <p v-if="lang==='en'">{{ value.name }}</p>
                                                                <p v-if="lang==='ar'">{{ value.name_ar }}</p>
                                                           </div>
                                                        </template>

                                                        <template v-slot:option="{ option }">
                                                            <p v-if="lang==='en'">{{ option.name }}</p>
                                                            <p v-if="lang==='ar'">{{ option.name_ar }}</p>

                                                        </template>
                                                    </Multiselect>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Specialty:')
                                                        }}</label>
                                                    <Field
                                                        id="specialty" v-model="doctor.specialty"
                                                        :data-vv-as="__('specialty')"
                                                        class="form-control w3-text-red" name="specialty" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="specialty"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Bio:')
                                                        }}</label>
                                                    <Field as="textarea" id="bio" v-model="doctor.bio"
                                                           :data-vv-as="__('bio')"
                                                           class="form-control w3-text-red  "
                                                           name="paragraph" required
                                                           rules="required"
                                                           type="text"/>
                                                    <ErrorMessage class="text-danger" name="bio"/>

                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                                    {{ __('Close') }}
                                                </button>
                                                <button v-if="!doctor.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="adddoctor(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="doctor.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="editdoctor(index)">{{ __('Save changes') }}
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
                <pagination v-model="page" :records="count" :per-page="15" @paginate="get_doctors"/>

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
    name: "doctors",

    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            doctors: [],
            editFields: [],
            finds: '',
            success: [],
            fail: [],
            output: [],
            myModal: null,
            departments:[],
            lang:_locale,

            //doctor:auth_doctor,
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
        this.get_doctors();
        this.get_doctors_count();
        this.get_departments();

    }
    ,
    methods: {
        get_departments(){
            axios.get('/api/getdepartments/')
                .then(response => {
                    this.departments = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_doctors() {
            this.doctors=[];
            this.wating = true;
            if (this.finds){
                this.page=1;
            }
            axios.get('/api/getdoctors?page=' + this.page+'&&search=' +this.finds)
                .then(response => {
                    this.doctors = response.data.data;

                    this.loading = false;
                    this.wating = false

                }).catch((err) => alert('there is an error try again,or Refresh page'));

            this.loading = false;
        },
    get_doctors_count() {
        axios.get('/api/getdoctorscount/')
            .then(response => {
                this.count = response.data;

          this.loading = false;
            }).catch((err) => alert('there is an error try again,or Refresh page'));

        this.loading = false;
    }, editdoctor(index) {

            axios.put('/api/editdoctor/' + this.doctors[index].id, {
                bio: this.doctors[index].bio,
                specialty: this.doctors[index].specialty,
                department_id: this.doctors[index].department_id
            })
                .then((response) => {
                    console.log('sucess');
                    this.doctors[index]=response.data.doctor;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },
        deldoctor(x) {
            let d = this.doctors[x];
            axios.delete('/api/deletedoctor/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        doctor: this.doctor,
                        notification: response.data.notification.notification
                    });
                    this.doctors.splice(x, 1);
                    this.errorFS.splice(x, 1);
                }).catch(error => {
                if (error.response.status === 422) {
                    this.error = error.response.data.message;
                } else {
                    alert('Unkown error!')
                }
            });
        }
    }
}


</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
