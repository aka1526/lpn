<footer id="yl-footer" class="yl-footer-section" data-background="/assets/img/f-bg.jpg">
    <div class="container">
       <div class="yl-footer-content-wrap">
          <div class="row">
            @foreach(App\Models\Admins\Sysinfo::orderBy('sys_name','asc')->get() as $companyinfo)
             <div class="col-lg-3 col-md-6">
                <div class="yl-footer-widget">
                   <div class="yl-footer-logo-widget yl-headline pera-content">
                      <div class="yl-footer-logo">
                         <a href="#"><img src="/assets/img/logo2.png" alt=""></a>
                      </div>
                      <p> {{ $companyinfo->sys_slogan  }}</p>
                      <a class="footer-logo-btn text-center text-uppercase" href="{{ route('fn.aboutus')}}">About us</a>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-6">
                <div class="yl-footer-widget">
                   <div class="yl-footer-newslatter-widget pera-content">
                   
                      <h3 class="widget-title">Newsletter</h3>
                      <p>Subscribe our newsletter to get our
                         latest update & news
                         
                         @if(session()->has('message'))
                         {{-- <div class="alert alert-success">
                             {{ session()->get('message') }}
                         </div> --}}
                         <script>
                            Swal.fire({
                                 position: 'center',
                                 icon: 'success',
                                 title: '{{ session()->get('message') }}',
                                 showConfirmButton: false,
                                 timer: 3000
                                 })
                       </script>
                        @endif
                      </p>
                     
                      <form id="subscribe" name="subscribe" method="post" action="{{ route('fn.subscribe')}}">
                        @csrf
                        <input type="email" id="email" name="email" placeholder="Your mail address">
                         <button type="submit"><i class="far fa-paper-plane"></i></button>
                      </form>
                      {{-- <div class="yl-footer-social ul-li">
                         <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                         </ul>
                      </div> --}}
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-6">
                <div class="yl-footer-widget">
                   <div class="yl-footer-info-widget ul-li">
                      <h3 class="widget-title">Official info:</h3>
                     
                      <ul>
                         <li>
                            <i class="fas fa-map-marker-alt"></i> 
                            <a href="#">{{ $companyinfo->sys_address .','.$companyinfo->sys_country }}</a>
                         </li>
                         <li>
                            <i class="fas fa-phone"></i><a href="#">{{ $companyinfo->sys_phone1  }}</a>
                         </li>
                      </ul>
                      <div class="office-open-hour">
                         <span>Open Hours: </span>
                         <p> {{ $companyinfo->sys_openday  }}: {{ $companyinfo->sys_openhour  }} 
                          
                         </p>
                      </div>
                     
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-6">
                <div class="yl-footer-widget">
                   <div class="yl-footer-instagram-widget">
                      <h3 class="widget-title">New Member Welcome</h3>
                      <div class="insta-feed ul-li clearfix">
                         <ul>
                            <li><a href="!#"><img src="/assets/img/instagram/ins1.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href="!#"><img src="/assets/img/instagram/ins2.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href="!#"><img src="/assets/img/instagram/ins3.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href="!#"><img src="/assets/img/instagram/ins4.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href="!#"><img src="/assets/img/instagram/ins5.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href="!#"><img src="/assets/img/instagram/ins6.jpg" alt=""><i class="fab fa-instagram"></i></a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             @endforeach
          </div>
       </div>
       <div class="yl-footer-copyright text-center"><span>© 2021 Lumpinee Academy Muaythai. All rights reserved.</span></div>
    </div>
 </footer>