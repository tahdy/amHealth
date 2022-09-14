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
            <h3 class="pt-2">{{ __('Patients') }}</h3>

            <div class="input-group mt-3 mb-3">
                <input v-model="finds" @keyup="get_patients" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('full name') }}</th>
                        <th scope="col">{{ __('is_insurance') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('phone') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="patients &&editFields">
                    <tr v-for="(patient,index) in filterBy(patients, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span v-if="patient.user">
                           <router-link :to="{name:'patient', params: { id: patient.id }}">{{ patient.user.fullname }}</router-link>
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ patient.is_insurance }}
                        </span>
                        </td>

                        <td>
                        <span v-if="patient.user">
                            {{ patient.user.email }}
                        </span>
                        </td>
                        <td>
                        <span v-if="patient.user">
                            {{ patient.user.phone }}
                        </span>
                        </td>

                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                       <a   class="btn w3-teal btn-xs pull-right" @click="showModal(index)"><i class="fa fa-edit"></i></a>


                        <a v-if="patient.id" class="btn btn-danger"
                                   @click.prevent="delpatient(index)">{{ __('Del') }}</a>
                            </div>
                            <div :id="'exampleModal'+index" aria-hidden="true" aria-labelledby="exampleModalLabel"
                                 class="modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <Form v-slot="{ meta,errors }" class="form-horizontal form_register"
                                              enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ __('Edit Patient\'s Details' ) }}</h5>
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
                                                    <input class="form-check-input" type="checkbox"  v-model="patient.is_insurance"     :id="'defaultCheck1'+index" />
                                                    <label class="form-check-label" :for="'defaultCheck1'+index" style="padding-right: 40px;padding-left: 10px">
                                                        {{ __('is_insurance') }}
                                                    </label>
                                                </div>
                                                <div class="mb-3" v-if="patient.is_insurance==1">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('insurance_responsible:')
                                                        }}</label>
                                                    <Field
                                                        id="specialty" v-model="patient.insurance_responsible"
                                                        :data-vv-as="__('insurance_responsible')"
                                                        class="form-control w3-text-red" name="insurance_responsible" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="insurance_responsible"/>
                                                </div>
                                                <div class="mb-3" v-if="patient.is_insurance==1">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('insurance_id:')
                                                        }}</label>
                                                    <Field
                                                        id="specialty" v-model="patient.insurance_id"
                                                        :data-vv-as="__('insurance_id')"
                                                        class="form-control w3-text-red" name="insurance_id" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="insurance_id"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Info:')
                                                        }}</label>
                                                    <Field as="textarea" id="info" v-model="patient.info"
                                                           :data-vv-as="__('info')"
                                                           class="form-control w3-text-red  "
                                                           name="info" required
                                                           rules="required"
                                                           type="text"/>
                                                    <ErrorMessage class="text-danger" name="info"/>

                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                                    {{ __('Close') }}
                                                </button>
                                                <button v-if="!patient.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="addpatient(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="patient.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="editpatient(index)">{{ __('Save changes') }}
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
                <pagination v-model="page" :records="count" :per-page="15" @paginate="get_patients"/>

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
    name: "patients",

    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            patients: [],
            editFields: [],
            finds: '',
            success: [],
            fail: [],
            output: [],
            myModal: null,
            departments:[],
            lang:_locale,

            //patient:auth_patient,
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
        this.get_patients();
        this.get_patients_count();

    }
    ,
    methods: {

        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_patients() {
            this.patients=[];
            this.wating = true;
            if (this.finds){
                this.page=1;
            }
            axios.get('/api/getpatients?page=' + this.page+'&&search=' +this.finds)
                .then(response => {
                    this.patients = response.data.data;

                    this.loading = false;
                    this.wating = false

                }).catch((err) => alert('there is an error try again,or Refresh page'));

            this.loading = false;
        },
    get_patients_count() {
        axios.get('/api/getpatientscount/')
            .then(response => {
                this.count = response.data;

          this.loading = false;
            }).catch((err) => alert('there is an error try again,or Refresh page'));

        this.loading = false;
    }, editpatient(index) {

            axios.put('/api/editpatient/' + this.patients[index].id, {
                info: this.patients[index].info,
                is_insurance: this.patients[index].is_insurance,
                insurance_responsible: this.patients[index].insurance_responsible,
                insurance_id: this.patients[index].insurance_id
            })
                .then((response) => {
                    console.log('sucess');
                    this.patients[index]=response.data.patient;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },
        delpatient(x) {
            let d = this.patients[x];
            axios.delete('/api/deletepatient/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        patient: this.patient,
                        notification: response.data.notification.notification
                    });
                    this.patients.splice(x, 1);
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
