<template>
   <div>
       <div class="container-fluid" >
           <div class="row flex-nowrap">
               <div class="col-auto  col-xl-2 px-0 bg-white">
                   <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
                       <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                           <span class="fs-5 d-none d-sm-inline text-secondary pt-3">Admin Panel</span>
                       </a>
                       <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                           <li class="nav-item">
                               <a href="#" class="nav-link align-middle px-0 color_i">
                                   <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                               </a>
                           </li>
                           <li>
                               <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                               <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                   <li class="w-100">
                                       <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                                   </li>
                                   <li>
                                       <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <router-link :to="{name:'services'}" href="#"  class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-table"></i>
                                   <span class="ms-1 d-none d-sm-inline">
                                       {{__('Appointments')}}</span>
                               </router-link>
                           </li>
                           <li>
                               <a href="#" @click.prevent="link('services')" class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">services</span></a>
                           </li>
                           <li>
                               <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline ">{{__('Users')}}</span></a>
                               <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                   <li class="w-100">
                                       <router-link :to="{name:'users'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('All Users')}}</span>  <span class="badge rounded-pill bg-danger">U</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'doctors'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Doctors')}}</span>  <span class="badge rounded-pill bg-danger">D</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'patients'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Patients')}}</span>  <span class="badge rounded-pill bg-danger">P</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'adduser'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Add User')}}</span>  <span class="badge rounded-pill bg-danger">+</span></router-link>
                                   </li>

                               </ul>
                           </li>
                           <li>
                               <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">{{__('Main Page')}}</span> </a>
                               <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">

                                   <li>
                                       <router-link :to="{name:'services'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Services')}}</span> <span class="badge rounded-pill bg-danger">S</span>
                                       </router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'departments'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Departments')}}</span> <span class="badge rounded-pill bg-danger">D</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'about'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('About section')}}</span> <span class="badge rounded-pill bg-danger">A</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'why'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Why section')}}</span> <span class="badge rounded-pill bg-danger">W</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'question'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Questions')}}</span> <span class="badge rounded-pill bg-danger">Q</span></router-link>
                                   </li>
                                   <li>
                                       <router-link :to="{name:'page_data'}" class="nav-link px-0"> <span class="d-none d-sm-inline text-secondary">{{__('Main page data')}}</span> <span class="badge rounded-pill bg-danger">M</span></router-link>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <a href="#" class="nav-link px-0 align-middle color_i">
                                   <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                           </li>
                       </ul>
                       <hr>
                       <div class="dropdown pb-4">
                           <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                               <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                               <span class="d-none d-sm-inline mx-1">loser</span>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                               <li><a class="dropdown-item" href="#">New project...</a></li>
                               <li><a class="dropdown-item" href="#">Settings</a></li>
                               <li><a class="dropdown-item" href="#">Profile</a></li>
                               <li>
                                   <hr class="dropdown-divider">
                               </li>
                               <li><a class="dropdown-item" href="#">Sign out</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col py-3">
                   <router-view ></router-view>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
import Services from "./services";
import Departments from "./departments";
import Main_page from "./main_page";
export default {
    name: "admin_panel",
    components: {Main_page, Departments, Services},
    data(){
        return{
           comp:'dashboard'
        }
    },
    methods:{
        link(comp){
            this.comp=comp;
        }
    }
}
</script>

<style >
#app{
    display: block !important;
}
.color_i{
    color: #1977cc ;
}
</style>
