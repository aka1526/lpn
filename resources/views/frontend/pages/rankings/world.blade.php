@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')
    <style>
 .instructor-details-name-social h3 {
    color: #000000;
    font-size: 20px;
    font-weight: 700;
    padding-bottom: 5px;
}
.h4, h4 {
    font-size: 1.0rem;
}
.yl-cta-contact-text .list {
    color: #000000;
    font-size: 1.01rem;
}
    </style>
    <!-- Start of breadcrumb section
             ============================================= -->
    <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative"
        data-background="/assets/img/ct-bg.jpg">
        <span class="breadcrumb-overlay position-absolute"></span>
        <div class="container">
            <div class="text-center yl-breadcrumb-content yl-headline">
                <h2>WORLD CHAMPIONS</h2>
              
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
             ============================================= -->

    <!-- Start of instructor details section
             ============================================= -->
            
    <section id="instructor-details" class="instructor-details-section">
        <div class="yl-section-title yl-headline">
                 
           
         </div>
        <div class="container">
           
            <div class="instructor-details-content position-relative">
                <h2 class="text-center text-danger">{{ isset($rankingslist[0]) ? $rankingslist[0]->contenders_gander : '' }} CHAMPIONS</h2>

                <div class="row row-sm mt-4">
                    @if (isset($rankingslist))
                    
                    @foreach ($rankingslist as $item)
                    
                    <div class="col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header tx-medium bd-0 tx-primary text-center">
                                <h5 class="card-title tx-dark tx-medium mg-b-10" style="color: #000000!important;font-size: 20px;">{{ $item->rankings_weight }}</h5>
                                <p class="card-subtitle mg-b-15" style="color: #51b788!important;font-size: 16px;">{{ $item->rankings_weight_desc }}</p>
                            </div>
                            <div class="card-body ">
                            <img alt="Image" class="img-fluid card-img-top" 
                            
                            src="{{ $item->contenders_img !='' ?  '/images/rankings/'.$item->contenders_img : ''}} " 
                            onerror="this.src='/images/rankings/nopic.jpg'" >
                          
                               
                            </div>
                            <div class="card-text bd-t text-center">
                                <h4 class="card-title mb-3 text-center" style="color: #000000!important;font-size: 20px;">{{ $item->contenders }}</h4>
                                <p class="card-text"> Won Title : <strong>{{ $item->won_title }}</strong> </p>
                                <p class="card-text"> Last Defense : <strong>{{ $item->last_defense }}</strong> </p>
                            </div>
                        </div>
                    </div><!-- col-4 -->
                     @endforeach 
                    @endif
                   

                    
                   
                    
                </div>

            </div>
        </div>
    </section>
    <!-- End of instructor details section
             ============================================= -->

@endsection
