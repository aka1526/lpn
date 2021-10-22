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
                              <img src="{{ '/images/news/'. $news->news_url.'/'.$news->news_img}}" alt="">
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
                                    <span> {{   date('d-m-Y', strtotime($news->news_datetime)) }}</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-clock"></i>Create Time:</div>
                                    <span> {{  date('H:i A', strtotime($news->news_datetime))}}</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="far fa-address-book"></i> Catalog:</div>
                                    <span> {{ $news->news_group}}</span>
                                 </div>
                                 <div class="ed-inner-widget">
                                    <div class="ed-inner-title"><i class="fas fa-map-marker-alt"></i> Catalog:</div>
                                    <span> {{ $news->news_location}}</span>
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
                           @foreach ($randomnews as $item)
                           <div class="col-lg-4 col-md-6">
                              <div class="yl-event-innerbox yl-headline">
                                 <div class="yl-event-img">
                                    <img src="{{ '/images/news/'. $item->news_url.'/'.$item->news_img}}" alt="">
                                 </div>
                                 <div class="yl-event-text position-relative">
                                    <div class="event-date text-center">
                                       {{   date('d', strtotime($item->news_datetime)) }}
                                       <span>{{   date('M', strtotime($item->news_datetime)) }}</span>
                                    </div>
                                    <h3><a href="/news/detail/{{ $item->news_url}}">{{ $item->news_toppic}}</a></h3>
                                    <div class="yl-event-meta">
                                       <a href=""><i class="fas fa-map-marker-alt"></i> {{ $item->news_location}}</a>
                                       <a href=""><i class="far fa-clock"></i> {{  date('d-m-Y H:i A', strtotime($item->news_datetime))}}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>   
      <!-- End of Event details section
         ============================================= --> 
 
@endsection