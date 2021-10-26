 
<header id="yl-header" class="yl-header-main">
    <div class="clearfix yl-header-top">
        <div class="container">
            <div class="float-left yl-brand-logo">
                <a href="#"><img src="/assets/img/logo/logo1.png" alt=""></a>
            </div>
 
            @foreach (App\Models\Admins\Sysinfo::orderBy('sys_name', 'asc')->get() as $companyinfo)
                <div class="clearfix float-right yl-header-top-cta ul-li">
                    <ul>
                        <li>
                            <div class="header-top-cta-content">
                                <div class="float-left yl-top-cta-icon">
                                    <img src="/assets/img/icon/mail.png" alt="">
                                </div>
                                <div class="float-right yl-top-cta-text yl-headline">
                                    <a href="#">{{ $companyinfo->sys_email1 }}</a>
                                    <h3>Mail us</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="header-top-cta-content">
                                <div class="float-left yl-top-cta-icon">
                                    <img src="/assets/img/icon/call.png" alt="">
                                </div>
                                <div class="float-right yl-top-cta-text yl-headline">
                                    <a href="#">Requesting a Call:</a>
                                    <h3>{{ $companyinfo->sys_phone1 }}</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="header-top-cta-content">
                                <div class="float-left yl-top-cta-icon">
                                    <img src="/assets/img/icon/clock.png" alt="">
                                </div>
                                <div class="float-right yl-top-cta-text yl-headline">

                                    <a href="#">{{ $companyinfo->sys_openday }}:</a>
                                    <h3>{{ $companyinfo->sys_openhour }}</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="header-top-cta-content">
                                <div class="float-left yl-top-cta-icon">
                                    <img src="/assets/img/icon/pin.png" alt="">
                                </div>
                                <div class="float-right yl-top-cta-text yl-headline">
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
                            <div class="text-center m-brand-logo">
                                <a href="#"><img src="/assets/img/logo/logo4.png" alt=""></a>
                            </div>
                            <nav class="clearfix yl-mobile-main-navigation ul-li">
                                <ul id="m-main-nav" class="clearfix navbar-nav text-capitalize">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{ route('fn.aboutus') }}">About</a></li>
                                    <li class="dropdown">
                                        <a href="#">Course</a>
                                        <ul class="clearfix dropdown-menu">


                                            <li><a target="" href="#"> Children Course</a></li>
                                            <li><a target="" href="#"> Normal Course </a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Members</a>
                                        <ul class="clearfix dropdown-menu">
                                            <li class="dropdown">
                                                <a target="" href="#">Personal</a>
                                                <ul class="clearfix dropdown-menu">
                                                    <li><a target="" href="#">Members</a></li>
                                                    <li><a target="" href="#">Teachers</a></li>
                                                    <li><a target="" href="#">Students</a></li>
                                                </ul>
                                            </li>

                                            <li class="dropdown">
                                                <a target="" href="#">Organization</a>
                                                <ul class="clearfix dropdown-menu">
                                                    <li><a target="" href="#">Continent</a></li>
                                                    <li><a target="" href="#">Countries</a></li>
                                                    <li><a target="" href="#">Area</a></li>
                                                    <li><a target="" href="#">Club</a></li>

                                                </ul>
                                            </li>


                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="">Rankings</a>
                                        <ul class="clearfix dropdown-menu">
                                            <li><a target="" href="">Rankings</a></li>


                                            <li class="dropdown">
                                                <a target="" href="">Champion</a>
                                                <ul class="clearfix dropdown-menu">
                                                    <li><a target="" href="#">Male</a></li>
                                                    <li><a target="" href="#">Female</a></li>


                                                </ul>
                                            </li>
                                            <li><a target="" href="">Hall of Fame</a></li>


                                        </ul>
                                    </li>
                                    <li><a href="about.html">News</a></li>


                                    <li class="dropdown">
                                        <a href="#">About us</a>
                                        <ul class="clearfix dropdown-menu">
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
    <div class="clearfix yl-header-menu-wrap">
        <div class="container">
            <div class="float-left yl-main-nav-wrap">
                <nav class="yl-main-navigation ul-li">
                    <ul id="main-nav" class="clearfix navbar-nav text-capitalize">
                        <li><a href="/">Home</a></li>
                        <li class="dropdown">
                            <a href="#">Courses</a>
                            <ul class="clearfix dropdown-menu">

                                @foreach (App\Models\Admins\Course::where('course_status', '=', 'Y')->orderBy('course_index', 'asc')->get()
    as $_item)
                                    <li><a target=""
                                            href="{{ $_item->course_link == '' ? '#' : '/course/' . $_item->course_link }}">{{ $_item->course_name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="/members">Members</a>
                            <ul class="clearfix dropdown-menu">
                                <li class="dropdown">
                                    <a target="" href="">Personal</a>
                                    <ul class="clearfix dropdown-menu">
                                        {{-- <li><a target="" href="#">Members</a></li> --}}
                                        <li><a target="" href="/members/teachers">Teachers</a></li>
                                        <li><a target="" href="/members/students">Students</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a target="" href="">Organization</a>
                                    <ul class="clearfix dropdown-menu">
                                        <li><a target="" href="/continent">Continent</a></li>
                                        <li><a target="" href="/countries">Countries</a></li>
                                        {{-- <li><a target="" href="/area-member">Area</a></li> --}}
                                        <li><a target="" href="/club-member">Club</a></li>

                                    </ul>
                                </li>


                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="/rankings/male">Rankings</a>
                            <ul class="clearfix dropdown-menu">
                                <li class="dropdown">
                                    <a target="" href="/rankings">Rankings</a>
                                    <ul class="clearfix dropdown-menu">
                                        <li><a target="" href="/rankings/male">Male</a></li>
                                        <li><a target="" href="/rankings/female">Female</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a target="" href="/champions/world/male"> WORLD CHAMPIONS</a>
                                    <ul class="clearfix dropdown-menu">
                                        <li><a target="" href="/champions/world/male">Male CHAMPIONS</a></li>
                                        <li><a target="" href="/champions/world/female">Female CHAMPIONS</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a target="" href="/champions/international/male">INTERNATIONAL CHAMPIONS</a>
                                    <ul class="clearfix dropdown-menu">
                                        <li><a target="" href="/champions/international/male">Male CHAMPIONS</a></li>
                                        <li><a target="" href="/champions/international/female">Female CHAMPIONS</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a target="" href="/champions/hall-of-fame">Hall of Fame</a></li>
                            </ul>
                        </li>
                        <li><a href="/news">News</a></li>

                        <li class="dropdown">
                            <a href="#">About us</a>
                            <ul class="clearfix dropdown-menu">
                                @foreach (App\Models\Admins\Aboutus::orderBy('aboutus_index', 'asc')->get() as $pageabout)
                                    <li><a target=""
                                            href="/aboutus/{{ $pageabout->aboutus_url }}">{{ $pageabout->aboutus_name }}</a>
                                    </li>
                                @endforeach
                                <li><a target="" href="/contact">Contact</a></li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="float-right yi-header-social ul-li">
                <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="float-right yl-header-cart-login">
                @if (App\Models\Admins\Members::where('uid_login','=',Cookie::get('loginuid'))->first())
                    
                <div class="yl-top-cart-login" id="cart">
                    <button><i class="fas fa-shopping-cart"></i>
                </div>
                <div class="yl-top-cart-login" id="profile">
                    <button data-toggle="modal" data-target="#exampleModal">
                        <img src="https://lpn.satangapp.in/assets/img/course/cm1.jpg">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile" aria-labelledby="crm-navbar-user">
                        <div class="navbar-header">
                            <a class="navbar-avatar-inside" href="https://themexriver.helpviser.com/customer-profile"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://lpn.satangapp.in/assets/img/course/cm1.jpg">
                            </a>
                            <span class="avatar"><span
                                    style="background:url('https://lpn.satangapp.in/assets/img/course/cm1.jpg') no-repeat center center;"></span></span>

                            <span class="navbar-username-mail">
                                <a href="https://themexriver.helpviser.com/customer-profile"
                                    id="navbar-username">akachai pijan</a>
                                <a href="https://themexriver.helpviser.com/customer-profile"
                                    id="navbar-mail">akachai1526@hotmail.com</a>
                            </span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item "
                             href="https://themexriver.helpviser.com/customer-profile">
                            Update Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item "
                        href="https://themexriver.helpviser.com/customer-profile">
                       Update Students
                   </a>
                       <div class="dropdown-divider"></div>
                      
                        <a class="dropdown-item "
                             href="https://themexriver.helpviser.com/customer-profile">
                            Update Youtube Videos
                        </a>
                            <div class="dropdown-divider"></div>
                        <a  onclick="location.href='/members/logout';"  class="dropdown-item" href="#">Logout</a>
                         
                    </div>

                   
                </div>
                @else
                    <div class="yl-top-cart-login" id="login">
                        <button data-toggle="modal" data-target="#frmModallogin"><i class="fas fa-user"></i> Login</button>
                    </div>
                @endif
                
               

              
              
               
            </div>
        </div>
    </div>
</header>
 
 

 <!-- Login-Sign Form -->
 <div class="modal yl-login-modal fade" id="frmModallogin" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="l-modal-header-login position-relative"
          style=" background-color:'';" data-background="/assets/img/ct-bg.jpg">
             <div class="yl-login-head text-center pera-content">
                <a href="#">
                    <img src="/assets/img/logo/logo1.png" alt="" style="height: 90px">
                </a>
                <p style="color: aliceblue; background-color : #ff5520">{{ App\Models\Admins\Sysinfo::where('sys_status', 'Y')->first()->sys_slogan }}</p>
             </div>
          </div>
          <div class="modal-body">
             <div class="yl-modal-signup-login-tab">
                <div class="yl-faq-tab-btn ul-li">
                   <ul id="tabs" class="nav text-center nav-tabs faq-tab-btn-area">
                      <li class="nav-item"><a href="#" data-target="#actlogin" data-toggle="tab" class="nav-link text-capitalize active">Login</a></li>
                      <li class="nav-item"><a href="#" data-target="#actsignUp" data-toggle="tab" class="nav-link text-capitalize">Sign Up</a></li>
                   </ul>
                </div>
                <div id="tabsContent" class="tab-content">
                   <div id="actlogin" class="tab-pane fade active show">
                      <div class="yl-login-content pera-content text-center">
                         <form id="frmactlogin" name="frmactlogin"  action="{{route('fn.members.login')}}" method="post">
                          @csrf
                            <input type="text" id="txtemail" name="txtemail" placeholder="Email address" required>
                            <input type="text" id="txtpassword" name="txtpassword" placeholder="Password" required>
                            <div class="yl-login-label clearfix">
                              
                               <a href="/members/forget">Forget Password?</a>
                            </div>
                            <button type="button" class="btn-close" style="width: 45%;background-color: #777576;" data-dismiss="modal">Close</button>
                            <button type="submit" style="width: 45%;" >Submit</button>
                         </form>
                         
                      </div>
                   </div>
                   <div id="actsignUp" class="tab-pane fade">
                      <div class="yl-sign-up-content pera-content text-center">
                         <form id="frmactsignUp" name="frmactsignUp" action="/members/register" method="post">
                            @csrf
                            <input type="text" id="txtFirstname" name="txtFirstname"  placeholder="First Name" required>
                            <input type="text" id="txtLastname" name="txtLastname"placeholder="Last Name">
                            <input type="email"  id="txtemail" name="txtemail" style="width: 94%;" placeholder="Email address" required>
                            <input type="text" id="txtpassword" name="txtpassword"placeholder="Password" required>
                            <input type="text" id="txtConfirmPassword" name="txtConfirmPassword" placeholder="Confirm password" required>
                            
                            <div class="form-group">
                                 
                                <select class="form-control" id="txtgender" name="txtgender" required>
                                    <option value="">Select Gender</option>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                    
                                </select>
                            </div>
                            
                            <div class="form-group">
                                 
                                <select class="form-control" id="txtcountry" name="txtcountry" required>
                                    <option value="">Select Country</option>
                                    @foreach (App\Models\Admins\Country::orderBy('country_name', 'asc')->get() as $Country)
                                    <option value="{{ $Country->country_code }}">{{ $Country->country_name}}</option>
                                    @endforeach
                                  
                                    
                                </select>
                              </div>   
                                 
                                 
                                    
                            {{-- <div class="yl-login-label clearfix">
                                <span>
                                <input type="checkbox">By clicking signup you are agree to our terms of service</span>
                            </div>   --}}
                            <button type="button" class="btn-close" style="width: 45%;background-color: #777576;" data-dismiss="modal">Close</button>
                            <button type="submit" calss="btn-signup" style="width: 45%;">Submit</button>
                         </form>
                         
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>  

 

