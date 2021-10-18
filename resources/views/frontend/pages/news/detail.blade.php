@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')
 
 
<section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" 
data-background="/assets/img/ct-bg.jpg" 
style="background-image: url('/assets/img/ct-bg.jpg');">
   <span class="breadcrumb-overlay position-absolute"></span>
   <div class="container">
      <div class="yl-breadcrumb-content text-center yl-headline"> 
         <h2> 
            @foreach(App\Models\Admins\Pageheader::where('pageheader_type','=','news')->get() as $pageabout)
             {{ $pageabout->pageheader_header}} 
            @endforeach

         </h2>
          
    </div>
 </div>
</section>
 
     <!-- Start of Event details section
         ============================================= -->
         <section id="event-details" class="event-details-section">
            <div class="container">
               <div class="event-details-content">
                  <div class="row">
                     <div class="col-lg-9">
                        <div class="event-details-text-wrap">
                           <div class="event-details-img">
                              <img src="assets/img/event/ed1.jpg" alt="">
                           </div>
                           <div class="event-details-text yl-headline pera-content">
                              <h3>{{ $news->news_toppic}}</h3>
                              {!! $news->news_desc!!}
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="yl-event-sidebar">
                           <div class="yl-event-widget ul-li yl-headline">
                              <h3 class="widget-title">Event Details</h3>
                              <div class="event-details-widget-item">
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-calendar-alt"></i> Date:</div>
                                    <span>December 10, 2020</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-clock"></i> Time:</div>
                                    <span>10.00am - 02.00pm</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-map-marker-alt"></i> Location:</div>
                                    <span>ThemeXriver HQ
                                    Khulna, BD</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-dollar-sign"></i> Fees:</div>
                                   <b>Free</b>
                                 </div>
                              </div>
                              <a class="ed-book-btn text-center" href="#">Book your seat</a>
                           </div>
                           <div class="yl-event-widget ul-li yl-headline">
                              <h3 class="widget-title">Organizer</h3>
                              <div class="event-details-widget-item">
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-calendar-alt"></i> Name:</div>
                                    <span>ThemeXriver</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-map-marker-alt"></i> Address:</div>
                                    <span>100, Jassore Raod, Khulna</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-envelope"></i> Email:</div>
                                    <span>hello@themexriver.com</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-phone"></i> Phone:</div>
                                    <span>+880 1234 567890 </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="ed-more-event yl-headline">
                     <h3>More Events Like This</h3>
                     <div class="ed-more-event-content">
                        <div class="row">
                           <div class="col-lg-4 col-md-6">
                              <div class="yl-event-innerbox yl-headline">
                                 <div class="yl-event-img">
                                    <img src="assets/img/event/ev1.jpg" alt="">
                                 </div>
                                 <div class="yl-event-text position-relative">
                                    <div class="event-date text-center">
                                       09
                                       <span>dec</span>
                                    </div>
                                    <h3><a href="#">A day long workshop on music production</a></h3>
                                    <div class="yl-event-meta">
                                       <a href=""><i class="fas fa-map-marker-alt"></i> Florida University</a>
                                       <a href=""><i class="far fa-clock"></i> 10.00am - 12.00pm</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-6">
                              <div class="yl-event-innerbox yl-headline">
                                 <div class="yl-event-img">
                                    <img src="assets/img/event/ev2.jpg" alt="">
                                 </div>
                                 <div class="yl-event-text position-relative">
                                    <div class="event-date text-center">
                                       09
                                       <span>dec</span>
                                    </div>
                                    <h3><a href="#">Put your hands dirty with user experience</a></h3>
                                    <div class="yl-event-meta">
                                       <a href=""><i class="fas fa-map-marker-alt"></i> Florida University</a>
                                       <a href=""><i class="far fa-clock"></i> 10.00am - 12.00pm</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-6">
                              <div class="yl-event-innerbox yl-headline">
                                 <div class="yl-event-img">
                                    <img src="assets/img/event/ev3.jpg" alt="">
                                 </div>
                                 <div class="yl-event-text position-relative">
                                    <div class="event-date text-center">
                                       09
                                       <span>dec</span>
                                    </div>
                                    <h3><a href="#">Hadns on workshop to starting a new course</a></h3>
                                    <div class="yl-event-meta">
                                       <a href=""><i class="fas fa-map-marker-alt"></i> Florida University</a>
                                       <a href=""><i class="far fa-clock"></i> 10.00am - 12.00pm</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>   
      <!-- End of Event details section
         ============================================= --> 
 
@endsection