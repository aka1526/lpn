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
                  <h2>Courses</h2>
                  <div class="yl-breadcrumb-item ul-li">
                     <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $course->course_name }}</li>
                   </ul>
                </div>
             </div>
          </div>
       </section>
      <!-- End of breadcrumb section
         ============================================= -->
<!-- Start of category section
         ============================================= -->
         <section id="yl-category" class="yl-category-section">
            <div class="container">
               <div class="yl-section-title text-center yl-headline yl-title-style-two position-relative">
                  <p class="title-watermark">{{ isset($course->course_description) ? $course->course_description : 'Course Description' }}  </p>
                  <span>{{ isset($course->course_name) ? $course->course_name : 'Course Header' }} </span>
                  <h2> {{ isset($course->course_description) ? $course->course_description : 'Course Description' }}  </h2>
               </div>
            </div>          
 
         </section>
         <!-- End of category section
         ============================================= -->

      <!-- Start of course page section
         ============================================= -->
         <section id="course-page-course" class="course-page-course-section">
             <div class="container">
               <div class="course-page-course-content">
                  
                  <div class="course-page-courses-item">
                     <div class="row">
                        @foreach ($courses_item as $item)
                        <div class="col-lg-4 col-md-6">
                           <div class="yl-popular-course-img-text">
                              <div class="yl-popular-course-img text-center">
                                 <a href="{{ $item->course_item_url}}"> <img src="/assets/img/course/cpc1.jpg" alt=""></a>
                              </div>
                              <div class="yl-popular-course-text">
                                 <div class="popular-course-fee clearfix">
                                    <span>Course Fee:  </span>
                                    <div class="course-fee-amount">
                                       <del>${{ $item->course_item_price +10}}</del>
                                       <strong>${{ $item->course_item_price }}</strong>
                                    </div>
                                 </div>
                                 <div class="popular-course-title yl-headline">
                                    <h3><a href="{{ $item->course_item_url}}"> {{ $item->course_item_name }} </a>
                                    </h3>
                                    <div class="yl-course-meta">
                                        
                                       <a href="#"><i class="fas fa-file"></i>{{ $item->course_item_lessons}} Lessons</a>
                                
                                       <a href="#"><i class="fas fa-clock"></i> {{ $item->course_item_duration}}  Hr.</a>
                                    </div>
                                 </div>
                                 <div class="popular-course-rate clearfix ul-li">
                                    <div class="p-rate-vote float-left">
                                       <ul>
                                          <li><i class="fas fa-star"></i></li>
                                          <li><i class="fas fa-star"></i></li>
                                          <li><i class="fas fa-star"></i></li>
                                          <li><i class="fas fa-star"></i></li>
                                          <li><i class="fas fa-star"></i></li>
                                       </ul>
                                       {{-- <span>(12 Votes)</span> --}}
                                    </div>
                                    <div class="p-course-btn float-right">
                                       <a href="#"><i class="fas fa-chevron-right"></i></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        
                     
                     </div>
                     <div class="yl-course-pagination text-center ul-li">
                        {{ $courses_item->links('pagination.course', ['paginator' => $courses_item, 'link_limit' => $courses_item->perPage()]) }}
                        {{-- <ul>
                           <li>
                              <a href="#">01</a>
                              <a href="#">02</a>
                              <a href="#">03</a>
                           </li>
                        </ul> --}}
                     </div>
                  </div>
               </div>
             </div>
         </section>
      <!-- End of course page section
         ============================================= -->    
@endsection
@section('js')
 
@endsection
