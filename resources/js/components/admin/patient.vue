<template>
<div v-if="patient.user" class="container-fluid" style="margin-top:20px;">

    <div class="row clearfix ">
        <div class="col-lg-4 col-md-12" >
            <div class="card border-light text-center " >
               <div style="background: linear-gradient(180deg, #F48585 50%, #ffff 50%);">
                   <div class="header l-coral " style="margin-top:20px;">
                       <h4 class="m-t-10 text-light">{{ patient.user.fullname }}</h4>
                   </div>
                   <div class="member-img" style="position: relative;margin-top:20px;margin-bottom:20px;">
                       <a href="patient-invoice.html">
                           <img :src="patient.user.image" class="rounded-circle" alt="profile-image" style="width: 150px;border: 1px solid #fff;box-shadow: 0 10px 25px 0 rgb(0 0 0 / 30%);">
                       </a>
                   </div>
               </div>

                <div class="body p-3">
                    <div class="col-12">
                        <div class="d-block  social-links d-flex justify-content-center">
                            <a :href="patient.user.twitter" class="twitter p-1" >
                                <i class="bi bi-twitter"></i></a>
                            <a :href="patient.user.facebook" class="facebook p-1"><i class="bi bi-facebook"></i></a>
                            <a :href="patient.user.twitter" class="instagram p-1"><i class="bi bi-instagram"></i></a>
                            <a :href="patient.user.twitter" class="linkedin p-1"><i class="bi bi-linkedin"></i></a></div>
                    </div>
                    <hr>
                    <strong>Occupation</strong>
                    <p>{{ patient.occupation }}</p>
                    <strong>Email ID</strong>
                    <p>{{ patient.user.email }}</p>
                    <strong>Phone</strong>
                    <p>{{ patient.user.phone }}</p>
                    <hr>
                    <strong>Address</strong>
                    <address>{{ patient.user.address }}</address>
                </div>
            </div>
            <div class="card border-light p-2">
                <div class="header">
                    <h2>General Report</h2>
                </div>
                <div class="body ">
                    <ul class="list-unstyled">
                        <li>
                            <div>Blood Pressure</div>
                            <div class="progress m-b-20">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                            </div>
                        </li>
                        <li>
                            <div>Heart Beat</div>
                            <div class="progress m-b-20">
                                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                            </div>
                        </li>
                        <li>
                            <div>Haemoglobin</div>
                            <div class="progress m-b-20">
                                <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                            </div>
                        </li>
                        <li>
                            <div>Sugar</div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card border-light">
                <div class="body p-3">
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="activity">
                            <p>{{patient.info }}</p>

                            <div class="timeline">
                                <a   class="btn  btn-xs btn-outline-success m-4  pull-right" @click="showModal(null)">{{ __('+ Add Visit')}}</a>

                                <div v-for="(visit,index) in filterBy(visits, finds)">
                                    <div class="timeline-container ">
                                        <div class="content">
                                            <h5 class="text-primary">{{moment(visit.visit_date).calendar()  }}
                                                <a   class="btn w3-teal btn-xs pull-right" @click="showModal(index)"><i class="fa fa-edit"></i></a></h5>
                                            <hp class="text-success">{{ __('Examination for:') }} {{visit.Diseases}} <span class="text-primary float-end">{{ __('Assigned Doctor:') }}{{visit.doctor.user.fullname}} </span></hp>
                                            <p>{{ visit.info }}</p>
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">{{ __('Important measurements:') }} </h5>
                                                    <p class="card-text">{{ __('blood pressure:')  }}{{ visit.blood_pressure }}</p>
                                                    <p class="card-text">{{ __('heart rate:')  }}{{ visit.heart_rate }}</p>
                                                    <p class="card-text">{{ __('glucose level:')  }}{{ visit.glucose_level }}</p>
                                                    <p class="card-text">{{ __('blood pressure:')  }}{{ visit.blood_pressure }}</p>
                                                    <p class="card-text">{{ __('blood count:')  }}{{ visit.blood_count }}</p>
                                                </div>
                                            </div>
                                            <img :src="visit.prescription" class="p-2"  alt="profile-image" style="max-width: 650px">
                                            <div :id="'exampleModal'+index" aria-hidden="true" aria-labelledby="exampleModalLabel"
                                                 class="modal" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-scrollable">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <Form v-slot="{ meta,errors }" class="form-horizontal form_register"
                                                                  enctype="multipart/form-data">
                                                                <div class="modal-header">
                                                                    <h5 id="exampleModalLabel" class="modal-title">{{ __('Edit Visit' ) }}</h5>
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
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('Info:')
                                                                            }}</label>
                                                                        <Field as="textarea" id="info" v-model="visit.info"
                                                                               :data-vv-as="__('info')"
                                                                               class="form-control w3-text-red  "
                                                                               name="info" required
                                                                               rules="required"
                                                                               type="text"/>
                                                                        <ErrorMessage class="text-danger" name="info"/>

                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('visit_date:')
                                                                            }}</label>
                                                                        <Datepicker v-model="visit.visit_date"></Datepicker>
                                                                    </div>
                                                                    <div class="mb-3" >
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('prescription:')
                                                                            }}</label>
                                                                        <div class="w3-row-padding custom-file " v-if="!visit.prescription">
                                                                            <Field id="file" type="file" class="custom-file-input" name="prescription"   @change="onFileChangeEdit($event,index)"   :data-vv-as="'File '" required />
                                                                            <label class="custom-file-label" for="file">{{ __('Upload prescription') }}</label>
                                                                            <div v-if="files[index]" class="progress">
                                                                                <div class="progress-bar progress-bar-striped w3-teal" :style="{ width: uploadeds[index]+ '%' }"></div>
                                                                            </div>
                                                                            <ErrorMessage class="text-danger" name="prescription" />
                                                                        </div>
                                                                        <div class="w3-row-padding" v-if="visit.prescription">
                                                                            <img :src="visit.prescription"  style="width: 150px;height: 150px" />
                                                                            <button @click.prevent="EditremoveFile($event,index)">{{ __('Remove prescription') }}</button>
                                                                        </div>
                                                                        <p class="text-danger">{{__(fail)}}</p>
                                                                        <div class="mb-3" >
                                                                            <label class="col-form-label" for="message-text">{{
                                                                                    __('blood_pressure:')
                                                                                }}</label>
                                                                            <Field
                                                                                id="specialty" v-model="visit.blood_pressure"
                                                                                :data-vv-as="__('blood_pressure')"
                                                                                class="form-control w3-text-red" name="blood_pressure" required
                                                                                rules="required"
                                                                                type="text"/>
                                                                            <ErrorMessage class="text-danger" name="blood_pressure"/>
                                                                        </div></div>
                                                                    <div class="mb-3" >
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('heart_rate:')
                                                                            }}</label>
                                                                        <Field
                                                                            id="specialty" v-model="visit.heart_rate"
                                                                            :data-vv-as="__('heart_rate')"
                                                                            class="form-control w3-text-red" name="heart_rate" required
                                                                            rules="required"
                                                                            type="text"/>
                                                                        <ErrorMessage class="text-danger" name="heart_rate"/>
                                                                    </div>

                                                                    <div class="mb-3" >
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('glucose_level:')
                                                                            }}</label>
                                                                        <Field
                                                                            id="specialty" v-model="visit.glucose_level"
                                                                            :data-vv-as="__('glucose_level')"
                                                                            class="form-control w3-text-red" name="glucose_level" required
                                                                            rules="required"
                                                                            type="text"/>
                                                                        <ErrorMessage class="text-danger" name="glucose_level"/>
                                                                    </div>
                                                                    <div class="mb-3" >
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('blood_count:')
                                                                            }}</label>
                                                                        <Field
                                                                            id="specialty" v-model="visit.blood_count"
                                                                            :data-vv-as="__('blood_count')"
                                                                            class="form-control w3-text-red" name="blood_count" required
                                                                            rules="required"
                                                                            type="text"/>
                                                                        <ErrorMessage class="text-danger" name="blood_count"/>
                                                                    </div>

                                                                    <div class="mb-3" >
                                                                        <label class="col-form-label" for="message-text">{{
                                                                                __('Diseases:')
                                                                            }}</label>
                                                                        <Field
                                                                            id="specialty" v-model="visit.Diseases"
                                                                            :data-vv-as="__('Diseases')"
                                                                            class="form-control w3-text-red" name="Diseases" required
                                                                            rules="required"
                                                                            type="text"/>
                                                                        <ErrorMessage class="text-danger" name="Diseases"/>
                                                                    </div>
                                                                    <div class="mb-3" >
                                                                        <Multiselect v-model="visit.doctor_id"   :close-on-select="true"
                                                                                     :options="options" :search="true" label="id" mode="single"  value-prop="id"
                                                                                     placeholder="Select  Doctors"   track-by="id" >

                                                                            <template v-slot:singlelabel="{ value }">
                                                                                <div class="multiselect-single-label">
                                                                                    <img class="character-label-icon" :src="value.user.image"> {{ value.user.fullname }}
                                                                                </div>
                                                                            </template>
                                                                            <template v-slot:option="{ option }">
                                                                                <img class="user-image" :src="option.user.image"> {{ option.user.fullname }}
                                                                            </template>
                                                                        </Multiselect>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                                                        {{ __('Close') }}
                                                                    </button>
                                                                    <button
                                                                            :disabled="Object.keys(errors).length||!meta.dirty"
                                                                            class="btn btn-primary"
                                                                            type="button"
                                                                            @click.prevent="editvisit(index)">{{ __('Save') }}
                                                                    </button>

                                                                </div>
                                                            </Form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>

                        <div class="card mb-0 mt-4 no-border">
                            <div class="card-header custom-header" >
                                Billings</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover  ">
                                        <thead  >
                                        <tr class="bg-primary text-white" style="background: #1977cc">
                                            <th scope="col" class="text-nowrap">Bill NO</th>
                                            <th scope="col">Patient</th><th scope="col">Doctor</th>
                                            <th scope="col">Date</th><th scope="col">Charger</th>
                                            <th scope="col">Tax</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-light">
                                        <tr>
                                            <td><div class="text-muted">138</div></td>
                                            <td>Liam Jouns</td>
                                            <td><div class="text-nowrap">Dr. Sophie</div></td>
                                            <td><div class="text-nowrap text-muted">18 Dec 2019</div></td>
                                            <td>$155</td>
                                            <td>10%</td>
                                            <td>$5</td>
                                            <td>$160</td>
                                        </tr>
                                        <tr>
                                            <td><div class="text-muted">137</div></td>
                                            <td>Liam Jouns</td>
                                            <td><div class="text-nowrap">Dr. Liam</div></td>
                                            <td><div class="text-nowrap text-muted">5 Oct 2019</div></td>
                                            <td>$155</td>
                                            <td>10%</td>
                                            <td>$5</td>
                                            <td>$160</td>
                                        </tr><tr><td>
                                            <div class="text-muted">136</div></td>
                                            <td>Liam Jouns</td>
                                            <td><div class="text-nowrap">Dr. Noah</div></td>
                                            <td><div class="text-nowrap text-muted">1 Oct 2019</div></td>
                                            <td>$155</td>
                                            <td>10%</td><td>$5</td><td>$160</td></tr><tr><td><div class="text-muted">135</div></td><td>Liam Jouns</td><td><div class="text-nowrap">Dr. Sophie</div></td><td><div class="text-nowrap text-muted">23 Sep 2019</div></td><td>$155</td><td>10%</td><td>$5</td><td>$160</td></tr><tr><td><div class="text-muted">134</div></td><td>Liam Jouns</td><td><div class="text-nowrap">Dr. Emma</div></td><td><div class="text-nowrap text-muted">10 Jul 2019</div></td><td>$155</td><td>10%</td><td>$5</td><td>$160</td></tr><tr><td><div class="text-muted">133</div></td><td>Liam Jouns</td><td><div class="text-nowrap">Dr. Emma</div></td><td><div class="text-muted">9 Jul 2019</div></td><td>$155</td><td>10%</td><td>$5</td><td>$160</td></tr><tr><td><div class="text-muted">132</div></td><td>Liam Jouns</td><td><div class="text-nowrap">Dr. Sophie</div></td><td><div class="text-muted">30 Mar 2019</div></td><td>$155</td><td>10%</td><td>$5</td><td>$160</td></tr></tbody></table></div></div></div>                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exModal" aria-hidden="true" aria-labelledby="exampleModalLabel"
         class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">

            <div class="modal-dialog">
                <div class="modal-content">
                    <Form v-slot="{ meta,errors }" ref="add" class="form-horizontal form_register"
                          enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{ __('Add Visit To Patient' ) }}</h5>
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
                                <label class="col-form-label" for="message-text">{{
                                        __('Info:')
                                    }}</label>
                                <Field as="textarea" id="info" v-model="info"
                                       :data-vv-as="__('info')"
                                       class="form-control w3-text-red  "
                                       name="info" required
                                       rules="required"
                                       type="text"/>
                                <ErrorMessage class="text-danger" name="info"/>

                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="message-text">{{
                                        __('visit_date:')
                                    }}</label>
                                <Datepicker v-model="visit_date" format="Y-m-d H:i:s"></Datepicker>
                            </div>
                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('prescription:')
                                    }}</label>
                            <div class="w3-row-padding custom-file " v-if="!prescription">
                                <Field id="file" type="file" class="custom-file-input" name="prescription"   @change="onFileChange($event)"   :data-vv-as="'File '" required />
                                <label class="custom-file-label" for="file">{{ __('Upload prescription') }}</label>
                                <div v-if="file" class="progress">
                                    <div class="progress-bar progress-bar-striped w3-teal" :style="{ width: uploaded+ '%' }"></div>
                                </div>
                                <ErrorMessage class="text-danger" name="prescription" />
                            </div>
                            <div class="w3-row-padding" v-if="prescription">
                                <img :src="prescription"  style="width: 150px;height: 150px" />
                                <button @click.prevent="removeFile($event)">{{ __('Remove prescription') }}</button>
                            </div>
                            <p class="text-danger">{{__(fail)}}</p>
                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('blood_pressure:')
                                    }}</label>
                                <Field
                                    id="specialty" v-model="blood_pressure"
                                    :data-vv-as="__('blood_pressure')"
                                    class="form-control w3-text-red" name="blood_pressure" required
                                    rules="required"
                                    type="text"/>
                                <ErrorMessage class="text-danger" name="blood_pressure"/>
                            </div></div>
                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('heart_rate:')
                                    }}</label>
                                <Field
                                    id="specialty" v-model="heart_rate"
                                    :data-vv-as="__('heart_rate')"
                                    class="form-control w3-text-red" name="heart_rate" required
                                    rules="required"
                                    type="text"/>
                                <ErrorMessage class="text-danger" name="heart_rate"/>
                            </div>

                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('glucose_level:')
                                    }}</label>
                                <Field
                                    id="specialty" v-model="glucose_level"
                                    :data-vv-as="__('glucose_level')"
                                    class="form-control w3-text-red" name="glucose_level" required
                                    rules="required"
                                    type="text"/>
                                <ErrorMessage class="text-danger" name="glucose_level"/>
                            </div>
                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('blood_count:')
                                    }}</label>
                                <Field
                                    id="specialty" v-model="blood_count"
                                    :data-vv-as="__('blood_count')"
                                    class="form-control w3-text-red" name="blood_count" required
                                    rules="required"
                                    type="text"/>
                                <ErrorMessage class="text-danger" name="blood_count"/>
                            </div>

                            <div class="mb-3" >
                                <label class="col-form-label" for="message-text">{{
                                        __('Diseases:')
                                    }}</label>
                                <Field
                                    id="specialty" v-model="Diseases"
                                    :data-vv-as="__('Diseases')"
                                    class="form-control w3-text-red" name="Diseases" required
                                    rules="required"
                                    type="text"/>
                                <ErrorMessage class="text-danger" name="Diseases"/>
                            </div>
                            <div class="mb-3" >
                                <Multiselect v-model="doctor"   :close-on-select="true"
                                             :options="options" :search="true" label="id" mode="single"  value-prop="id"
                                             placeholder="Select  Doctors"   track-by="id" >

                                        <template v-slot:singlelabel="{ value }">
                                            <div class="multiselect-single-label">
                                                <img class="character-label-icon" :src="value.user.image"> {{ value.user.fullname }}
                                            </div>
                                        </template>
                                    <template v-slot:option="{ option }">
                                        <img class="user-image" :src="option.user.image"> {{ option.user.fullname }}
                                    </template>
                                </Multiselect>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                {{ __('Close') }}
                            </button>

                            <button
                                    :disabled="Object.keys(errors).length"
                                    class="btn btn-primary"
                                    type="button"
                                    @click.prevent="addvisit()">{{ __('Save changes') }}
                            </button>
                        </div>
                    </Form>

                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import Multiselect from '@vueform/multiselect'
