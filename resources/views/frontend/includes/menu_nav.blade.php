<header id="yl-header" class="yl-header-main">
    <div class="yl-header-top clearfix">
        <div class="container">
            <div class="yl-brand-logo float-left">
                <a href="#"><img src="/assets/img/logo/logo1.png" alt=""></a>
            </div>
 
            @foreach(App\Models\Admins\Sysinfo::orderBy('sys_name','asc')->get() as $companyinfo)
            <div class="yl-header-top-cta float-right clearfix ul-li">
                <ul>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="/assets/img/icon/mail.png" alt="">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="#">{{ $companyinfo->sys_email1 }}</a>
                                <h3>Mail us</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="/assets/img/icon/call.png" alt="">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="#">Requesting a Call:</a>
                                <h3>{{ $companyinfo->sys_phone1 }}</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="/assets/img/icon/clock.png" alt="">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                
                                <a href="#">{{ $companyinfo->sys_openday }}:</a>
                                <h3>{{ $companyinfo->sys_openhour }}</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="/assets/img/icon/pin.png" alt="">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="#">{{ $companyinfo->sys_address }}</a>
                                <h3>{{ $companyinfo->sys_country }}</h3>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
 

            @endforeach
           
            <div class="yl-mobile-menu-wrap">
                <div class="yl-mobile_menu position-relative">
                    <div class="yl-mobile_menu_button yl-open_mobile_menu">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="yl-mobile_menu_wrap">
                        <div class="mobile_menu_overlay yl-open_mobile_menu"></div>
                        <div class="yl-mobile_menu_content">
                            <div class="yl-mobile_menu_close yl-open_mobile_menu">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="m-brand-logo text-center">
                                <a href="#"><img src="/assets/img/logo/logo4.png" alt=""></a>
                            </div>
                            <nav class="yl-mobile-main-navigation  clearfix ul-li">
                                <ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ route('fn.aboutus')}}">About</a></li>
                                    <li class="dropdown">
                                        <a href="#">Course</a>
                                        <ul class="dropdown-menu clearfix">
                                          
                                           
                                            <li><a target="" href="#"> Children Course</a></li>
                                            <li><a target="" href="#"> Normal Course </a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Members</a>
                                        <ul class="dropdown-menu clearfix">
                                            <li class="dropdown">
                                                <a target="" href="#">Personal</a>
                                                <ul class="dropdown-menu clearfix">
                                                    <li><a target="" href="#">Members</a></li>
                                                    <li><a target="" href="#">Teachers</a></li>
                                                    <li><a target="" href="#">Students</a></li>
                                                </ul>
                                            </li>
            
                                            <li class="dropdown">
                                                <a target="" href="#">Organization</a>
                                                <ul class="dropdown-menu clearfix">
                                                    <li><a target="" href="#">Continent</a></li>
                                                    <li><a target="" href="#">Countries</a></li>
                                                    <li><a target="" href="#">Area</a></li>
                                                    <li><a target="" href="#">Club</a></li>
                                                     
                                                </ul>
                                            </li>
            
                                             
                                        </ul>
                                    </li>
                                    
                                    <li class="dropdown">
                                        <a href="#">Rankings</a>
                                        <ul class="dropdown-menu clearfix">
                                            <li><a target="" href="#">Rankings</a></li>
                                         
            
                                            <li class="dropdown">
                                                <a target="" href="#">Champion</a>
                                                <ul class="dropdown-menu clearfix">
                                                    <li><a target="" href="#">Male</a></li>
                                                    <li><a target="" href="#">Female</a></li>
                                              
                                                     
                                                </ul>
                                            </li>
                                            <li><a target="" href="#">Hall of Fame</a></li>
                                            
                                           
                                        </ul>
                                    </li>
                                    <li><a href="about.html">News</a></li>
                        
                                    
                                    <li class="dropdown">
                                        <a href="#">About us</a>
                                        <ul class="dropdown-menu clearfix">
                                            <li><a target="" href="#">History</a></li>
                                            <li><a target="" href="#">Committees</a></li>
                                            <li><a target="" href="#">Constitution</a></li>
                                            <li><a target="" href="#">History</a></li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Mobile-Menu -->
            </div>
        </div>
    </div>
    <div class="yl-header-menu-wrap clearfix">
        <div class="container">
            <div class="yl-main-nav-wrap  float-left">
                <nav class="yl-main-navigation ul-li">
                    <ul id="main-nav" class="navbar-nav text-capitalize clearfix">
                        <li><a href="/">Home</a></li>
                        <li class="dropdown">
                            <a href="#">Courses</a>
                            <ul class="dropdown-menu clearfix">
                               
                                @foreach(App\Models\Admins\Course::where('course_status','=','Y')->orderBy('course_index','asc')->get() as $_item)
                                    <li><a target="" href="{{ $_item->course_link =='' ? '#' : '/course/'.$_item->course_link }}">{{ $_item->course_name}}</a></li>
                                @endforeach
 
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#">Members</a>
                            <ul class="dropdown-menu clearfix">
                                <li class="dropdown">
                                    <a target="" href="#">Personal</a>
                                    <ul class="dropdown-menu clearfix">
                                        <li><a target="" href="#">Members</a></li>
                                        <li><a target="" href="#">Teachers</a></li>
                                        <li><a target="" href="#">Students</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a target="" href="#">Organization</a>
                                    <ul class="dropdown-menu clearfix">
                                        <li><a target="" href="#">Continent</a></li>
                                        <li><a target="" href="#">Countries</a></li>
                                        <li><a target="" href="#">Area</a></li>
                                        <li><a target="" href="#">Club</a></li>
                                         
                                    </ul>
                                </li>

                                 
                            </ul>
                        </li>


                     
                       
                      
                        <li class="dropdown">
                            <a href="#">Rankings</a>
                            <ul class="dropdown-menu clearfix">
                                <li><a target="" href="#">Rankings</a></li>
                             

                                <li class="dropdown">
                                    <a target="" href="#">Champion</a>
                                    <ul class="dropdown-menu clearfix">
                                        <li><a target="" href="#">Male</a></li>
                                        <li><a target="" href="#">Female</a></li>
                                  
                                         
                                    </ul>
                                </li>
                                <li><a target="" href="#">Hall of Fame</a></li>
                                
                               
                            </ul>
                        </li>
                        <li><a href="about.html">News</a></li>
                        
                       
                        
                        <li class="dropdown">
                            <a href="#">About us</a>
                            <ul class="dropdown-menu clearfix">
                                <li><a target="" href="{{ route('fn.aboutus')}}">About</a></li>
                                <li><a target="" href="#">History</a></li>
                                <li><a target="" href="#">Committees</a></li>
                                <li><a target="" href="#">Constitution</a></li>
                                <li><a target="" href="{{ route('fn.contact')}}">contact</a></li>
                                
                                
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="yi-header-social float-right ul-li">
                <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="yl-header-cart-login float-right">
                <div class="yl-top-cart-login">
                    <button><i class="fas fa-shopping-cart"></i></button>
                </div>
                <div class="yl-top-cart-login">
                    <button data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
