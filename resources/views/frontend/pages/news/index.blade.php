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
<!-- Start of blog section
============================================= -->       
<section id="course-page-course" class="course-page-course-section">
   <div class="container">
      
      <div class="course-page-courses-item">
         <div class="row">
            @foreach ($news as $item)
            <div class="col-lg-4 col-md-6">
               <div class="yl-blog-img-text">
                  <div class="yl-blog-img text-center position-relative">
                     <img src="{{ $item->news_img !='' ? '/images/news/'.$item->news_url.'/thumbnails/'.$item->news_img :'assets/img/blg1.jpg' }}" alt="">
                     <div class="yl-blog-date">
                        <i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($item->news_datetime)->format('jS M, Y') }}
                     </div>
                  </div>
                  <div class="yl-blog-text yl-headline pera-content">
                     <div class="yl-blog-meta text-uppercase">
                        @if ($item->news_group !='')
                        <a href="/news/detail/{{ $item->news_url }}"><i class="far fa-folder-open"></i> {{ $item->news_group}}</a>
                        @endif
                        
                        @if ($item->news_location !='')
                        <a href="/news/detail/{{ $item->news_url }}"><i class="fas fa-map-marker-alt"></i> {{ $item->news_location}}</a>
                        @endif
                      
                     </div>
                     <div class="yl-blog-title">
                        <h3>
                           <a href="/news/detail/{{ $item->news_url }}">{{ $item->news_toppic }}</a> 
                     </h3>
                     {!! $item->news_desc !!}
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            
         </div>
         <div class="yl-course-pagination  text-center ul-li">
            {{ $news->links('pagination.course', ['paginator' => $news, 'link_limit' => $news->perPage()]) }}
        </div>
      </div>
   </div>
</section>
<!-- End of of blog section
============================================= -->

 
@endsection