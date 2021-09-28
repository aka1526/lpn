@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')
<style>
    .event-area-section {
    padding: 20px 0px;
    background-color: #f2f2f4;
}
</style>
    <!-- Start of breadcrumb section
             ============================================= -->
    {{-- <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" data-background="/assets/img/ct-bg.jpg">
        <span class="breadcrumb-overlay position-absolute"></span>

    </section> --}}
    <!-- End of breadcrumb section
             ============================================= -->

    <!-- Start of event content section
             ============================================= -->
    <section id="event-area" class="event-area-section">

        <div class="container">
         <div class="event-content-wrap">
            <div class=" row justify-content-center">
               <div class="col-auto mb-3">
                   
                     <form action="">
                        <input type="text" id="search" name="search" value="" placeholder="Enter Name">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                     </form>
                   
              
               </div>
            </div>
         </div>
            <div class="event-content-wrap">

                <div class="row">
                    @foreach ($members as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="p-3 mb-5 bg-white rounded shadow yl-event-innerbox">
                            <div class="yl-event-img">
                                <img src="{{ $item->img_idcard != '' ? '/images/members/card/' . $item->img_idcard : '' }}" alt="">
                            </div>
                            <div class="yl-event-text position-relative">
                                <div class="text-center event-date">
                                     {{  str_pad($item->khan_no, 2, '0', STR_PAD_LEFT) }}
                                    <span>khan</span>
                                </div>
                                <h3><a href="#">{{ $item->full_name}}</a></h3>
                                <div class="yl-event-meta">
                                    <a href=""><i class="fas fa-map-marker-alt"></i> {{ $item->country_name}}</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
             
                </div>
                {{-- <div class="text-center yl-event-btn">
                    <a href="#">Load More</a>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- End of of event content section
             ============================================= -->

@endsection
