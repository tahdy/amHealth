require('./bootstrap');

import { createApp } from 'vue'
import Main from "./components/main";
import { createStore } from 'vuex'
import Vue3Material from 'vue3-material';
import axios from 'axios'
import VueAxios from 'vue-axios'
// Create a new store instance.
const store = createStore({
    state () {
        return {
            count: 0
        }
    },
    mutations: {
        increment (state) {
            state.count++
        }
    }
})
import router from './router'

import { configure } from 'vee-validate';
import { localize ,setLocale} from '@vee-validate/i18n';
import en from '@vee-validate/i18n/dist/locale/en.json';
import ar from '@vee-validate/i18n/dist/locale/ar.json';
//setLocale(_locale);

console.log(_locale)
if (_locale==='ar'){
    configure({

        generateMessage: localize({
            ar,
        }),
    });
}else {
    configure({

        generateMessage: localize({
            en,
        }),
    });

}

const app = createApp(Main,{
    props:['Laravel'],

})

app.use(router);
app.use(store)
app.mixin(require('./trans'));
app.use(Vue3Material);
//app.use(VueAxios, axios)
app.config.globalProperties.$axios = axios;

app.mount('#app')
