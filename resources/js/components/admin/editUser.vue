<template>
    <div>
        <div  v-if="loading" class="w3-main  w3-display-container" style="height: 380px">
            <div  class="loading w3-display-middle">
                <i class="fa fa-spinner w3-spin" style="font-size:64px"></i>

            </div>
        </div>
        <div v-if="!loading">
            <div class="row">
                <div class="col-md-2" >
</div>
                <div class="col-md-8 card"  style="border-style: none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin: 10px"   :class="{ active: isActive, 'text-danger': hasError }">
                    <div class="card-header text-center w3-text-teal bg-white ml-3 mr-3" style="font-size: xx-large">
                        {{__('Edit User') }}</div>
                    <div class="card-body" >
                        <Form class="form-horizontal form_register" ref="register" v-slot="{ meta,errors }"  enctype="multipart/form-data">
                            <template v-if="Object.keys(errors).length">
                                <p class="text-danger">{{ __('Please correct the following errors')}}</p>
                                <ul>
                                    <li v-for="(message, field) in errors" :key="field" class="text-danger">
                                        {{ message }}
                                    </li>
                                </ul>
                            </template>
                            <div class="form-group row">

                                <label for="name" class="col-md-4 control-label">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <Field id="name" type="text" class="form-control" :rules="validateName" name="name" v-model="name"  data-vv-as="name" required autofocus />

                                    <ErrorMessage class="text-danger" name="name" />


                                </div>
                            </div>
                            <div class=" row">
                                <label for="image" class="col-md-4 control-label">{{ __('Account type') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  v-model="admin"   true-value="1"
                                               false-value="0"  id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck1" style="padding-right: 40px;padding-left: 10px">
                                            {{ __('Admin') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  v-model="leader" :checked="leader===1" true-value="1"
                                               false-value="0" id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck2" style="padding-right: 40px;padding-left: 10px">
                                            {{ __('Leader') }}
                                        </label>
                                    </div>
                                </div></div>
                            <div class=" row">
                                <label  class="col-md-4 control-label" style="padding-top: 20px">{{ __('User type')}}</label>

                                <div class="col-md-6" style="padding-bottom: 17px;padding-top: 17px">
                                    <Field as="select" :rules="isrole"  name="role" v-model="role" class="form-control" >
                                        <option value="">--- {{ __('SELECT') }} ---</option>
                                        <option value="visitor">{{ __('visitor') }}</option>
                                        <option value="staff">{{ __('staff') }}</option>
                                        <option value="doctor">{{ __('doctor') }}</option>
                                        <option value="patient">{{ __('patient') }}</option>
                                    </Field>
                                    <ErrorMessage class="text-danger" name="role" />

                                    <div class="form-group  row" v-show="role=='staff' ||role=='doctor' "  ></div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <Field id="email" type="email" class="form-control" name="email" v-model="email" :validateOnChange="true" :rules="validateEmail" data-vv-as="email" required />
                                    <ErrorMessage class="text-danger" name="email" />

                                </div>
                            </div>

                            <div class="form-group  row">
                                <label for="fullname" class="col-md-4 control-label">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <Field id="fullname" type="text" class="form-control" name="fullname" v-model="fullname" rules="required|alpha_spaces|max:100" data-vv-as="fullname" required />
                                    <ErrorMessage class="text-danger" name="fullname" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fathername" class="col-md-4 control-label">{{ __('Father Name') }}</label>

                                <div class="col-md-6">
                                    <Field id="fathername" type="text" class="form-control" name="fathername" v-model="fathername" rules="required|alpha_spaces|max:40" data-vv-as="fathername" required />

                                    <ErrorMessage class="text-danger" name="fathername" />


                                </div>
                            </div>
                            <div class=" row">
                                <label for="image" class="col-md-4 control-label">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <Field class="form-check-input" type="radio" name="gender" v-model="gender" id="inlineRadioMale" value="Male" checked />
                                        <label class="form-check-label" for="inlineRadioMale">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <Field class="form-check-input" type="radio" name="gender" v-model="gender" id="inlineRadioFemale" value="Female" />
                                        <label class="form-check-label" for="inlineRadioFemale">{{ __('Female') }}</label>
                                    </div></div></div>

                            <div class=" row">
                                <label for="image" class="col-md-4 control-label">{{ __('Religion') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <Field class="form-check-input" type="radio" name="religion" v-model="religion" id="inlineRadioMuslim" value="Muslim" checked />
                                        <label class="form-check-label" for="inlineRadioMuslim">{{ __('Muslim') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <Field class="form-check-input" type="radio" name="religion" v-model="religion" id="inlineRadioChristian" value="Christian" />
                                        <label class="form-check-label" for="inlineRadioChristian">{{ __('Christian') }}</label>
                                    </div></div></div>
                            <div class="form-group row" >
                                <label for="image" class="col-md-4 control-label">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <div class="w3-row-padding custom-file mb-3" v-if="!image">
                                        <Field id="file" type="file" class="custom-file-input" name="image"   @change="onFileChange($event)"   :data-vv-as="'File '" required />
                                        <label class="custom-file-label" for="file">{{ __('Choose File') }}</label>
                                        <div v-if="photo" class="progress">
                                            <div class="progress-bar progress-bar-striped w3-teal" :style="{ width: uploaded+ '%' }"></div>
                                        </div>
                                        <ErrorMessage class="text-danger" name="image" />
                                    </div>
                                    <div class="w3-row-padding" v-if="image">
                                        <img :src="image"  style="width: 150px;height: 150px" />
                                        <button @click.prevent="removeFile($event)">{{ __('Remove file') }}</button>
                                    </div>
                                    <p class="text-danger">{{__(fail)}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-4 control-label">{{ __('Date of birth') }}</label>

                                <div class="col-md-6">
                                    <Field id="date_of_birth" type="date" class="form-control" name="date_of_birth"  rules="required" v-model="date_of_birth" required />

                                    <ErrorMessage class="text-danger" name="date_of_birth" />


                                </div>
                            </div>
                            <div class="form-group  row">
                                <label for="address" class="col-md-4 control-label">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <Field id="address" type="text" class="form-control" name="address" v-model="address" rules="required" data-vv-as="address" required />

                                    <ErrorMessage class="text-danger" name="address" />


                                </div>
                            </div>
                            <div class="form-group  row">
                                <label for="phone" class="col-md-4 control-label">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <Field id="phone" type="tel" class="form-control" name="phone" v-model="phone" rules="required" data-vv-as="phone" required />

                                    <ErrorMessage class="text-danger" name="phone" />

                                </div>
                            </div>
                            <div class="form-group  row">
                                <label for="facebook" class="col-md-4 control-label">Facebook</label>

                                <div class="col-md-6">
                                    <Field id="facebook" type="text" class="form-control" name="facebook" v-model="facebook" rules="required" data-vv-as="facebook" required />

                                    <ErrorMessage class="text-danger" name="facebook" />

                                </div>
                            </div>
                            <div class="form-group  row">
                                <label for="twitter" class="col-md-4 control-label">Twitter</label>

                                <div class="col-md-6">
                                    <Field id="twitter" type="text" class="form-control" name="twitter" v-model="twitter" rules="required" data-vv-as="twitter" required />

                                    <ErrorMessage class="text-danger" name="twitter" />


                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-11 col-md-offset-1">
                                    <button type="submit"  class="w3-btn w3-teal" :disabled="Object.keys(errors).length||!meta.dirty|| !isCompleted"  @click.prevent="signup" >
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </Form>
<h3>{{ __('Edit Password') }}</h3>
                        <Form class="form-horizontal form_password" ref="register" v-slot="{ meta,errors }"  enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 control-label">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <Field id="password" type="password" class="form-control" rules="required|min:6" v-model="password" name="password" placeholder="Password" ref="password" required />

                                    <ErrorMessage class="text-danger" name="password" />


                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 control-label">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <Field rules="required|min:6|confirmed:@password" v-model="password_confirmation" name="password_confirmation" type="password" class="form-control"  data-vv-as="password" required />
                                    <ErrorMessage class="text-danger" name="password_confirmation" />


                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-11 col-md-offset-1">
                                    <button type="submit"  class="w3-btn w3-teal" :disabled="Object.keys(errors).length||!meta.dirty|| !isCompleted2"  @click.prevent="editPassword" >
                                        {{ __('Edit Password') }}
                                    </button>
                                </div>
                            </div>
                        </Form>
                    </div>

                </div>
                <div class="col-md-2" >
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import { Field, Form, ErrorMessage,defineRule,configure } from 'vee-validate';
import AllRules from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';

import en from '@vee-validate/i18n/dist/locale/en.json';
import ar from '@vee-validate/i18n/dist/locale/ar.json';
Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});
if (_locale==='ar'){
    configure({

        generateMessage: localize(
            'ar', {
                names: {
                    name: 'الاسم',
                    password: 'الرقم السرى',
                    age: 'السن',
                    ageConfirm: 'تأكيد السن',
                    fullname:'الإسم الكامل',
                    fathername:'إسم الأب',
                    image:'الصورة',
                    date_of_birth:'تاريخ الميلاد',
                    address:'العنوان',
                    phone:'الهاتف',
                    facebook:'رابط الفيسبوك',
                    twitter:'رابط تويتر',
                    password_confirmation:'تأكيد الرقم السرى',


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
    name:'editUser',
    props:['id'],
    components:{
        Field,
        Form,
        ErrorMessage,
    },
    data(){
        return{
            //emailsDB:[],
            success:'',
            fail:'',
            //user:auth_user,
            loading: true,
            photo:null,
            uploaded:0,
            name:'',
            fullname:'',
            fathername:'',
            vEmail:1,
            vName:1,
            image:'',
            role:'',
            admin:0,
            leader:0,
            email:null,
            password:'',
            password_confirmation: '',
            gender:'Male',
            religion:'Muslim',
            nickname:'',
            date_of_birth:'',
            address:'',
            phone:'',
            facebook:'#',
            twitter:'#',
            lang:_locale,

        }
    },mounted(){
      this.loading=false;
      this.getuser();
    },
    computed: {
        isCompleted () {
            return this.name && this.fullname && this.fathername &&this.gender && this.religion
                && this.date_of_birth && this.address
                && this.image && this.email
                && this.phone && this.facebook && this.twitter;
        },

        isCompleted2 () {
            return this.password_confirmation && this.password;
        }

    },watch:{

    },
    methods:{

    getuser() {
        axios.get('/api/getuser/'+this.$route.params.id).then(response => {
            this.name=response.data.user.name;
            this.oname=response.data.user.name;
            this.fullname=response.data.user.fullname;
            this.fathername=response.data.user.fathername;
            this.image=response.data.user.image;
            this.role=response.data.user.role;
            this.admin=response.data.user.admin;
            this.leader=response.data.user.leader;
            this.oemail=response.data.user.email;
            this.email=response.data.user.email;
            this.gender=response.data.user.gender;
            this.religion=response.data.user.religion;
            this.date_of_birth=response.data.user.date_of_birth;
            this.address=response.data.user.address;
            this.phone=response.data.user.phone;
            this.facebook=response.data.user.facebook;
            this.twitter=response.data.user.twitter;

        });
    } ,isRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'This is required';
        },
        isrole(value) {
            if (value && value.length) {
                return true;
            }
            if (_locale==='ar'){
                return 'يجب أن تختار';
            }else {
                return 'You must choose a role';
            }
        },
        validateEmail(value) {
            // if the field is empty
            if (!value) {
                if (_locale==='ar'){
                    return 'البريد الإلكترونى مطلوب';
                }else {
                    return 'name is required';
                }
            }
            // if the field is not a valid email
            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                if (_locale==='ar'){
                    return 'البريد الإلكترونى يجب أن يكون صالحا';
                }else {
                    return 'This field must be a valid name';
                }
            }
            if (this.oemail === this.email){
                this.vEmail=1;
            }else {
                axios.post('/api/checkemail/',{email:value}).then(response => {
                    this.vEmail=response.data;
                });
            }
            if (this.vEmail==0){
                if (_locale==='ar'){
                    return ` مسجل لدينا ${value} `;
                }else {
                    return `${value} is already taken.`;
                }
            }
            // All is good
            return true;
        }
        ,
        validateName(value){
            // if the field is empty
            if (!value) {
                if (_locale==='ar'){
                    return 'الإسم مطلوب';
                }else {
                    return 'name is required';
                }
            }
            // if the field is not a valid name
            const regex = /^[A-Za-z0-9_]+$/;
            if (!regex.test(value)) {
                if (_locale==='ar'){
                    return 'الإسم يجب أن يكون صالحا';
                }else {
                    return 'This field must be a valid name';
                }
            }
            if (this.oname===this.name){
                this.vName=1;
            }else {
                axios.post('/api/checkname/',{name:value}).then(response => {
                    this.vName=response.data;
                });
            }
            if (this.vName==0){
                if (_locale==='ar'){
                    return ` مسجل لدينا ${value} `;
                }else {
                    return `${value} is already taken.`;
                }
            }
            // All is good
            return true;
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
        },

        signup(e) {
            e.preventDefault();
                    axios.put('/api/edituser/'+this.$route.params.id, {
                        image: this.image, name: this.name,
                        fullname: this.fullname,
                        fathername: this.fathername,
                        role: this.role,
                        admin: this.admin,
                        leader: this.leader,
                        email: this.email,
                        gender: this.gender,
                        religion: this.religion,
                        nickname: this.nickname,
                        ss_id: this.ss_id,
                        date_of_birth: this.date_of_birth,
                        address: this.address,
                        phone: this.phone,
                        facebook: this.facebook,
                        twitter: this.twitter,
                    }).then(response => {
                        if (response.data.success) {
                            alert(response.data.message);
                            this.$emit('notification', {
                                user: this.user,
                                notification: response.data.notification
                            });
                        }
                    }).catch(error => {
                        alert('Unkown error!')
                    });
        }
        ,
        editPassword(e) {
            e.preventDefault();
            if (this.password.length > 0) {
                    axios.put('/api/edituserpassword/'+this.$route.params.id, {

                        password: this.password,
                        password_confirmation: this.password_confirmation,
                    }).then(response => {
                        if (response.data.success) {
                            alert(response.data.success);
                            this.$emit('notification', {
                                user: this.user,
                                notification: response.data.notification
                            });

                        }
                    }).catch(error => {
                        alert('Unkown error!')
                    });
            }
        },

        onFileChange(e) {
            this.photo = e.target.files[0];
            this.submitForm(e);
        }
        ,
        submitForm(e) {
            let f=this.photo;
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
            formData.append('path', 'images/users/');

// send upload request
            axios.post('api/store_file', formData,
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
                    currentObj.image = response.data.name;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        },
        removeFile: function (e) {
            axios.delete('/api/delfile', {params:{path: this.image}})
                .then((response) => {
                    this.image = '';
                }).catch((err) => alert('there is an error try again,or Refresh page'));
        },

    }

}
</script>
