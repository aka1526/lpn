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
                <h2>WORLD RANKINGS</h2>
                 
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
             ============================================= -->

    <!-- Start of instructor details section
             ============================================= -->
    <section id="instructor-details" class="instructor-details-section">
        <div class="container">
            <div class="instructor-details-content position-relative">
                @foreach ($rankings as $item)
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="details-img">
                                <img src="{{ '/images/rankings/' . $item->rank_img }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="instructor-details-text">
                                <div class="clearfix instructor-details-text-top">
                                    <div class="float-left instructor-details-name-social yl-headline">

                                        <h3> {{ $item->rankings_weight }}</h3>
                                        <h4 class="mt-1">{{ $item->rankings_weight_desc }}</h4>
                                        <h3 class="mt-2 headtext"> WORLD CHAMPION:</h3>
                                        <h4 class="mt-1">Vacant : {{ $item->world_vacant }}</h4>
                                        <h4 class="mt-1">Won Title : {{ $item->world_won_title }} </h4>
                                        <h4 class="mt-1" >Last Defense : {{ $item->world_last_defense }} </h4>

                                        <h3 class="mt-2">INTERNATIONAL CHAMPION:</h3>
                                        <h4 class="mt-1">Vacant : {{ $item->international_vacant }}</h4>
                                        <h4 class="mt-1">Won Title : {{ $item->international_won_title }} </h4>
                                        <h4 class="mt-1" >Last Defense :{{ $item->international_last_defense }} </h4>
                                   
                                        

 
                                   
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            
                            <div class="yl-cta-contact-text">
                                
                                    <h3>Contenders :</h3>
                                    <?php
                                    $lists = \App\Models\Admins\Rankingslist::where('list_ref','=',$item->rank_uid)->orderBy('list_index')->get();
                                    ?>
                                    
                                    <ol  >
                                        @foreach ( $lists  as $listitem)
                                          <li class="list">{{ $listitem->contenders }}</li>  
                                        @endforeach
                                         
                                    </ol> 
                                 
                            </div>
                        </div>
                    </div>
                    <hr />
                @endforeach

            </div>
        </div>
    </section>
    <!-- End of instructor details section
             ============================================= -->

@endsection
