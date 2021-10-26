@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('og_img', URL::to('/images/news/' . $news->news_url . '/' . $news->news_img))
@section('og_url', URL::to('/news/detail/'. $news->news_url) )
@section('og_title',  $news->news_toppic )
@section('og_description',  $news->news_desc)
@section('css')
<link href="/adminpage/assets/plugins/gallery/gallery.css" rel="stylesheet">
@endsection
@section('content')


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

    <!-- Start of Event details section
             ============================================= -->
    <section id="event-details" class="event-details-section">
        <div class="container">
            <div class="event-details-content">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="event-details-text-wrap">
                            <div class="event-details-img">
                                <img src="{{ '/images/news/' . $news->news_url . '/' . $news->news_img }}" alt="">
                            </div>
                            <div class="event-details-text yl-headline pera-content">
                                <h3>{{ $news->news_toppic }}</h3>
                                {!! $news->news_desc !!}
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
                                        <span> {{ date('d-m-Y', strtotime($news->news_datetime)) }}</span>
                                    </div>
                                    <div class="ed-inner-widget">
                                        <div class="ed-inner-title"><i class="fas fa-clock"></i>Create Time:</div>
                                        <span> {{ date('H:i A', strtotime($news->news_datetime)) }}</span>
                                    </div>
                                    <div class="ed-inner-widget">
                                        <div class="ed-inner-title"><i class="far fa-folder-open"></i> Catalog:</div>
                                        <span> {{ $news->news_group }}</span>
                                    </div>
                                    <div class="ed-inner-widget">
                                        <div class="ed-inner-title"><i class="fas fa-map-marker-alt"></i> Location:</div>
                                        <span> {{ $news->news_location }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="yl-blog-widget-wrap">
                                <div class="yl-recent-blog-widget clearfix">
                                   <h3 class="widget-title">Recent News</h3>
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <div class="card mg-b-20 " style="display : {{ count($NewsGallery) > 0 ? '' : 'none' }} ">
                            <div class="card-header tx-medium bd-0 text-white bg-secondary  ">
                                <div class=" ">
                                    <h4 class="card-title mg-b-0 text-white text-center">
                                        News Gallery
                                    </h4>

                                </div>

                            </div>
                            <div class="card-body">

                                <!-- Gallery -->
                                <div class="demo-gallery">
                                    <ul id="lightgallery" class="list-unstyled row row-sm">
                                        @foreach ($NewsGallery as $img)
                                            <li class="col-sm-3 col-md-3 col-lg-3"
                                                data-responsive="{{ '/images/news/' . $img->gallery_url . '/gallery/' . $img->gallery_filename }}"
                                                data-src="{{ '/images/news/' . $img->gallery_url . '/gallery/' . $img->gallery_filename }}"
                                                data-sub-html="<h4>{{ $img->gallery_filename }}</h4>">
                                                <a href="">
                                                    <img class="img-responsive"
                                                        src="{{ '/images/news/' . $img->gallery_url . '/gallery/' . $img->gallery_filename }}"
                                                        alt="Thumb-1">
                                                </a>
                                            </li>
                                        @endforeach


                                    </ul>
                                    <!-- /Gallery -->

                                </div>
                                <!-- row closed -->
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ed-more-event yl-headline  mt-5">
                    <h3>More Events Like This</h3>
                    <div class="ed-more-event-content">
                        <div class="row">
                            @foreach ($randomnews as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="yl-event-innerbox yl-headline">
                                        <div class="yl-event-img">
                                            <img src="{{ '/images/news/' . $item->news_url . '/' . $item->news_img }}" alt="">
                                        </div>
                                        <div class="yl-event-text position-relative">
                                            <div class="event-date text-center">
                                                {{ date('d', strtotime($item->news_datetime)) }}
                                                <span>{{ date('M', strtotime($item->news_datetime)) }}</span>
                                            </div>
                                            <h3><a
                                                    href="/news/detail/{{ $item->news_url }}">{{ $item->news_toppic }}</a>
                                            </h3>
                                            <div class="yl-event-meta">
                                                <a href=""><i class="fas fa-map-marker-alt"></i>
                                                    {{ $item->news_location }}</a>
                                                <a href=""><i class="far fa-clock"></i>
                                                    {{ date('d-m-Y H:i A', strtotime($item->news_datetime)) }}</a>
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
@section('js')

    <!-- Internal Gallery js -->
    <script src="/adminpage/assets/plugins/gallery/lightgallery-all.min.js"></script>
    <script src="/adminpage/assets/plugins/gallery/jquery.mousewheel.min.js"></script>
    <script src="/adminpage/assets/js/gallery.js"></script>

@endsection
