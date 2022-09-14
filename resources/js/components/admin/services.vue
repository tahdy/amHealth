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
        <div v-if="!loading" >
            <h3 class="pt-2">{{ __('Services') }}</h3>
            <div class="input-group mt-3 mb-3">
                <input type="text" class="form-control" :placeholder="__('Search...')" v-model="finds">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >{{__('icon')}}</th>
                        <th scope="col" >{{__('headline')}}</th>
                        <th scope="col" >{{__('paragraph')}}</th>
                        <th scope="col" >{{__('headline_ar')}}</th>
                        <th scope="col" >{{__('paragraph_ar')}}</th>
                        <th scope="col" >{{__('actions')}}</th>

                    </tr>
                    </thead>
                    <tbody v-if="services &&editFields">
                    <tr v-for="(service,index) in filterBy(services, finds)">
                        <th  >{{ index }}</th>
                        <td  >
                          <span class="field-value" v-show="!showField(index,'icon')"
                                @click="focusField(index,'icon')">
                                        <i class="text-primary" v-if="!service.icon">{{__('Add Icon')}}</i>
                                        <i class="text-primary" :class="'fas '+ service.icon" v-if="service.icon"></i>
                        </span>
                            <div >
                                <Multiselect  v-show="showField(index,'icon')" id="icon"
                                              @focus="focusField(index,'icon')"
                                              @blur="blurField(index,'icon')"
                                              v-model="service.icon"
                                              :placeholder="__('Select an Icon')" value-prop="icon"
                                              label="name" style="height: 90px"
                                              :options="[{ icon: 'heartbeat' },{ icon: 'pills'},
                                                                             { icon: 'hospital-user' }, { icon: 'dna'},
                                                                             { icon: 'wheelchair' },{ icon: 'notes-medical'},
                                                                             { icon: 'gift' }, { icon: 'fingerprint' } ,
                                                                              { icon: 'atom' }]">
                                    <template v-slot:singlelabel="{ value }">
                                        <div class="multiselect-single-label">
                                            <i class="text-primary" :class="'fas fa-'+ value.icon"></i>
                                        </div>
                                    </template>
                                    <template v-slot:option="{ option }">
                                        <i class="text-primary" :class="'fas fa-'+ option.icon"></i>
                                    </template>
                                </Multiselect>

                            </div>
                            <br>
                            <span class="text-danger">{{errorFS[index].icon}}</span>

                        </td>
                        <td >
                        <span class="field-value" v-show="!showField(index,'headline')"
                              @click="focusField(index,'headline')">
                            {{ service.headline }}
                        </span>
                            <textarea
                                v-model="service.headline" :rules="isRequired" :data-vv-as="__('headline')"
                                v-show="showField(index,'headline')" id="headline" type="text"
                                class="field-value w3-text-red  " @focus="focusField(index,'headline')"
                                @blur="blurField(index,'headline')" required />
                            <br>
                            <span class="text-danger">{{errorFS[index].headline}}</span>

                        </td>

                        <td >
                        <span class="field-value" v-show="!showField(index,'paragraph')"
                              @click="focusField(index,'paragraph')" >
                            {{ service.paragraph }}
                        </span>
                            <textarea  v-model="service.paragraph" :rules="isRequired" :data-vv-as="__('paragraph')"
                                       v-show="showField(index,'paragraph')" id="paragraph" type="text"
                                       class="field-value w3-text-red  " @focus="focusField(index,'paragraph')"
                                       @blur="blurField(index,'paragraph')" required />
                            <br>
                            <span class="text-danger">{{errorFS[index].paragraph}}</span>

                        </td>
                        <td >
                        <span class="field-value" v-show="!showField(index,'headline_ar')"
                              @click="focusField(index,'headline_ar')">
                            {{ service.headline_ar }}
                        </span>
                            <textarea
                                v-model="service.headline_ar" :rules="isRequired" :data-vv-as="__('headline_ar')"
                                v-show="showField(index,'headline_ar')" id="headline_ar" type="text"
                                class="field-value w3-text-red  " @focus="focusField(index,'headline_ar')"
                                @blur="blurField(index,'headline_ar')" required />
                            <br>
                            <span class="text-danger">{{errorFS[index].headline_ar}}</span>

                        </td>

                        <td >
                        <span class="field-value" v-show="!showField(index,'paragraph_ar')"
                              @click="focusField(index,'paragraph_ar')" >
                            {{ service.paragraph_ar }}
                        </span>
                            <textarea  v-model="service.paragraph_ar" :rules="isRequired" :data-vv-as="__('paragraph_ar')"
                                       v-show="showField(index,'paragraph_ar')" id="paragraph_ar" type="text"
                                       class="field-value w3-text-red  " @focus="focusField(index,'paragraph_ar')"
                                       @blur="blurField(index,'paragraph_ar')" required />
                            <br>
                            <span class="text-danger">{{errorFS[index].paragraph_ar}}</span>

                        </td>
                        <td ><div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-primary me-md-2" @click.prevent="addService(index)"
                               v-if="!service.id" :disabled="!service.icon &&!service.headline &&!service.paragraph">{{__('Add')}}</a>
                            <a class="btn btn-danger"  @click.prevent="delService(index)" v-if="service.id">{{__('Del')}}</a>
                            <a class="btn btn-danger"  @click.prevent="removeItem(index)" v-if="!service.id">{{__('Del')}}</a>

                        </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <button type="button" @click.prevent="InsertRow()" class="btn btn-info">+{{__('Add Service')}}</button>
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

