import { createWebHistory, createRouter } from "vue-router";
import Welcome from "./components/welcome";
import Viewer from "./components/viewer";
import Register from "./components/auth/Register";
import Login from "./components/auth/Login";
import admin_panel from "./components/admin/admin_panel";
import services from "./components/admin/services";
import Main from "./components/main";
import Admin_panel from "./components/admin/admin_panel";
import Main_content from "./components/admin/main_content";

const routes = [
    {
        path: '/'+_locale+'/admin',
        component: Admin_panel,
        name:'admin_page',

        children: [
            {
                name: 'services',
                path:  'services',
                component: services
            },

        ],
    },
    {
        path: '/'+_locale,
        component: Main_content,
        name:'home_page',
        children: [
            {
                path: '',
                name: 'home',
                component: Welcome,
            },

            {
                name: 'register',
                path:  'register',
                component: Register
            },
            {
                name: 'login',
                path:  'login',
                component: Login
            },
            {
                name: 'dashboard',
                path:  'dashboard',
                component: admin_panel
            },
            {
                name: 'services',
                path:  'services',
                component: services
            },
            {
                path: 'viewer',
                name: 'viewer',
                component: Viewer
            },
        ],
    },

]
/*const routes = [
   {
        path: '/'+_locale+'/',
        name: 'home',
        component: Welcome,

    },

    {
        name: 'register',
        path:  '/'+_locale+'/register',
        component: Register
    },
    {
        name: 'login',
        path:  '/'+_locale+'/login',
        component: Login
    },
    {
        name: 'dashboard',
        path:  '/'+_locale+'/dashboard',
        component: admin_panel
    },
    {
        name: 'services',
        path:  '/'+_locale+'/services',
        component: services
    },
    {
        path: '/'+_locale+'/viewer/',
        name: 'viewer',
        component: Viewer
    },
 /!*   {
        path: '/'+_locale+'/questionadd_qs/:id',
        name: 'questionadd_qs',
        component: addquestions,
        props: true
    },*!/

]*/

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router
