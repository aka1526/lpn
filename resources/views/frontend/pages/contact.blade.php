@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')
  

      <!-- Start of contact map section
         ============================================= -->   
         <div class="yl-googlemap">
            <div class="container">
               <div id="yl_map" 
               data-lat="43.653225" 
               data-lon="-79.383186" 
               data-zoom="12" 
               data-info="Trinity Bellwoods Park" 
               data-mlat="43.653225" 
               data-mlon="-79.383186"
                data-marker="assets/img/map-m.png">
               </div>   
            </div>
         </div>
      <!-- End of contact map section
         ============================================= -->

      <!-- Start of contact content section
         ============================================= -->       
         <section id="contact-content" class="contact-content-section">
            <div class="container">
              
               <div class="yl-contact-content-wrap">
                  <div class="row justify-content-center">
                     <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                              <img src="assets/img/cct-icon1.png" alt="">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                              <h3>Address</h3>
                              <span>
                                 <span> {{ $sysinfo->sys_address}}</span>
                                 <span> {{ $sysinfo->sys_country}}</span>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                              <img src="assets/img/cct-icon2.png" alt="">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                              <h3>Email Us</h3>
                              <span> {{ $sysinfo->sys_email1}}</span>
                               <span> {{ $sysinfo->sys_email2}}</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                              <img src="assets/img/cct-icon3.png" alt="">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                              <h3>Phone No</h3>
                              <span> {{ $sysinfo->sys_phone1}}</span>
                              <span>{{ $sysinfo->sys_phone2}}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="yl-contact-form-wrap yl-headline">
                  <h3>Write us a message</h3>
                  <form class="yl-contact-form-area" action="#" method="post">
                     <div class="yl-contact-form-input d-flex">
                        <input type="text" placeholder="Your Name*">
                        <input type="email" placeholder="Your email*">
                        <input type="text" placeholder="Phone">
                     </div>
                     <textarea name="#" placeholder="Write your message here*"></textarea>
                     <button type="submit">Submit Now <i class="fas fa-arrow-right"></i></button>
                  </form>
               </div>
            </div>
         </section>
      <!-- End of contact content section
         ============================================= -->    
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
<script src="assets/js/gmaps.min.js"></script>
@endsection
