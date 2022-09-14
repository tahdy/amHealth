<template>
   <div v-if="datas['Main Section'] && !loading">
       <!-- ======= Hero Section ======= -->
       <section id="hero" class="d-flex align-items-center">
           <div class="container">
               <h1 v-if="lang==='en'">{{datas['Main Section'][0].headline}}</h1>
               <h2 v-if="lang==='en'">{{datas['Main Section'][0].paragraph}}</h2>
               <h1 v-if="lang==='ar'">{{datas['Main Section'][0].headline_ar}}</h1>
               <h2 v-if="lang==='ar'">{{datas['Main Section'][0].paragraph_ar}}</h2>
               <a href="#about" class="btn-get-started scrollto">Get Started</a>
           </div>
       </section><!-- End Hero -->

       <main id="main">

           <!-- ======= Why Us Section ======= -->
           <section id="why-us" class="why-us " >
               <div class="container">

                   <div class="row ">
                       <div class="col-lg-4 d-flex align-items-stretch">
                           <div class="content">
                               <h3 v-if="lang==='en'">{{datas['Why Us Section'][0].headline}}</h3>
                               <h3 v-if=" lang==='ar'">{{datas['Why Us Section'][0].headline_ar}}</h3>
                               <p v-if=" lang==='en'">{{datas['Why Us Section'][0].paragraph}}</p>
                               <p v-if=" lang==='ar'">{{datas['Why Us Section'][0].paragraph_ar}}</p>
                               <div class="text-center">
                                   <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-8 d-flex align-items-stretch">
                           <div class="icon-boxes d-flex flex-column justify-content-center">
                               <div class="row">
                                   <div class="col-xl-4 d-flex align-items-stretch" v-for="(why_paragraph,index) in why_paragraphs">
                                       <div class="icon-box mt-4 mt-xl-0">
                                           <i :class="'bx bx-'+why_paragraph.icon"></i>
                                           <h4 v-if="lang==='en'">{{why_paragraph.headline}}</h4>
                                           <h4 v-if="lang==='ar'">{{why_paragraph.headline_ar}}</h4>
                                           <p v-if="lang==='en'">{{why_paragraph.paragraph}}</p>
                                           <p v-if="lang==='ar'">{{why_paragraph.paragraph_ar}}</p>
                                       </div>
                                   </div>

                               </div>
                           </div><!-- End .content-->
                       </div>
                   </div>

               </div>
           </section><!-- End Why Us Section -->

           <!-- ======= About Section ======= -->
           <section id="about" class="about">
               <div class="container">

                   <div class="row">
                       <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                           <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
                       </div>

                       <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                           <h3 v-if=" lang==='en'">{{datas['About Section'][0].headline}}</h3>
                           <h3 v-if=" lang==='ar'">{{datas['About Section'][0].headline_ar}}</h3>
                           <p v-if=" lang==='en'">{{datas['About Section'][0].paragraph}}</p>
                           <p v-if=" lang==='ar'">{{datas['About Section'][0].paragraph_ar}}</p>
                           <div class="icon-box" v-for="(about_paragraph,index) in about_paragraphs">
                               <div class="icon"><i :class="'bx bx-'+about_paragraph.icon"></i></div>
                               <h4 class="title">
                                   <a href="" v-if="lang==='en'">{{about_paragraph.headline}}</a>
                                   <a href="" v-if="lang==='ar'">{{about_paragraph.headline_ar}}</a>

                               </h4>
                               <p class="description" v-if="lang==='en'">{{about_paragraph.paragraph}}</p>
                               <p class="description" v-if="lang==='ar'">{{about_paragraph.paragraph_ar}}</p>

                           </div>


                       </div>
                   </div>

               </div>
           </section><!-- End About Section -->

           <!-- ======= Counts Section ======= -->
           <section id="counts" class="counts">
               <div class="container">

                   <div class="row">

                       <div class="col-lg-3 col-md-6">
                           <div class="count-box">
                               <i class="fas fa-user-md"></i>
                               <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
                               <p>Doctors</p>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                           <div class="count-box">
                               <i class="far fa-hospital"></i>
                               <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
                               <p>Departments</p>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                           <div class="count-box">
                               <i class="fas fa-flask"></i>
                               <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
                               <p>Research Labs</p>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                           <div class="count-box">
                               <i class="fas fa-award"></i>
                               <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                               <p>Awards</p>
                           </div>
                       </div>

                   </div>

               </div>
           </section><!-- End Counts Section -->

           <!-- ======= Services Section ======= -->
           <section id="services" class="services">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if=" lang==='en'">{{datas['Services Section'][0].headline}}</h2>
                       <h2 v-if=" lang==='ar'">{{datas['Services Section'][0].headline_ar}}</h2>
                       <p v-if=" lang==='en'">{{datas['Services Section'][0].paragraph}}</p>
                       <p v-if=" lang==='ar'">{{datas['Services Section'][0].paragraph_ar}}</p>
                   </div>

                   <div class="row" v-if="services">
                       <div v-for="(service,index) in services" class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                           <div class="icon-box">
                               <div class="icon"><i :class="'fas fa-'+service.icon"></i></div>
                               <h4>
                                   <a v-if="lang=='en'" href="">{{ service.headline }}</a>
                                   <a v-if="lang=='ar'" href="">{{ service.headline_ar }}</a>

                               </h4>
                               <p v-if="lang=='en'">{{ service.paragraph }}</p>
                               <p v-if="lang=='ar'">{{ service.paragraph_ar }}</p>

                           </div>
                       </div>

                   </div>

               </div>
           </section><!-- End Services Section -->

           <!-- ======= Appointment Section ======= -->
           <section id="appointment" class="appointment section-bg">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if="lang==='en'">{{datas['Appointment Section'][0].headline}}</h2>
                       <h2 v-if="lang==='ar'">{{datas['Appointment Section'][0].headline_ar}}</h2>
                       <p v-if="lang==='en'">{{datas['Appointment Section'][0].paragraph}}</p>
                       <p v-if="lang==='ar'">{{datas['Appointment Section'][0].paragraph_ar}}</p>
                   </div>

                   <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
                       <div class="row">
                           <div class="col-md-4 form-group">
                               <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                               <div class="validate"></div>
                           </div>
                           <div class="col-md-4 form-group mt-3 mt-md-0">
                               <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                               <div class="validate"></div>
                           </div>
                           <div class="col-md-4 form-group mt-3 mt-md-0">
                               <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                               <div class="validate"></div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-4 form-group mt-3">
                               <input type="datetime" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                               <div class="validate"></div>
                           </div>
                           <div class="col-md-4 form-group mt-3">
                               <select name="department" id="department" class="form-select">
                                   <option value="">Select Department</option>
                                   <option v-for="(department,index) in departments" value="Department 1">{{ department.name }}</option>
                               </select>
                               <div class="validate"></div>
                           </div>
                           <div class="col-md-4 form-group mt-3">
                               <select name="doctor" id="doctor" class="form-select">
                                   <option value="">Select Doctor</option>
                                   <option value="Doctor 1">Doctor 1</option>
                                   <option value="Doctor 2">Doctor 2</option>
                                   <option value="Doctor 3">Doctor 3</option>
                               </select>
                               <div class="validate"></div>
                           </div>
                       </div>

                       <div class="form-group mt-3">
                           <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                           <div class="validate"></div>
                       </div>
                       <div class="mb-3">
                           <div class="loading">Loading</div>
                           <div class="error-message"></div>
                           <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                       </div>
                       <div class="text-center"><button type="submit">Make an Appointment</button></div>
                   </form>

               </div>
           </section><!-- End Appointment Section -->

           <!-- ======= Departments Section ======= -->
           <section id="departments" class="departments container">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if="lang==='en'">{{datas['Departments Section'][0].headline}}</h2>
                       <h2 v-if="lang==='ar'">{{datas['Departments Section'][0].headline_ar}}</h2>
                       <p v-if="lang==='en'">{{datas['Departments Section'][0].paragraph}}</p>
                       <p v-if="lang==='ar'">{{datas['Departments Section'][0].paragraph_ar}}</p>
                   </div>

                   <div class="row gy-4">
                       <div class="col-lg-3">
                           <ul class="nav nav-tabs flex-column">
                               <li class="nav-item" v-for="(department,index) in departments">
                                   <a v-if="lang==='en'" class="nav-link  " :class="{ 'active': index===0,'show': index===0, }" data-bs-toggle="tab" :href="'#tab_'+index">{{ department.name }}</a>
                                   <a v-if="lang==='ar'" class="nav-link" :class="{ 'active': index===0,'show': index===0, }" data-bs-toggle="tab" :href="'#tab_'+index">{{ department.name_ar }}</a>
                               </li>

                           </ul>
                       </div>
                       <div class="col-lg-9">
                           <div class="tab-content">
                               <div class="tab-pane  " :class="{ 'active': index===0,'show': index===0, }" v-for="(department,index) in departments" :id="'tab_'+index">
                                   <div class="row gy-4">
                                       <div class="col-lg-8 details order-2 order-lg-1">
                                           <h3 v-if="lang==='en'">{{ department.headline }}</h3>
                                           <p v-if="lang==='en'">{{ department.paragraph }}</p>
                                           <h3 v-if="lang==='ar'">{{ department.headline_ar }}</h3>
                                           <p v-if="lang==='ar'">{{ department.paragraph_ar }}</p>
                                       </div>
                                       <div class="col-lg-4 text-center order-1 order-lg-2">
                                           <img v-bind:src="department.image" alt="" class="img-fluid">
                                       </div>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>

               </div>
           </section><!-- End Departments Section -->

           <!-- ======= Doctors Section ======= -->
           <section id="doctors" class="doctors">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if="lang==='en'">{{datas['Doctors Section'][0].headline}}</h2>
                       <h2 v-if="lang==='ar'">{{datas['Doctors Section'][0].headline_ar}}</h2>
                       <p v-if="lang==='en'">{{datas['Doctors Section'][0].paragraph}}</p>
                       <p v-if=" lang==='ar'">{{datas['Doctors Section'][0].paragraph_ar}}</p>
                        </div>

                   <div class="row">

                       <div class="col-lg-6">
                           <div class="member d-flex align-items-start">
                               <div class="pic"><img v-bind:src="'/images/doctors/doctors-1.jpg'" class="img-fluid" alt=""></div>
                               <div class="member-info">
                                   <h4>Walter White</h4>
                                   <span>Chief Medical Officer</span>
                                   <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                                   <div class="social">
                                       <a href=""><i class="ri-twitter-fill"></i></a>
                                       <a href=""><i class="ri-facebook-fill"></i></a>
                                       <a href=""><i class="ri-instagram-fill"></i></a>
                                       <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-6 mt-4 mt-lg-0">
                           <div class="member d-flex align-items-start">
                               <div class="pic"><img v-bind:src="'/images/doctors/doctors-2.jpg'" class="img-fluid" alt=""></div>
                               <div class="member-info">
                                   <h4>Sarah Jhonson</h4>
                                   <span>Anesthesiologist</span>
                                   <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                   <div class="social">
                                       <a href=""><i class="ri-twitter-fill"></i></a>
                                       <a href=""><i class="ri-facebook-fill"></i></a>
                                       <a href=""><i class="ri-instagram-fill"></i></a>
                                       <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-6 mt-4">
                           <div class="member d-flex align-items-start">
                               <div class="pic"><img v-bind:src="'/images/doctors/doctors-3.jpg'" class="img-fluid" alt=""></div>
                               <div class="member-info">
                                   <h4>William Anderson</h4>
                                   <span>Cardiology</span>
                                   <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                                   <div class="social">
                                       <a href=""><i class="ri-twitter-fill"></i></a>
                                       <a href=""><i class="ri-facebook-fill"></i></a>
                                       <a href=""><i class="ri-instagram-fill"></i></a>
                                       <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-6 mt-4">
                           <div class="member d-flex align-items-start">
                               <div class="pic"><img v-bind:src="'/images/doctors/doctors-4.jpg'" class="img-fluid" alt=""></div>
                               <div class="member-info">
                                   <h4>Amanda Jepson</h4>
                                   <span>Neurosurgeon</span>
                                   <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                                   <div class="social">
                                       <a href=""><i class="ri-twitter-fill"></i></a>
                                       <a href=""><i class="ri-facebook-fill"></i></a>
                                       <a href=""><i class="ri-instagram-fill"></i></a>
                                       <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>

               </div>
           </section><!-- End Doctors Section -->

           <!-- ======= Frequently Asked Questions Section ======= -->
           <section id="faq" class="faq section-bg">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if=" lang==='en'">{{datas['Questions Section'][0].headline}}</h2>
                       <h2 v-if=" lang==='ar'">{{datas['Questions Section'][0].headline_ar}}</h2>
                       <p v-if="lang==='en'">{{datas['Questions Section'][0].paragraph}}</p>
                       <p v-if=" lang==='ar'">{{datas['Questions Section'][0].paragraph_ar}}</p>
                   </div>

                   <div class="faq-list">
                       <ul>
                           <li data-aos="fade-up" :data-aos-delay="index+'00'" v-for="(question,index) in questions">
                               <i class="bx bx-help-circle icon-help"></i>
                               <a data-bs-toggle="collapse" class="collapse" :data-bs-target="'#faq-list-'+index">
                                   <p v-if="lang==='en'">{{question.question}}</p>
                                   <p v-if="lang==='ar'">{{question.question_ar}}</p>

                                   <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                               <div :id="'faq-list-'+index" class="collapse "  :class="{ 'show': index===0, }" data-bs-parent=".faq-list">
                                   <p v-if="lang==='en'">{{question.answer}}</p>
                                   <p v-if="lang==='ar'">{{ question.answer_ar }}</p>

                               </div>
                           </li>


                       </ul>
                   </div>

               </div>
           </section><!-- End Frequently Asked Questions Section -->

           <!-- ======= Testimonials Section ======= -->
           <section id="testimonials" class="testimonials">
               <div class="container">

                   <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                       <div class="swiper-wrapper">

                           <div class="swiper-slide">
                               <div class="testimonial-wrap">
                                   <div class="testimonial-item">
                                       <img v-bind:src="'/images/testimonials/testimonials-1.jpg'" class="testimonial-img" alt="">
                                       <h3>Saul Goodman</h3>
                                       <h4>Ceo &amp; Founder</h4>
                                       <p>
                                           <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                           Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                           <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                       </p>
                                   </div>
                               </div>
                           </div><!-- End testimonial item -->

                           <div class="swiper-slide">
                               <div class="testimonial-wrap">
                                   <div class="testimonial-item">
                                       <img v-bind:src="'/images/testimonials/testimonials-2.jpg'" class="testimonial-img" alt="">
                                       <h3>Sara Wilsson</h3>
                                       <h4>Designer</h4>
                                       <p>
                                           <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                           Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                           <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                       </p>
                                   </div>
                               </div>
                           </div><!-- End testimonial item -->

                           <div class="swiper-slide">
                               <div class="testimonial-wrap">
                                   <div class="testimonial-item">
                                       <img v-bind:src="'/images/testimonials/testimonials-3.jpg'" class="testimonial-img" alt="">
                                       <h3>Jena Karlis</h3>
                                       <h4>Store Owner</h4>
                                       <p>
                                           <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                           Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                           <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                       </p>
                                   </div>
                               </div>
                           </div><!-- End testimonial item -->

                           <div class="swiper-slide">
                               <div class="testimonial-wrap">
                                   <div class="testimonial-item">
                                       <img v-bind:src="'/images/testimonials/testimonials-4.jpg'" class="testimonial-img" alt="">
                                       <h3>Matt Brandon</h3>
                                       <h4>Freelancer</h4>
                                       <p>
                                           <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                           Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                                           <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                       </p>
                                   </div>
                               </div>
                           </div><!-- End testimonial item -->

                           <div class="swiper-slide">
                               <div class="testimonial-wrap">
                                   <div class="testimonial-item">
                                       <img v-bind:src="'/images/testimonials/testimonials-5.jpg'" class="testimonial-img" alt="">
                                       <h3>John Larson</h3>
                                       <h4>Entrepreneur</h4>
                                       <p>
                                           <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                           Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                                           <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                       </p>
                                   </div>
                               </div>
                           </div><!-- End testimonial item -->

                       </div>
                       <div class="swiper-pagination"></div>
                   </div>

               </div>
           </section><!-- End Testimonials Section -->

           <!-- ======= Gallery Section ======= -->
           <section id="gallery" class="gallery container">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if=" lang==='en'">{{datas['Gallery Section'][0].headline}}</h2>
                       <h2 v-if=" lang==='ar'">{{datas['Gallery Section'][0].headline_ar}}</h2>
                       <p v-if="lang==='en'">{{datas['Gallery Section'][0].paragraph}}</p>
                       <p v-if="lang==='ar'">{{datas['Gallery Section'][0].paragraph_ar}}</p>
                   </div>
               </div>

               <div class="container-fluid">
                   <div class="row g-0">

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-1.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-1.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-2.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-2.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-3.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-3.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-4.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-4.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-5.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-5.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-6.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-6.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-7.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-7.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                       <div class="col-lg-3 col-md-4">
                           <div class="gallery-item">
                               <a href="/images/gallery/gallery-8.jpg" class="galelry-lightbox">
                                   <img v-bind:src="'/images/gallery/gallery-8.jpg'" alt="" class="img-fluid">
                               </a>
                           </div>
                       </div>

                   </div>

               </div>
           </section><!-- End Gallery Section -->

           <!-- ======= Contact Section ======= -->
           <section id="contact" class="contact">
               <div class="container">

                   <div class="section-title">
                       <h2 v-if=" lang==='en'">{{datas['Contact Section'][0].headline}}</h2>
                       <h2 v-if=" lang==='ar'">{{datas['Contact Section'][0].headline_ar}}</h2>
                       <p v-if=" lang==='en'">{{datas['Contact Section'][0].paragraph}}</p>
                       <p v-if=" lang==='ar'">{{datas['Contact Section'][0].paragraph_ar}}</p>
                   </div>
               </div>

               <div>
                   <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
               </div>

               <div class="container">
                   <div class="row mt-5">

                       <div class="col-lg-4">
                           <div class="info">
                               <div class="address">
                                   <i class="bi bi-geo-alt"></i>
                                   <h4>Location:</h4>
                                   <p>A108 Adam Street, New York, NY 535022</p>
                               </div>

                               <div class="email">
                                   <i class="bi bi-envelope"></i>
                                   <h4>Email:</h4>
                                   <p>info@example.com</p>
                               </div>

                               <div class="phone">
                                   <i class="bi bi-phone"></i>
                                   <h4>Call:</h4>
                                   <p>+1 5589 55488 55s</p>
                               </div>

                           </div>

                       </div>

                       <div class="col-lg-8 mt-5 mt-lg-0">

                           <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                               <div class="row">
                                   <div class="col-md-6 form-group">
                                       <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                   </div>
                                   <div class="col-md-6 form-group mt-3 mt-md-0">
                                       <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                   </div>
                               </div>
                               <div class="form-group mt-3">
                                   <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                               </div>
                               <div class="form-group mt-3">
                                   <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                               </div>
                               <div class="my-3">
                                   <div class="loading">Loading</div>
                                   <div class="error-message"></div>
                                   <div class="sent-message">Your message has been sent. Thank you!</div>
                               </div>
                               <div class="text-center"><button type="submit">Send Message</button></div>
                           </form>

                       </div>

                   </div>

               </div>
           </section><!-- End Contact Section -->

       </main><!-- End #main -->

   </div>