import { Field, Form, ErrorMessage,defineRule,configure } from 'vee-validate';
import {required} from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';

import en from '@vee-validate/i18n/dist/locale/en.json';
import ar from '@vee-validate/i18n/dist/locale/ar.json';
    defineRule('require',required);
import __ from "lodash/fp/__";

if (_locale==='ar'){
    configure({

        generateMessage: localize(
            'ar', {
                names: {
                    name: 'الاسم',
                }}),
    });
}else {
    configure({

        generateMessage: localize({
            en,
        }),
    });

}
export default {
    name: "services",
data(){
    return{
        loading:true,
        error:null,
        errorFS:[],
        services:[],
        editFields:[],
        finds:null,
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
        this.get_services();
    }
    ,
methods:{
    get_services(){
        axios.get('/api/getservices/')
            .then(response => {
            this.services = response.data;
                let len = this.services.length;
                for (let i = 0; i < len; i++) {

                    this.editFields.push(Object.assign({}, {'name': ''}));
                    this.errorFS.push(Object.assign({}, { 'icon':'',
                        'headline':'',
                        'paragraph':'',
                        'headline_ar':'',
                        'paragraph_ar':'',}));

                }
                this.loading = false;
        }).catch((err) => alert('there is an error try again,or Refresh page'));;
        this.loading = false;
    },
    addService(index) {

        axios.post('/api/addservice', {
            headline: this.services[index].headline,
            icon: this.services[index].icon,
            paragraph: this.services[index].paragraph,
            paragraph_ar: this.departments[index].paragraph_ar,
            headline_ar: this.departments[index].headline_ar,
        })
            .then((response) => {
                this.services[index]=response.data.att;
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    },
    //edit question's keys
    focusField(index, name) {
        //this.editFields[index]= name;
        this.editFields[index]['name']=name;
    },
    blurField(index, name) {
        let nn;
        nn=this.services[index][name];

        console.log(nn);
        var id = this.services[index].id;
        if (id){
            if (this.services[index][name]){
                axios.put('/api/editservice/' + id, {
                    name: this.services[index][name],
                    key:name,
                })
                    .then((response) => {
                        this.editFields[index]['name']='';
                        this.errorFS[index][name]='';

                        console.log('sucess');
                    }).catch((err) => alert('there is an error try again,or Refresh page'));
            }else {
                if (_locale==='ar'){
                    this.errorFS[index][name]= 'هذا الحقل مطلوب.';

                }else {
                    this.errorFS[index][name]= 'Field '+name+' is required';

                }
            }

        }else {
            //this.addService(index);
            this.editFields[index]['name']='';

        }

    },
    showField(index, name) {
        console.log(this.services[index][name] === '' || this.editFields[index]['name'] === name);
        return (this.services[index][name] === '' || this.editFields[index]['name'] === name);
    },

    InsertRow() {
        var my_object = {
            icon:'fa-heartbeat',
            headline:'',
            paragraph:'',
            headline_ar:'',
            paragraph_ar:'',
        };
        this.services.push(my_object);
        this.editFields.push(Object.assign({}, {'name': ''}));
        this.errorFS.push(Object.assign({}, { 'icon':'',
            'headline':'',
            'paragraph':'',
            'headline_ar':'',
            'paragraph_ar':'',
        }));


    },
    delService(x){
        let d= this.services[x];
        axios.delete('/api/deleteservice/'+d.id)
            .then((response) =>{
                this.$emit('notification', {
                    user: this.user,
                    notification: response.data.notification.notification
                });
                this.services.splice(x,1);
                this.editFields.splice(x,1);
                this.errorFS.splice(x,1);
            }).catch(error => {
            if (error.response.status === 422) {
                this.error = error.response.data.message;
            } else {
                alert('Unkown error!')
            }
        });
    }, removeItem(x){
        this.services.splice(x,1);
        this.editFields.splice(x,1);
        this.errorFS.splice(x,1);

    },
    }
}



</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
