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
            <h3 class="pt-2">{{ __('Main Page Data') }}</h3>
            <div class="input-group mt-3 mb-3">
                <input v-model="finds" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('headline') }}</th>
                        <th scope="col">{{ __('headline_ar') }}</th>
                        <th scope="col">{{ __('section') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="datas &&editFields">
                    <tr v-for="(data,index) in filterBy(datas, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span >
                            {{ data.headline }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ data.headline_ar }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ __(data.section) }}
                        </span>
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
<!--                                  <button v-if="!data.id"
                                        class="btn btn-primary" @click="showModal(index)"
                                        type="button">
                                    {{ __('Add') }}
                                </button>-->
                                <button v-if="data.id"
                                        class="btn btn-warning" @click="showModal(index)"
                                         type="button">
                                    {{ __('Edit') }}
                                </button>
<!--
                                <a v-if="data.id" class="btn btn-danger"
                                   @click.prevent="deldata(index)">{{ __('Del') }}</a>
                                <a v-if="!data.id" class="btn btn-danger"
                                   @click.prevent="removeItem(index)">{{ __('Del') }}</a>-->

                            </div>
                            <div :id="'exampleModal'+index" aria-hidden="true" aria-labelledby="exampleModalLabel"
                                 class="modal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <Form v-slot="{ meta,errors }" class="form-horizontal form_register"
                                              enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">{{ __('Main Page Data') }}</h5>
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
<!--
                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="recipient-name">{{ __('Section:') }}</label>
                                                    <Multiselect id="icon" disabled
                                                                 v-model="__(data.section)"
                                                                 :options="[ { section: __('Main Section') },{ section: __('Why Us Section')},
                                                                             { section: __('About Section') }, { section: __('Counts Section')},
                                                                             { section: __('Services Section') },{ section: __('Appointment Section')},
                                                                             { section: __('Departments Section') }, { section: __('Doctors Section') } ,
                                                                              { section: __('Questions Section') },{ section: __('Contact Section') }
                                                                              ,{ section: __('Gallery Section') }
                                                                             ]"
                                                                 :placeholder="__('Select an section')"
                                                                 label="name"
                                                                 value-prop="section">
                                                        <template v-slot:singlelabel="{ value }">
                                                            <div class="multiselect-single-label">
                                                                {{__(value.section)}}
                                                            </div>
                                                        </template>

                                                        <template v-slot:option="{ option }">
                                                            {{__(option.section)}}                                                        </template>
                                                    </Multiselect>
                                                </div>
-->

                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('Headline:')
                                                        }}</label>
                                                    <Field
                                                        id="headline" v-model="data.headline"
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
                                                    <Field as="textarea" id="paragraph" v-model="data.paragraph"
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
                                                        id="headline_ar" v-model="data.headline_ar"
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
                                                           v-model="data.paragraph_ar"
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
                                                <button v-if="!data.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="adddata(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="data.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="editdata(index)">{{ __('Save changes') }}
                                                </button>
                                            </div>
                                        </Form>

                                    </div>
                                </div>
                            </div>
                            </div>
                        </td>

                    </tr>

<!--                    <tr>
                        <td colspan="5">
                            <button class="btn btn-info" type="button" @click.prevent="InsertRow()">
                                +{{ __('Add data') }}
                            </button>
                        </td>

                    </tr>-->
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
                    data: 'العنوان بالانجليزية',
                    answer: 'المحتوى بالانجليزية',
                    answer_ar: 'المحتوى بالعربية',
                    data_ar: 'العنوان بالعربية',
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
    name: "datas",
    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            datas: [],
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
        this.get_datas();
    }
    ,
    methods: {
        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_datas() {
            this.loading = true;

            axios.get('/api/getpage_datas/')
                .then(response => {
                    this.datas = response.data;
                    let len = this.datas.length;
                    for (let i = 0; i < len; i++) {
                        this.files.push(Object.assign({}, null));
                        this.success.push(Object.assign({}, null));
                        this.fail.push(Object.assign({}, null));
                        this.uploaded.push(Object.assign({}, 0));
                        this.output.push(Object.assign({}, ''));

                        this.errorFS.push(Object.assign({}, {
                            'section':'',
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
        adddata(index) {
            axios.post('/api/addpage_data', {
                headline: this.datas[index].headline,
                paragraph_ar: this.datas[index].paragraph_ar,
                headline_ar: this.datas[index].headline_ar,
                paragraph: this.datas[index].paragraph,
                section: this.datas[index].section,

            })
                .then((response) => {
                    this.datas[index] = response.data.att;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        }, editdata(index) {

            axios.put('/api/editpage_data/' + this.datas[index].id, {
                headline: this.datas[index].headline,
                paragraph_ar: this.datas[index].paragraph_ar,
                headline_ar: this.datas[index].headline_ar,
                paragraph: this.datas[index].paragraph,
                section: this.datas[index].section,

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
                section:'',
            };
            this.datas.push(my_object);
            this.errorFS.push(Object.assign({}, {
                'section':'',
                'headline':'',
                'paragraph':'',
                'headline_ar':'',
                'paragraph_ar':'',

            }));


        },
        deldata(x) {
            let d = this.datas[x];
            axios.delete('/api/deletepage_data/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        user: this.user,
                        notification: response.data.notification.notification
                    });
                    this.datas.splice(x, 1);
                    this.errorFS.splice(x, 1);
                }).catch(error => {
                if (error.response.status === 422) {
                    this.error = error.response.data.message;
                } else {
                    alert('Unkown error!')
                }
            });
        }, removeItem(x) {
            this.datas.splice(x, 1);
            this.errorFS.splice(x, 1);

        },

    }
}


</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