import Vue2Filters from 'vue2-filters'
import _ from 'lodash'
var moment = require('moment');
import {Field, Form, ErrorMessage, defineRule, configure} from 'vee-validate';
import {required} from '@vee-validate/rules';
import {localize} from '@vee-validate/i18n';

import en from '@vee-validate/i18n/dist/locale/en.json';
import ar from '@vee-validate/i18n/dist/locale/ar.json';
import Pagination from 'v-pagination-3';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

defineRule('required', required);
import __ from "lodash/fp/__";

if (_locale === 'ar') {
    moment.locale('ar');

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
    moment.locale('en');

    configure({

        generateMessage: localize({
            en,
        }),
    });

}
export default {
    name: "patient",
    props:['id'],
data() {
    return {
        loading: true,
        error: null,
        moment: moment,

        errorFS: [],
        patient: [],
        editFields: [],
        finds: '',
        success: '',
        fail: '',
        output: '',
        successs: [],
        fails: [],
        outputs: [],
        myModal: null,
        departments:[],
        lang:_locale,
        doctor:null,
        options:[],
        visits:[],
        visit_date:'',

        info: '',
        blood_pressure: '',
        heart_rate: '',
        glucose_level: '',
        blood_count: '',
        Diseases: '',
        prescription: null,
        file: null,

        //patient:auth_patient,
        files: [],
        uploaded: '',
        uploadeds: [],
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
        Datepicker
},
    computed: {
        isCompleted () {

            return this.info && this.blood_pressure && this.heart_rate &&this.glucose_level && this.blood_count
                && this.Diseases && this.prescription;
        }

    },
mounted() {
this.get_patient();
    this.get_doctors();

},
methods: {

    get_patient() {
        this.patient=[];
        this.wating = true;

        axios.get('/api/getpatient/'+this.$route.params.id)
            .then(response => {
                this.patient = response.data.user;
                this.visits = response.data.visits;
                this.loading = false;
                this.wating = false
                let len = this.visits.length;
                for (let i = 0; i < len; i++) {

                    this.files.push(Object.assign({}, null));
                }
            }).catch((err) => alert('there is an error try again,or Refresh page'));

        this.loading = false;
    },
    get_doctors() {
        this.doctors=[];
        this.wating = true;
        if (this.finds){
            this.page=1;
        }
        axios.get('/api/getdoctors?page=' + this.page+'&&search=' +this.finds)
            .then(response => {
                this.options = response.data.data;

                this.loading = false;
                this.wating = false

            }).catch((err) => alert('there is an error try again,or Refresh page'));

        this.loading = false;
    },
    showModal(index){
        if (index==null){
            this.myModal = new bootstrap.Modal(document.getElementById('exModal'), {});

        }else {
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});

        }
        this.myModal.show();
    }
    ,
    onFileChange(e) {
        this.file = e.target.files[0];
        this.submitForm(e);
    }
    ,

    submitForm(e) {
        let f=this.file;
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
        formData.append('path', 'images/prescription/');

// send upload request
        axios.post('/api/store_file', formData,
            {
                onUploadProgress: function( progressEvent ) {
                    //console.log('soso')
                    let vm=this;
                    let p=parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ));

                    this.uploaded=p;
                }.bind(this)
            }

        )
            .then(function (response) {
                console.log(response.data);
                currentObj.fail = response.data.fail;
                currentObj.success = response.data.success;
                currentObj.prescription = response.data.name;
            })
            .catch(function (error) {
                currentObj.output = error;
            });
    },
    onFileChangeEdit(e,index) {
        this.files[index] = e.target.files[0];
        this.submitFormEdit(e,index);
    }
    ,

    submitFormEdit(e,index) {
        let f=this.files[index];
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
        formData.append('path', 'images/prescription/');

// send upload request
        axios.post('/api/store_file', formData,
            {
                onUploadProgress: function( progressEvent ) {
                    //console.log('soso')
                    let vm=this;
                    let p=parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ));

                    this.uploadeds[index]=p;
                }.bind(this)
            }

        )
            .then(function (response) {
                console.log(response.data);
                currentObj.fails[index] = response.data.fail;
                currentObj.successs[index] = response.data.success;
                currentObj.visits[index].prescription = response.data.name;
            })
            .catch(function (error) {
                currentObj.outputs[index] = error;
            });
    },
    removeFile: function (e) {
        axios.delete('/api/delfile', {params:{path: this.image}})
            .then((response) => {
                this.prescription = '';
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    },
    EditremoveFile: function (e,index) {
        axios.delete('/api/delfile', {params:{path: this.visits[index].prescription}})
            .then((response) => {
                this.visits[index].prescription = '';
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    }
    , addvisit(index) {
        axios.post('/api/addvisit/', {
            info:this.info ,
            blood_pressure:this.blood_pressure ,
            heart_rate: this.heart_rate,
            glucose_level: this.glucose_level,
            blood_count: this.blood_count,
            Diseases: this.Diseases,
            prescription: this.prescription,
            doctor_id: this.doctor,
            patient_id: this.patient.id,
            visit_date: this.visit_date,

        })
            .then((response) => {
                console.log('sucess');
                this.visits.push(response.data.att);
                this.myModal.hide();
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    },
    editvisit(index) {
        axios.put('/api/editvisit/' + this.patient.visits[index].id, {
            info:this.visits[index].info ,
            blood_pressure:this.visits[index].blood_pressure ,
            heart_rate: this.visits[index].heart_rate,
            glucose_level: this.visits[index].glucose_level,
            blood_count: this.visits[index].blood_count,
            Diseases: this.visits[index].Diseases,
            prescription: this.visits[index].prescription,
            doctor_id: this.visits[index].doctor_id,
            patient_id: this.patient.id,
            visit_date: this.visits[index].visit_date,

        })
            .then((response) => {
                console.log('sucess');
                this.patient.visits[index]=response.data;
                this.myModal.hide();
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    },
    delvisit(x) {
        let d = this.patient.visits[x];
        axios.delete('/api/deletevisit/' + d.id)
            .then((response) => {
                this.$emit('notification', {
                    doctor: this.patient.visits[x],
                    notification: response.data.notification.notification
                });
                this.patient.visits.splice(x, 1);
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
/* The actual timeline (the vertical ruler) */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
    content: '';
    position: absolute;
    width: 3px;
    background-color: lightgrey;
    top: 0;
    bottom: 0;
    left: 0%;
    margin-left: 2px;
}

/* Container around content */
.timeline-container {
    padding: 10px 40px;
    position: relative;
    background-color: inherit;
}

/* The circles on the timeline */
.timeline-container::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    left: -8px;
    background-color: white;
    border: 4px solid #FF9F55;
    top: 15px;
    border-radius: 50%;
    z-index: 1;
}

/* Place the container to the left */
.left {
    left: 0;
}

/* Place the container to the right */
.right {
    left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    right: 30px;
    border: medium solid white;
    border-width: 10px 0 10px 10px;
    border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    left: 30px;
    border: medium solid white;
    border-width: 10px 10px 10px 0;
    border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
    left: -16px;
    margin-left: 6px;

}

/* The actual content */
.content {
    padding: 0px 0px;
    background-color: white;
    position: relative;
    border-radius: 6px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
    /* Place the timelime to the left */
    .timeline::after {
        left: 31px;
    }

    /* Full-width containers */
    .timeline-container {
        width: 100%;
        padding-left: 50px;
        padding-right: 25px;
    }

    /* Make sure that all arrows are pointing leftwards */
    .timeline-container::before {
        left: 60px;
        border: medium solid white;
        border-width: 10px 10px 10px 0;
        border-color: transparent white transparent transparent;
    }

    /* Make sure all circles are at the same spot */
    .left::after, .right::after {
        left: 15px;
    }

    /* Make all right containers behave like the left ones */
    .right {
        left: 0%;
    }
}
.table tr {
    transition: background .2s ease-in-out,border .2s ease-in-out,box-shadow .2s ease-in-out,color .2s ease-in-out;
    will-change: background,border,box-shadow,color;
    width: 100%;
    border-bottom-color: #fff;

}
.table>:not(:last-child)>:last-child>* {
    border-bottom-color: #fff;
}
.table>tbody {
    vertical-align: inherit;
}
.table.table-hover tbody tr {
    background: none;
    color: inherit;
}
.custom-header{
    background: none;
    border: 0;
    font-size: 2rem;
    font-weight: 500;
    margin: 0;
    padding: 0;
}
.no-border{
    border: 0;

}
.multiselect-tag.is-user {
    padding: 5px 8px;
    border-radius: 22px;
    background: #35495e;
    margin: 3px 3px 8px;
}
.multiselect-tag.is-user img {
    width: 18px;
    border-radius: 50%;
    height: 18px;
    margin-right: 8px;
    border: 2px solid #ffffffbf;
}
.multiselect-tag.is-user i:before {
    color: #ffffff;
    border-radius: 50%;;
}
.user-image {
    margin: 0 6px 0 0;
    border-radius: 50%;
    height: 22px;
}
.character-option-icon {
    margin: 0 6px 0 0;
    height: 22px;
}
.character-label-icon {
    margin: 0 6px 0 0;
    height: 26px;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
