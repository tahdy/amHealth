<template>
    <div>
        <!-- ======= Top Bar ======= -->
        <div id="topbar" class="d-flex align-items-center fixed-top">
            <div class="container d-flex justify-content-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
                    <i class="bi bi-phone"></i> +1 5589 55488 55
                </div>
                <div class="d-none d-lg-flex social-links align-items-center">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center">

                <h1 class="logo me-auto"><a href="index.html">AmHealth</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
<!--                <a href="index.html" class="logo me-auto"><img v-bind:src="'/images/logo.png'" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><router-link class="nav-link scrollto active" :to="'/'+this.lang+'#'">Home</router-link></li>
                        <li><router-link class="nav-link scrollto" :to="'/'+this.lang+'/#about'" >About</router-link></li>
                        <li><router-link class="nav-link scrollto" :to="'/'+this.lang+'/#services'" >Services</router-link></li>
                        <li><router-link class="nav-link scrollto" :to="'/'+this.lang+'/#departments'" >Departments</router-link></li>
                        <li><router-link class="nav-link scrollto" :to="'/'+this.lang+'/#doctors'" >Doctors</router-link></li>
                        <li class="dropdown"><router-link to="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></router-link>
                            <ul>
                                <li><router-link to="#">Drop Down 1</router-link></li>
                                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><router-link to="#">Deep Drop Down 1</router-link></li>
                                        <li><router-link to="#">Deep Drop Down 2</router-link></li>
                                        <li><router-link to="#">Deep Drop Down 3</router-link></li>
                                        <li><router-link to="#">Deep Drop Down 4</router-link></li>
                                        <li><router-link to="#">Deep Drop Down 5</router-link></li>
                                    </ul>
                                </li>
                                <li><router-link to="#">Drop Down 2</router-link></li>
                                <li><router-link to="#">Drop Down 3</router-link></li>
                                <li><router-link to="#">Drop Down 4</router-link></li>
                            </ul>
                        </li>
                        <li><router-link class="nav-link scrollto" :to="'/'+this.lang+'/#contact'" >Contact</router-link></li>
                        <li><router-link v-if="!isLoggedIn" class="nav-link scrollto" :to="'/'+this.lang+'/login'">login</router-link></li>
                        <li><router-link v-if="!isLoggedIn" class="nav-link scrollto" :to="'/'+this.lang+'/register'">register</router-link></li>
                        <li><a v-if="isLoggedIn" class="nav-link scrollto" style="cursor: pointer;" @click="logout">logout</a></li>

                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

                <router-link :to="'/'+this.lang+'/#appointment'" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</router-link>

            </div>
        </header><!-- End Header -->
    <div :dir="lang=='ar'?'rtl' :'ltr'" id="main"  style="margin-top:100px;min-height: 380px">
       <main_content />
        <!-- End page content -->
    </div>

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>AmHealth</h3>
                            <p>
                                A108 xxx Street <br>
                                Cairo, NY 535022<br>
                                Egypt <br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                        </div>

                        <div class="col-lg-2 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-newsletter">
                            <h4>Join Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container d-md-flex py-4">

                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>AmHealth</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>
</template>

<script>
import Main_content from "./admin/main_content";
export default {
    name: "main",
    components: {Main_content},
    data(){
        return{
            title: 'How To Install Vue 3 in Laravel 8 From Scratch',
            isLoggedIn: false,
            lang:_locale,

        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = '/'+this.lang+'/'
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>

<style scoped>

</style>
