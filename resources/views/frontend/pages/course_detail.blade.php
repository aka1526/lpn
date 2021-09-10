@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')
   <!-- Start of breadcrumb section
         ============================================= -->
         <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" data-background="/assets/img/banner/bn-bg1.jpg">
            <span class="breadcrumb-overlay position-absolute"></span>
            <div class="container">
               <div class="yl-breadcrumb-content text-center yl-headline"> 
                  <h2>  {{  $courses_item->course_item_name  }}</h2>
                  <div class="yl-breadcrumb-item ul-li">
                     <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item"><a href="/course/{{ $course->course_link }}">{{ $course->course_name }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $courses_item->course_item_name }}</li>
                   </ul>
                </div>
             </div>
          </div>
       </section>
      <!-- End of breadcrumb section
         ============================================= -->
       <!-- Start of course details section
         ============================================= -->   
         <section id="course-details" class="course-details-section">
            <div class="container">
               <div class="course-details-content">
                  <div class="row">
                     <div class="col-lg-9">
                        <div class="course-details-tab-area">
                           <div class="course-details-main-img">
                              <img src="/assets/img/banner/cd-bg.jpg" alt="">
                           </div>
                           <div class="course-details-tab-wrapper">
                              
                              <div class="course-details-tab-content-wrap">
                                 <div id="tabsContent" class="tab-content">
                                    <div id="overview" class="tab-pane fade  active show">
                                       <div class="course-details-overview yl-headline pera-content">
                                          <div class="course-overview-text">
                                             {!! $courses_item->course_details !!}
                                          </div>
                                          
                                       </div>
                                    </div>
                              
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="course-details-widget">
                           {{-- <div class="course-widget-wrap">
                              <div class="cd-video-widget position-relative">
                                 <img src="/assets/img/course/cd-v.jpg" alt="">
                                 <a class="video_box text-center" href="#"><i class="fas fa-play"></i></a>
                              </div>
                           </div> --}}
                           <div class="course-widget-wrap">
                              <div class="cd-course-table-widget">
                                 <div class="cd-course-table-list">
                                    <div class="course-table-item clearfix">
                                       <span class="cd-table-title float-left"><i class="fas fa-clock"></i> Duration : </span>
                                       <span class="cd-table-valur float-right">{{ $courses_item->course_item_duration }} Hr.</span>
                                    </div>
                                    <div class="course-table-item clearfix">
                                       <span class="cd-table-title float-left"><i class="fas fa-users"></i> Students  : </span>
                                       <span class="cd-table-valur float-right"> {{ $courses_item->course_item_students }}</span>
                                    </div>  
                 
                                    <div class="course-table-item clearfix">
                                       <span class="cd-table-title float-left"><i class="fas fa-paste"></i> Certificate : </span>
                                       <span class="cd-table-valur float-right">Yes</span>
                                    </div> 
                                 </div>
                                 <div class="cd-course-price clearfix">
                                    <span><strong>${{ $courses_item->course_item_price }}</strong></span>
                                    <a href="#">Buy</a>
                                 </div>
                              </div>
                           </div>
                           {{-- <div class="course-widget-wrap">
                              <div class="cd-course-news-widget yl-headline">
                                 <h3 class="cd-widget-title">More Courses for you:</h3>
                                 <div class="cd-course-news-item">
                                    <div class="cd-course-news-img-text">
                                       <div class="cd-course-news-img float-left">
                                          <img src="/assets/img/course/cdnw1.jpg" alt="">
                                       </div>
                                       <div class="cd-course-news-text">
                                          <a href="#">Python Bootcamp
                                          Zero to Hero</a>
                                          <span>$39</span>
                                       </div>
                                    </div>
                                    <div class="cd-course-news-img-text">
                                       <div class="cd-course-news-img float-left">
                                          <img src="/assets/img/course/cdnw2.jpg" alt="">
                                       </div>
                                       <div class="cd-course-news-text">
                                          <a href="#">New Way  Learn
                                          Piano</a>
                                          <span>$39</span>
                                       </div>
                                    </div>
                                    <div class="cd-course-news-img-text">
                                       <div class="cd-course-news-img float-left">
                                          <img src="/assets/img/course/cdnw3.jpg" alt="">
                                       </div>
                                       <div class="cd-course-news-text">
                                          <a href="#">Guitar learning for 
                                             Beginner
                                          </a>
                                          <span>$39</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div> --}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      <!-- End of course details section
         ============================================= -->  
            
@endsection
@section('js')
 
@endsection