</template>

<script>
export default {
    name: "welcome",
    data(){
        return{
            services:[],
            departments:[],
            about_paragraphs:[],
            why_paragraphs: [],
            datas: [],
            questions:[],
            loading:true,
            error:null,
            lang:_locale,
        }
    },
    mounted() {
        this.get_services();
        this.get_departments();
        this.get_about_paragraphs();
        this.get_why_paragraphs();
        this.get_questions();
        this.get_datas();

    }

    ,methods:{
        get_datas(){
            axios.get('/api/getpage_data/')
                .then(response => {
                    this.datas = response.data;
                    console.log(this.datas['Main Section'])
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        get_questions(){
            axios.get('/api/getquestions/')
                .then(response => {
                    this.questions = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        get_why_paragraphs(){
            axios.get('/api/getwhy_paragraphs/')
                .then(response => {
                    this.why_paragraphs = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        get_services(){
            axios.get('/api/getservices/')
                .then(response => {
                    this.services = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        get_departments(){
            axios.get('/api/getdepartments/')
                .then(response => {
                    this.departments = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
        get_about_paragraphs(){
            axios.get('/api/getabout_paragraphs/')
                .then(response => {
                    this.about_paragraphs = response.data;
                    this.loading = false;
                }).catch((err) => this.error=err);
            this.loading = false;
        },
    }
}
</script>

<style scoped>

</style>
