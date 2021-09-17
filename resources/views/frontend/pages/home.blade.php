@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')
<section id="slider-4" class="slider-section-4  position-relative">
   <div class="bubble-dotted">
      <span class="dotted dotted-1"></span>
      <span class="dotted dotted-2"></span>
      <span class="dotted dotted-3"></span>
      <span class="dotted dotted-4"></span>
      <span class="dotted dotted-5"></span>
      <span class="dotted dotted-6"></span>
      <span class="dotted dotted-7"></span>
      <span class="dotted dotted-8"></span>
      <span class="dotted dotted-9"></span>
      <span class="dotted dotted-10"></span>
   </div>
   <div id="yl-main-slider-3" class="yl-main-slider-wrap owl-carousel">
      @foreach ($slidepage as $key => $item) 
      <div class="slider-main-item-3 position-relative">
         <div class="slider-main-img img-zooming" data-background="{{ isset($item->slidepages_img) ?  '/images/slidepage/'.$item->slidepages_img :''}}"></div>
         <div class="slider-overlay"></div>
         <div class="container">
            <div class="slider-main-text yl-headline text-center position-relative pera-content">
               <span class="shape-layer position-absolute"><img src="/assets/img/s-shape.png" alt=""></span>
               <span>{{ isset($item->slidepages_headline) ?  $item->slidepages_headline :''}}</span>
               <h1> {{ isset($item->slidepages_header) ?  $item->slidepages_header :''}}  </h1>
               {!!  $item->slidepages_detail   !!} 
               <a href="{{  $item->slidepages_link !='' ?  $item->slidepages_link :'#'}} "><i class="fas fa-user"></i> About us</a>
            </div>
         </div>
      </div>
      @endforeach 
    
      
   </div>
</section>
<!-- End of slider section
============================================= --> 

<!-- Start of top category section
============================================= -->
<section id="yl-top-category-4" class="yl-top-category-section-4">
   <div class="container">
      <div class="yl-top-category-content" data-background="assets/img/ct-bg.jpg">
         <div class="yl-section-title text-center yl-headline yl-title-style-two position-relative">
            <span> {{ isset($courses_slide) ? $courses_slide->pageheader_title : 'All Courses'  }}</span>
            <h2>{{ isset($courses_slide) ? $courses_slide->pageheader_header : ' There are the Courses'  }} </h2>
         </div>
         <div class="yl-top-category-slider owl-carousel">

            @foreach ($courseGroup as $item)
               <div class="yl-top-category-slide-item position-relative text-center">
                  <div class="yl-top-category-slide-icon">
                     <i class="{{ isset($item) ?  $item->course_icon : 'flaticon-design' }}"></i>
                  </div>
                  <div class="yl-top-category-slide-text yl-headline">
                     <h3><a href="{{ '/course/'.$item->course_link }}">{{ $item->course_name }}</a></h3>
                     <span>{{ $item->course_total }} Courses</span>
                     <a class="top-cat-more-icon" href="#"><i class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
            @endforeach
           
         </div>
      </div>
   </div>
</section>
<!-- End of top category section
============================================= -->
 
