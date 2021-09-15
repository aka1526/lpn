@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')

 <!-- Start of breadcrumb section
         ============================================= -->
         <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative"
          data-background="{{'/images/aboutus/'.$aboutus->aboutus_url.'/'. $aboutus->aboutus_img }}">
            <span class="breadcrumb-overlay position-absolute"></span>
            <div class="container">
               <div class="yl-breadcrumb-content text-center yl-headline"> 
                  <h2>{{$aboutus->aboutus_header }}</h2>
                   
              </div>
           </div>
        </section>
      <!-- End of breadcrumb section
         ============================================= -->
   <!-- Start of Faq page section
         ============================================= -->
         <section id="faq-main" class="faq-main-section">
            <div class="container">
               <div class="faq-main-content">
                  
                  <div class="yl-faq-tab-wrapper">
                     {{-- <div id="tabsContent" class="tab-content">
                        <div id="admission" class="tab-pane fade active show">
                           <div class="yl-faq-content-area">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to take a good course from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a discount from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to develop a course management system?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>Why Yale is the best lms template on themeforest?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a rerund from Yale University?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>What features you expect from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="payments" class="tab-pane fade">
                           <div class="yl-faq-content-area">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to take a good course from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a discount from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to develop a course management system?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>Why Yale is the best lms template on themeforest?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a rerund from Yale University?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>What features you expect from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="courses" class="tab-pane fade">
                           <div class="yl-faq-content-area">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to take a good course from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a discount from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to develop a course management system?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>Why Yale is the best lms template on themeforest?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a rerund from Yale University?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>What features you expect from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="instructors" class="tab-pane fade">
                           <div class="yl-faq-content-area">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to take a good course from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a discount from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to develop a course management system?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>Why Yale is the best lms template on themeforest?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a rerund from Yale University?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>What features you expect from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="refunds" class="tab-pane fade">
                           <div class="yl-faq-content-area">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to take a good course from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a discount from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to develop a course management system?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="yl-faq-que-ans">
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>Why Yale is the best lms template on themeforest?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>How to get a rerund from Yale University?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>
                                       <div class="yl-faq-que-ans-content yl-headline pera-content">
                                          <h3>What features you expect from Yale?</h3>
                                          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia de serunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste der natus error sit voluptatem accusantium doloremque laudantium</p>
                                       </div>      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                     {!! $aboutus->aboutus_desc !!}
                  </div>
               </div>
            </div>
         </section>
      <!-- End of  Faq page section
@endsection