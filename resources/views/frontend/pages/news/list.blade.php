@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
 
@endsection
@section('content')

<style>
    .yl-blog-img-text-2 .yl-blog-img-2 .yl-blog-date-2 {
    left: 25px;
    width: 80px;
    height: 80px;
    bottom: -30px;
    padding-top: 13px;
    border-radius: 3px;
    position: absolute;
    background-color: #e95108;
}
 
     #social-links ul{
          padding-left: 0;
     }
     #social-links ul li {
          display: inline-block;
     } 
     #social-links ul li a {
          padding: 6px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin: 1px;
          font-size: 25px;
     }
     #social-links .fa-facebook{
           color: #0d6efd;
     }
     #social-links .fa-twitter{
           color: deepskyblue;
     }
     #social-links .fa-linkedin{
           color: #0e76a8;
     }
     #social-links .fa-whatsapp{
          color: #25D366
     }
     #social-links .fa-reddit{
          color: #FF4500;;
     }
     #social-links .fa-telegram{
          color: #0088cc;
     }
     </style>
<div id="fb-root"></div>
 
    <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" data-background="/assets/img/ct-bg.jpg"
        style="background-image: url('/assets/img/ct-bg.jpg');">
        <span class="breadcrumb-overlay position-absolute"></span>
        <div class="container">
            <div class="yl-breadcrumb-content text-center yl-headline">
                <h2>
                    @foreach (App\Models\Admins\Pageheader::where('pageheader_type', '=', 'news')->get() as $pageabout)
                        {{ $pageabout->pageheader_header }}
                    @endforeach

                </h2>

            </div>
        </div>
    </section>
    

     <!-- Start of blog feed list section
         ============================================= -->   
         <section id="blog-feed-list" class="blog-feed-list-section">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-12 mt--5">
                        <div class=" clearfix">
                            <a href="/news/list" class="btn btn-primary float-right text-white ml-2"><i class="fa fa-list"
                                    aria-hidden="true"></i></a>
                            <a href="/news" class="btn btn-danger float-right ml-2 text-white"><i class="fa fa-th-large"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
               <div class="blog-feed-list-content">
                  <div class="row">
                     <div class="col-lg-9">
                        <div class="blog-feed-list-post">
                            @foreach ($news as $item)
                            <div class="blog-feed-list-img-text">
                                <div class="yl-blog-img-text-2 yl-headline pera-content">
                                   <div class="yl-blog-img-2 position-relative">
                                      <div class="yl-blog-img-warap-2 position-relative">
                                         {{-- <img src="/assets/img/blg-li-1.jpg" alt=""> --}}
                                         <img src="{{ $item->news_img != '' ? '/images/news/' . $item->news_url . '/' . $item->news_img : 'assets/img/blg1.jpg' }}" style="width: 870px; height: 432px" alt=""> 
                                      </div>
                                      <div class="yl-blog-date-2 text-center">
                                         <a href="#">10<span>Feb/20</span></a>
                                      </div>
                                   </div>
                                   <div class="yl-blog-text-2">
                                      <div class="yl-blog-meta-2 text-uppercase">
                                         <a href="/news/catalog/{{ $item->news_group }}">{{ $item->news_group }}</a>
                                         <a href="/news/location/{{ $item->news_location}}"> {{ $item->news_location}}</a>
                                      </div>
                                      <div class="yl-blog-title-text-2">
                                         <h3><a href="/news/detail/{{ $item->news_url}}">{{ $item->news_toppic }}</a>
                                         </h3>
                                         <p>
                                            {!! $item->news_desc !!} 
                                         </p>
                                         <div class="yl-blog-list-bottom clearfix">
                                            <a class="yl-blog-more float-left text-uppercase" href="/news/detail/{{ $item->news_url}}">Read more <span>+</span></a>
                                            <div class="yl-blog-list-share float-right">
                                               <span class="blog-share-slug text-uppercase">Share</span>
                                                
                                               {!!  \Share::page("https://lpn.satangapp.in/news/detail/". $item->news_url."/",".$item->news_toppic .")
                                          ->facebook()->twitter();  !!}
                                               
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                            @endforeach
                          
                           
                        </div>
                        <div class="yl-course-pagination  text-center ul-li">
                            {{ $news->links('pagination.course', ['paginator' => $news, 'link_limit' => $news->perPage()]) }}
                        </div>
                        {{-- <div class="yl-course-pagination clearfix text-center ul-li">
                           <ul>
                              <li>
                                 <a href="#">01</a>
                                 <a href="#">02</a>
                                 <a href="#">03</a>
                              </li>
                           </ul>
                        </div> --}}
                     </div>
                     <div class="col-lg-3">
                        <div class="yl-blog-sidebar">
                           {{-- <div class="yl-blog-widget-wrap">
                              <div class="yl-search-widget position-relative">
                                 <form action="#" method="post">
                                    <input type="text" placeholder="Search">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                 </form>
                              </div>
                           </div> --}}
                           <div class="yl-blog-widget-wrap">
                              <div class="yl-category-widget yl-headline ul-li-block position-relative">
                                 <h3 class="widget-title">Category</h3>
                                 <ul>
                                     @foreach ($NewsCatalog as $item)
                                     <li><a href="/news/catalog/{{ $item->catalog_name }}">{{ $item->catalog_name }}</a></li>
                                     @endforeach
                                    
                                 </ul>
                              </div>
                           </div>
                           <div class="yl-blog-widget-wrap">
                              <div class="yl-recent-blog-widget clearfix">
                                 <h3 class="widget-title">Recent Posts</h3>
                                 @foreach ($RecentNews as $item)
                                 <div class="yl-recent-blog-img-text">
                                     <div class="yl-recent-blog-img float-left">
                                        <img src="{{ '/images/news/'.$item->news_url.'/thumbnails/'.$item->news_img}}" alt="">
                                     </div>
                                     <div class="yl-recent-blog-text">
                                        <span>{{ \Carbon\Carbon::parse($item->news_datetime)->format('M d, Y')  }}</span>
                                        <h3><a href="/news/detail/{{ $item->news_url}}"> {{ $item->news_toppic}}</a></h3>
                                     </div>
                                  </div>
                                 @endforeach
                              </div>
                           </div>
                           {{-- <div class="yl-blog-widget-wrap">
                              <div class="yl-blog-category-widget">
                                 <h3 class="widget-title">Popular Tags</h3>
                                 <div class="yl-blog-category-tag ul-li">
                                    <a href="#">Design</a>
                                    <a href="#">Development</a>
                                    <a href="#">Photoshop</a>
                                    <a href="#">Graphcis</a>
                                    <a href="#">Management</a>
                                    <a href="#">Web</a>
                                 </div>
                              </div>
                           </div> --}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      <!-- End of blog feed list section
         ============================================= -->   

@endsection
@section('js')
<script src="{{ asset('js/share.js') }}"></script>
@endsection

