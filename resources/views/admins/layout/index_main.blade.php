<!DOCTYPE html>
<html lang="en">

<head>
    @include('admins.includes.header')
    @yield('css')
    
     
</head>

<body class="main-body">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('adminpage/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    <!-- Page -->
    <div class="page">

      
        <!-- main-menu_nav opened -->
        @include('admins.includes.menu_nav')
        <!-- menu_nav closed -->

        <!-- main-content opened -->
        @yield('content')
        <!-- Container closed -->

        <!-- Sidebar-right-->
        @include('admins.includes.sidebar')
        <!--/Sidebar-right-->

        <!-- Footer opened -->
        <div class="main-footer ht-40">
            <div class="container-fluid pd-t-0-f ht-100p">
                <span>Copyright © 2021 <a href="#">
Lumpinee Academy Muaythai</a>.  
                    All
                    rights reserved.</span>
            </div>
        </div>
        <!-- Footer closed -->

    </div>
    <!-- End Page -->
 
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
     
    <!-- JQuery min js -->
    <script src="{{ asset('adminpage/assets/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Bundle js -->
    <script src="{{ asset('adminpage/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Ionicons js -->
    <script src="{{ asset('adminpage/assets/plugins/ionicons/ionicons.js')}}"></script>

    <!-- Moment js -->
    <script src="{{ asset('adminpage/assets/plugins/moment/moment.js')}}"></script>

    <!--Internal Sparkline js -->
    <script src="{{ asset('adminpage/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Moment js -->
    <script src="{{ asset('adminpage/assets/plugins/raphael/raphael.min.js')}}"></script>

    <!-- Internal Piety js -->
    <script src="{{ asset('adminpage/assets/plugins/peity/jquery.peity.min.js')}}"></script>

    <!-- Rating js-->
    <script src="{{ asset('adminpage/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
    <script src="{{ asset('adminpage/assets/plugins/rating/jquery.barrating.js')}}"></script>
    <script src="{{ asset('adminpage/assets/js/eva-icons.min.js')}}"></script>

    <!-- Horizontalmenu js-->
    <script src="{{ asset('adminpage/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{ asset('adminpage/assets/js/sticky.js')}}"></script>
    <!-- custom js -->
    <script src="{{ asset('adminpage/assets/js/custom.js')}}"></script>
    @yield('adminjs')
    <script>
    
           
       
    </script>
</body>

</html>