<!-- Start of Course section
============================================= -->
<section id="yl-course" class="yl-course-section">
   <div class="container">
      <div class="yl-course-top">
         <div class="row">
            <div class="col-lg-6">
               <div class="yl-section-title yl-headline">
                  <span>{{ isset($courses) ? $courses->pageheader_title : 'Courses'}}</span>
                  <h2> {{ isset($courses) ? $courses->pageheader_header : ''}}</h2>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="yl-course-title-text">
                  <span>{{ isset($courses) ? $courses->pageheader_detail : ''}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="yl-course-filter-wrap">
         <div class="button-group yl-course-filter-btn text-center clearfix">
            <button class="filter-button is-checked" data-filter="*">All courses </button>
            @foreach ($courseGroup  as  $groups)
               <button class="filter-button" data-filter=".{{ $groups->course_uid }}">{{ $groups->course_name}}</button>
            @endforeach
            
            {{-- <button class="filter-button" data-filter=".design"> Middle 𝐜𝐥𝐚𝐬𝐬</button>
            <button class="filter-button" data-filter=".health">𝐀𝐝𝐯𝐚𝐧𝐜𝐞 𝐜𝐥𝐚𝐬𝐬</button>
            <button class="filter-button" data-filter=".law">Children class  </button>

            <button class="filter-button" data-filter=".science">Normal class </button> --}}
         </div>
         <div class="filtr-container-area grid clearfix" 
         data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
            <div class="grid-sizer"></div>

            @foreach ($courseAll as $course_item)
            <div class="grid-item grid-size-25 {{ $course_item->courseref_uid }}" data-category="{{ $course_item->courseref_uid }}">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">{{ $course_item->course_item_price >0 ? '$'.$course_item->course_item_price : 'Free' }}</span>
                   <img src="{{ '/images/course/'.$course_item->course_item_url.'/'. $course_item->course_item_home_img }}" alt=""> 
                     <span class="c-hover-icon"><a href="{{ '/course/'. $course_item->course_item_url }}"><i class="fa fa-eye"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>Time:{{ number_format($course_item->course_item_duration,0)   }} Hr.</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="{{ '/course/'. $course_item->course_item_url }}">{{ $course_item->course_item_name }}</a></h3> 
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        {{-- <span>(12 Votes)</span> --}}
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm1.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Admin</a></h4>
                           <span>(Teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach

            {{-- <div class="grid-item grid-size-25 business design health" data-category="business design health">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs1.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Master of Public Health</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm1.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 law science" data-category="law science">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">Free</span>
                     <img src="assets/img/course/crs2.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">User Experience Research &
                        Design</a>
                     </h3>
                     <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                     </ul>
                     <span>(12 Votes)</span>
                  </div>
                  <div class="yl-course-mentor clearfix">
                     <div class="yl-c-mentor-img float-left">
                        <img src="assets/img/course/cm2.jpg" alt="">
                     </div>
                     <div class="yl-c-mentor-text">
                        <h4><a href="#">Alina Lora</a></h4>
                        <span>(Health teacher)</span>
                     </div>
                  </div>
               </div>
            </div>
            </div>
            <div class="grid-item grid-size-25 health science design" data-category="health science design">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs3.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Treat That Oral Thrush</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm3.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 business law business" data-category="business law business">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs4.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Copyright  Law in Music</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm4.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 science design science" data-category="science design science">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs5.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Master of Child Health</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm5.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 science law" data-category="science law">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs6.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Graphic Design Course</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm6.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 business science" data-category="business science">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs1.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Digital Marketing Course</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm5.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-item grid-size-25 law design" data-category="law design">
               <div class="yl-course-img-text">
                  <div class="yl-course-img position-relative">
                     <span class="c-price-tag">$40</span>
                     <img src="assets/img/course/crs8.jpg" alt="">
                     <span class="c-hover-icon"><a href="#"><i class="fas fa-plus"></i></a></span>
                  </div>
                  <div class="yl-course-text">
                     <div class="yl-course-meta">
                        <a href="#"><i class="fas fa-file"></i>14 Lessons</a>
                        <a href="#"><i class="fas fa-user"></i> 20 Students</a>
                     </div>
                     <div class="yl-course-tilte-head yl-headline ul-li">
                        <h3><a href="#">Financial Analyst Course</a></h3>
                        <ul>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                           <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span>(12 Votes)</span>
                     </div>
                     <div class="yl-course-mentor clearfix">
                        <div class="yl-c-mentor-img float-left">
                           <img src="assets/img/course/cm3.jpg" alt="">
                        </div>
                        <div class="yl-c-mentor-text">
                           <h4><a href="#">Alina Lora</a></h4>
                           <span>(Health teacher)</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div> --}}

      </div>
      {{-- <div class="yl-course-more-btn text-center">
         <a href="#">Load More <i class="fas fa-sync-alt"></i></a>
      </div> --}}
      {{-- <div class="blog-btn-4 text-center">
         <a href="#">View All Course</a>
      </div> --}}
   </div>
</div>
</section>
<!-- End of Course section
============================================= --> 

<!-- Start of Counter section
============================================= -->
<section id="yl-counter" class="yl-counter-section position-relative" data-background="assets/img/cnt-bg.jpg">
   <div class="bg-overlay"></div>
   <div class="container">
      <div class="yl-counter-content">
         <div class="row">
            <div class="col-md-3 col-sm-6">
               <div class="yl-counter-icon-text">
                  <div class="yl-counter-icon float-left">
                     <img src="assets/img/ci-1.png" alt="">
                  </div>
                  <div class="yl-counter-text yl-headline pera-content">
                     <span class="odometer" data-count="{{ count($courseAll) }}"> 00 </span> <strong>+</strong>
                     <p>  Total Courses</p>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="yl-counter-icon-text">
                  <div class="yl-counter-icon float-left">
                     <img src="assets/img/ci-2.png" alt="">
                  </div>
                  <div class="yl-counter-text yl-headline pera-content">
                     <span class="odometer" data-count="11500"> 00 </span> <strong>+</strong>
                     <p>Total Clients</p>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="yl-counter-icon-text">
                  <div class="yl-counter-icon float-left">
                     <img src="assets/img/ci-3.png" alt="">
                  </div>
                  <div class="yl-counter-text yl-headline pera-content">
                     <span class="odometer" data-count="18"> 00 </span> <strong>+</strong>
                     <p>Total Organization</p>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="yl-counter-icon-text">
                  <div class="yl-counter-icon float-left">
                     <img src="assets/img/ci-4.png" alt="">
                  </div>
                  <div class="yl-counter-text yl-headline pera-content">
                     <span class="odometer" data-count="605"> 00 </span> <strong>+</strong>
                     <p>Total Member</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End of Counter section
============================================= -->         


<!-- Start of blog section
============================================= -->       
<section id="yl-blog-4" class="yl-blog-section-4">
   <div class="container">
      <div class="yl-course-top">
         <div class="row">
            <div class="col-lg-6">
               <div class="yl-section-title yl-headline">
                  <span>{{ isset($news) ? $news->pageheader_title : 'last news'}}</span>
                  <h2>{{ isset($news) ? $news->pageheader_header : 'header'}}</h2>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="yl-course-title-text">
                  <span>{{ isset($news) ? $news->pageheader_detail : 'detail'}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="yl-blog-content-4">
         <div class="row">
            @foreach ($neweven as $itemNew)
            <div class="col-lg-4 col-md-6">
               <div class="yl-blog-img-text">
                  <div class="yl-blog-img text-center position-relative">
                     <img src="{{ $itemNew->news_img !='' ? '/images/news/'.$itemNew->news_url.'/thumbnails/'.$itemNew->news_img :'assets/img/blg1.jpg' }}" alt="">
                     <div class="yl-blog-date">
                        <i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($itemNew->news_datetime)->format('jS M, Y') }}
                     </div>
                  </div>
                  <div class="yl-blog-text yl-headline pera-content">
                     <div class="yl-blog-meta text-uppercase">
                        <a href="#"><i class="far fa-user"></i> admin</a>
                        <a href="#"><i class="far fa-folder-open"></i> training</a>
                     </div>
                     <div class="yl-blog-title">
                        <h3>
                           <a href="#">{{ $itemNew->news_toppic }}</a> 
                     </h3>
                     {!! $itemNew->news_desc !!}
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            
            
         </div>
         <div class="blog-btn-4 text-center">
            <a href="/news">View All News</a>
         </div>
      </div>
   </div>
</section>
<!-- End of of blog section
============================================= -->

<!-- Start of cta section
============================================= -->
<section id="yl-cta-4" class="yl-cta-section-4">
   <div class="container">
      <div class="yl-cta-content-4 d-flex">
         <div class="yl-cta-contact-4 yl-headline position-relative">
            <div class="yl-cta-img-4">
               <img src="assets/img/cta-m.png" alt="">
            </div>
            <div class="yl-cta-contact-text">
               <h3>Join with us to become an
                  Instructor. Send us your
               CV today.</h3>
               <a href="{{ route('fn.contact')}}">Contact us  <i class="fas fa-chevron-right"></i></a>
            </div>
         </div>
         <div class="yl-cta-register-4 yl-headline text-center" data-background="assets/img/ct-bg.jpg">
            <div class="yl-cta-register-text">
               <h3>Get Today 25% Discount for
               Corona Situation!</h3>
               <a href="#">Register now <i class="fas fa-chevron-right"></i> </a>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection