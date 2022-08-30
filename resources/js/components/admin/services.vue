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

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">icon</th>
                    <th scope="col">headline</th>
                    <th scope="col">paragraph</th>
                    <th scope="col">actions</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="(service,index) in services">
                    <th scope="row">{{ index }}</th>
                    <td>
                        <span class="field-value" v-show="!showField(index,'icon')"
                              @click="focusField(index,'icon')">
                            {{ service.icon }}
                        </span>
                        <input style="width: 30%" v-model="service.icon" :rules="isRequired" :data-vv-as="__('icon')"
                               v-show="showField(index,'icon')" id="icon" type="text"
                               class="field-value w3-text-red  " @focus="focusField(index,'icon')"
                               @blur="blurField(index,'icon')">
                    </td>
                    <td>{{ service.headline }}</td>
                    <td>{{ service.paragraph }}</td>
                    <td>{{ service.paragraph }}</td>
                    <td><div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary me-md-2" >edit</a>
                        <a class="btn btn-danger" >del</a>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
export default {
    name: "services",
data(){
    return{
        loading:true,
        error:null,
        services:[],
        editFields:[]
    }
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
                this.editFields.push(Object.assign({}, {'name': ''}));
                this.loading = false;
        }).catch((err) => alert('there is an error try again,or Refresh page'));;
        this.loading = false;
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
        var id = this.questions[index].id;
        axios.put('/api/editservice/' + id, {
            name: this.services[index][name],
            key:name,
        })
            .then((response) => {
                this.services[index]= response.data.q;
                this.editFields[index]['name']='';
                console.log('sucess');
            }).catch((err) => alert('there is an error try again,or Refresh page'));
    },
    showField(index, name) {
        return (this.services[index][name] === '' || this.editFields[index]['name'] === name);
    },
    }
}



</script>

<style scoped>

</style>
