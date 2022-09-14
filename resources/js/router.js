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
import dashboard from "./components/admin/dashboard";
import departments from "./components/admin/departments";
import about from "./components/admin/about";
import why from "./components/admin/why";
import question from "./components/admin/question";
import page_data from "./components/admin/page_data";
import AddUser from "./components/admin/addUser";
import Users from "./components/admin/users";
import EditUser from "./components/admin/editUser";
import Doctors from "./components/admin/doctors";
import patients from "./components/admin/patients";
import patient from "./components/admin/patient";

const routes = [
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
                path: 'viewer',
                name: 'viewer',
                component: Viewer
            },
        ],
    },
    {
        path: '/'+_locale+'/admin',
        component: Admin_panel,
        name:'admin_page',
        children: [
            {
                name: 'dashboard',
                path:  '',
                component: dashboard
            },
            {
                name: 'services',
                path:  'services',
                component: services
            },
            {
                name: 'departments',
                path:  'departments',
                component: departments
            },
            {
                name: 'about',
                path:  'about_section',
                component: about
            },
            {
                name: 'why',
                path:  'why_section',
                component: why
            },
            {
                name: 'question',
                path:  'question',
                component: question
            },
            {
                name: 'page_data',
                path:  'page_data',
                component: page_data
            },
            {
                name: 'adduser',
                path:  'adduser',
                component: AddUser
            },
            {
                name: 'users',
                path:  'users',
                component: Users
            },
            {
                name: 'edituser',
                path:  'edituser/:id',
                component: EditUser
            },
            {
                name: 'doctors',
                path:  'doctors',
                component: Doctors
            },
            {
                name: 'patients',
                path:  'patients',
                component: patients
            },
            {
                name: 'patient',
                path:  'patient/:id',
                component: patient
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
