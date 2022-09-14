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
            <h3 class="pt-2">{{ __('question') }}</h3>
            <div class="input-group mt-3 mb-3">
                <input v-model="finds" :placeholder="__('Search...')" class="form-control" type="text">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('question') }}</th>
                        <th scope="col">{{ __('question_ar') }}</th>
                        <th scope="col">{{ __('actions') }}</th>

                    </tr>
                    </thead>
                    <tbody v-if="questions &&editFields">
                    <tr v-for="(question,index) in filterBy(questions, finds)">
                        <th>{{ index }}</th>

                        <td>
                        <span >
                            {{ question.question }}
                        </span>
                        </td>
                        <td>
                        <span >
                            {{ question.question_ar }}
                        </span>
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                  <button v-if="!question.id"
                                        class="btn btn-primary" @click="showModal(index)"
                                        type="button">
                                    {{ __('Add') }}
                                </button>
                                <button v-if="question.id"
                                        class="btn btn-warning" @click="showModal(index)"
                                         type="button">
                                    {{ __('Edit') }}
                                </button>

                                <a v-if="question.id" class="btn btn-danger"
                                   @click.prevent="delquestion(index)">{{ __('Del') }}</a>
                                <a v-if="!question.id" class="btn btn-danger"
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
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('question:')
                                                        }}</label>
                                                    <Field
                                                        id="question" v-model="question.question"
                                                        :data-vv-as="__('question')"
                                                        class="form-control w3-text-red" name="question" required
                                                        rules="required"
                                                        type="text"/>
                                                    <ErrorMessage class="text-danger" name="question"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label" for="message-text">{{
                                                            __('answer:')
                                                        }}</label>
                                                    <Field as="textarea" id="answer" v-model="question.answer"
                                                           :data-vv-as="__('answer')"
                                                           class="form-control w3-text-red  "
                                                           name="answer" required
                                                           rules="required"
                                                           type="text"/>
                                                    <ErrorMessage class="text-danger" name="answer"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="message-text">{{ __('question_ar:') }}</label>
                                                    <Field
                                                        id="question_ar" v-model="question.question_ar"
                                                        :data-vv-as="__('question_ar')"
                                                        class="form-control w3-text-red  "
                                                        name="question_ar" required
                                                        rules="required" type="text"/>
                                                    <ErrorMessage class="text-danger" name="question_ar"/>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label"
                                                           for="message-text">{{ __('answer_ar:') }}</label>
                                                    <Field id="answer_ar"  as="textarea"
                                                           v-model="question.answer_ar"
                                                           :data-vv-as="__('answer_ar')"
                                                           class="form-control w3-text-red  "
                                                           name="answer_ar" required
                                                           rules="required" type="text"/>
                                                    <ErrorMessage class="text-danger" name="answer_ar"/>

                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                                                    {{ __('Close') }}
                                                </button>
                                                <button v-if="!question.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="addquestion(index)">{{ __('Save') }}
                                                </button>
                                                <button v-if="question.id"
                                                        :disabled="Object.keys(errors).length||!meta.dirty"
                                                        class="btn btn-primary"
                                                        type="button"
                                                        @click.prevent="editquestion(index)">{{ __('Save changes') }}
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
                                +{{ __('Add question') }}
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
                    question: 'العنوان بالانجليزية',
                    answer: 'المحتوى بالانجليزية',
                    answer_ar: 'المحتوى بالعربية',
                    question_ar: 'العنوان بالعربية',
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
    name: "questions",
    data() {
        return {
            loading: true,
            error: null,
            errorFS: [],
            questions: [],
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
        this.get_questions();
    }
    ,
    methods: {
        showModal(index){
            this.myModal = new bootstrap.Modal(document.getElementById('exampleModal'+index), {});
            this.myModal.show();
        }
        ,get_questions() {
            axios.get('/api/getquestions/')
                .then(response => {
                    this.questions = response.data;
                    let len = this.questions.length;
                    for (let i = 0; i < len; i++) {
                        this.files.push(Object.assign({}, null));
                        this.success.push(Object.assign({}, null));
                        this.fail.push(Object.assign({}, null));
                        this.uploaded.push(Object.assign({}, 0));
                        this.output.push(Object.assign({}, ''));

                        this.errorFS.push(Object.assign({}, {
                            'question':'',
                            'answer':'',
                            'question_ar':'',
                            'answer_ar':'',
                        }));

                    }
                    this.loading = false;
                }).catch((err) => alert('there is an error try again,or Refresh page'));

            this.loading = false;
        },
        addquestion(index) {
            axios.post('/api/addquestion', {
                question: this.questions[index].question,
                answer_ar: this.questions[index].answer_ar,
                question_ar: this.questions[index].question_ar,
                answer: this.questions[index].answer,

            })
                .then((response) => {
                    this.questions[index] = response.data.att;
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        }, editquestion(index) {

            axios.put('/api/editquestion/' + this.questions[index].id, {
                question: this.questions[index].question,
                answer_ar: this.questions[index].answer_ar,
                question_ar: this.questions[index].question_ar,
                answer: this.questions[index].answer,

            })
                .then((response) => {
                    console.log('sucess');
                    this.myModal.hide()

                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },
        InsertRow() {
            var my_object = {
                question: '',
                answer: '',
                question_ar: '',
                answer_ar: '',


            };
            this.questions.push(my_object);
            this.errorFS.push(Object.assign({}, {
                'question':'',
                'answer':'',
                'question_ar':'',
                'answer_ar':'',

            }));


        },
        delquestion(x) {
            let d = this.questions[x];
            axios.delete('/api/deletequestion/' + d.id)
                .then((response) => {
                    this.$emit('notification', {
                        user: this.user,
                        notification: response.data.notification.notification
                    });
                    this.questions.splice(x, 1);
                    this.errorFS.splice(x, 1);
                }).catch(error => {
                if (error.response.status === 422) {
                    this.error = error.response.data.message;
                } else {
                    alert('Unkown error!')
                }
            });
        }, removeItem(x) {
            this.questions.splice(x, 1);
            this.errorFS.splice(x, 1);

        },

    }
}


</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
