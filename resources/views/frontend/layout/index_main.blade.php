<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.header')
    @yield('css')
</head>

<body class="yl-home">
    <!-- preloader - start -->
    <div id="yl-preloader"></div>
    <div class="up">
        <a href="#" class="text-center scrollup"><i class="fas fa-chevron-up"></i></a>
    </div>

    <!-- Start of header section
      ============================================= -->
    @include('frontend.includes.menu_nav')

    <!-- End of header section
      ============================================= -->
    @yield('content')


    <!-- Start of Footer  section
      ============================================= -->
    @include('frontend.includes.footer')
    <!-- End of Footer section
         ============================================= -->


    <!-- JS library -->


    <script src="/assets/js/appear.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/jquery.fancybox.js"></script>
    <script src="/assets/js/owl.js"></script>
    <script src="/assets/js/isotope.pkgd.min.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/masonry.pkgd.min.js"></script>
    <script src="/assets/js/odometer.js"></script>
    
 
    <script src="/assets/js/parallax-scroll.js"></script>
    <script src="/assets/js/jquery.nice-select.min.js"></script>
    <script src="/assets/js/typer.js"></script>

    
    <script src="/assets/js/custom.js"></script>

    @yield('js')
</body>

</html>
