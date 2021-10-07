@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
    <link href="/assets/plugins/jqvmap/maps/css/toolkit-minimal.css" rel="stylesheet">
    <link href="/assets/plugins/jqvmap/maps/css/application-minimal.css" rel="stylesheet">
    <link href="/assets/plugins/jqvmap/maps/css/jqvmap.css" media="screen" rel="stylesheet" type="text/css">
    <link href="/assets/plugins/jqvmap/maps/css/prism-theme.css" rel="stylesheet" />

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

            <div class="yl-course-content-3">
                <div class="row">

                    <div class="col-md-12  ">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4 main-content-label text-center">
                                   
                                    <h3  style="color: #000;font-weight: 700;">MAP OF WORLD </h3>
                                </div>

                                <div id="map_world" class="text-center"
                                    style="width:  100%; height: 400px; margin: 0px auto; position: relative; overflow: hidden; ">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($continent as $item)
                        <div class="col-md-6 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4 main-content-label text-center">
                                        <h3 style="color: #000;font-weight: 700;">MAP OF {{ strtoupper($item)  }} </h3>
                                    </div>





                                    <div id="{{ $item }}"
                                        style="width:  100%; height: 350px; margin: 0px auto; position: relative; overflow: hidden;">
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
@section('js')

    <!-- Internal Map -->
    <script src="/assets/plugins/jqvmap/maps/data/toolkit.js"></script>
    <script src="/assets/plugins/jqvmap/maps/data/application.js"></script>
    <script src="/assets/plugins/jqvmap/maps/data/prism.js"></script>

    <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
    <script src="/assets/plugins/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
    <script src="/assets/plugins/jqvmap/maps/data/jquery.vmap.world_data.js"></script>
    <script>
        var member_continent = {!! json_encode($member_continent) !!};

        jQuery('#map_world').vectorMap({
            map: 'world_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#ffffff',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'polynomial',
            scaleColors: ['#C8EEFF', '#006491'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            //values: sample_data,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });

        jQuery('#africa').vectorMap({
            map: 'africa_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });
        jQuery('#europe').vectorMap({
            map: 'europe_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });
        jQuery('#australia').vectorMap({
            map: 'australia_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });
        jQuery('#asia').vectorMap({
            map: 'asia_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });

        jQuery('#north-america').vectorMap({
            map: 'north-america_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });
        jQuery('#north-america').vectorMap({
            map: 'north-america_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();

                console.log(message);
            }
        });
        jQuery('#south-america').vectorMap({
            map: 'south-america_en',
            backgroundColor: '#a5bfdd',
            borderColor: '#818181',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: '#f4f3f0',
            enableZoom: false,
            hoverColor: '#c9dfaf',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: '#c9dfaf',
            selectedRegions: null,
            showTooltip: true,
            colors: member_continent,
            onRegionClick: function(element, code, region) {
                var message = 'You clicked "' + region + '" which has the code: ' +
                    code.toUpperCase();
                console.log(message);
            }
        });
    </script>



@endsection
