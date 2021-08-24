    <!-- main-header opened -->
    <div class="main-header nav nav-item hor-header">
        <div class="container">
            <div class="main-header-left ">
                <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
                <a class="header-brand" href="{{ url('/')}}">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-dark">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo-1">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo-dark">

                </a>
                <div class="main-header-center  ml-4">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 ml-4">Lumpinee Academy Muaythai</h2>
                    </div>
                </div>
            </div><!-- search -->
            <div class="main-header-right">

                <div class="nav nav-item  navbar-nav-right ml-auto">
                    

                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user d-flex" href=""><img alt=""
                                src="{{ asset('adminpage/assets/img/faces/6.jpg')}}"></a>
                        <div class="dropdown-menu">
                            <div class="main-header-profile bg-primary p-3">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user"><img alt="" src="{{ asset('adminpage/assets/img/faces/6.jpg')}}"
                                            class="">
                                    </div>
                                    <div class="ml-3 my-auto">
                                        <h6>Petey Cruiser</h6><span>Premium Member</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                            <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                            <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                            <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
                            <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
                            <a class="dropdown-item" href="page-signin.html"><i class="bx bx-log-out"></i> Sign
                                Out</a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- /main-header -->

    <!--Horizontal-main -->
    <div class="sticky">
        <div class="horizontal-main hor-menu clearfix side-header">
            <div class="horizontal-mainwrapper container clearfix">
                <!--Nav-->
                <nav class="horizontalMenu clearfix">
                    <ul class="horizontalMenu-list">
                        <li aria-haspopup="true">
                            <a href="/" class="">
                                <svg 
                                xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"   viewBox="0 0 24 24"   
                                fill="none"><path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/>
                                <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/>
                            </svg>Home</a>
                        </li>

                        <li aria-haspopup="true"><a href="{{ route('admin_dashboard')}}" class="">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                    <path
                                        d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>Dashboard</a></li>
                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"
                                        opacity=".3" />
                                    <path
                                        d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                                </svg> Charts<i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="chart-morris.html" class="slide-item">Morris
                                        Charts</a></li>
                                <li aria-haspopup="true"><a href="chart-flot.html" class="slide-item">Flot
                                        Charts</a>
                                </li>
                                <li aria-haspopup="true"><a href="chart-chartjs.html" class="slide-item">ChartJS</a>
                                </li>
                                <li aria-haspopup="true"><a href="chart-echart.html" class="slide-item">Echart</a>
                                </li>
                                <li aria-haspopup="true"><a href="chart-sparkline.html"
                                        class="slide-item">Sparkline</a>
                                </li>
                                <li aria-haspopup="true"><a href="chart-peity.html" class="slide-item">
                                        Chart-peity</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"
                                        opacity=".3" />
                                    <path
                                        d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                </svg> E-Commerce<i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="products.html" class="slide-item"> Products</a>
                                </li>
                                <li aria-haspopup="true"><a href="product-details.html"
                                        class="slide-item">Product-Details</a></li>
                                <li aria-haspopup="true"><a href="product-cart.html" class="slide-item">Shopping
                                        Cart</a></li>
                            </ul>
                        </li>
                        
                      
                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M10.9 19.91c.36.05.72.09 1.1.09 2.18 0 4.16-.88 5.61-2.3L14.89 13l-3.99 6.91zm-1.04-.21l2.71-4.7H4.59c.93 2.28 2.87 4.03 5.27 4.7zM8.54 12L5.7 7.09C4.64 8.45 4 10.15 4 12c0 .69.1 1.36.26 2h5.43l-1.15-2zm9.76 4.91C19.36 15.55 20 13.85 20 12c0-.69-.1-1.36-.26-2h-5.43l3.99 6.91zM13.73 9h5.68c-.93-2.28-2.88-4.04-5.28-4.7L11.42 9h2.31zm-3.46 0l2.83-4.92C12.74 4.03 12.37 4 12 4c-2.18 0-4.16.88-5.6 2.3L9.12 11l1.15-2z"
                                        opacity=".3" />
                                    <path
                                        d="M12 22c5.52 0 10-4.48 10-10 0-4.75-3.31-8.72-7.75-9.74l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10zm0-2c-.38 0-.74-.04-1.1-.09L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20zm8-8c0 1.85-.64 3.55-1.7 4.91l-4-6.91h5.43c.17.64.27 1.31.27 2zm-.59-3h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM12 4c.37 0 .74.03 1.1.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4zm-8 8c0-1.85.64-3.55 1.7-4.91L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12zm6.27 3h2.3l-2.71 4.7c-2.4-.67-4.35-2.42-5.28-4.7h5.69z" />
                                </svg> Utilities <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="background.html" class="slide-item">Background</a>
                                </li>
                                <li aria-haspopup="true"><a href="border.html" class="slide-item">Border</a></li>
                                <li aria-haspopup="true"><a href="display.html" class="slide-item">Display</a></li>
                                <li aria-haspopup="true"><a href="flex.html" class="slide-item">Flex</a></li>
                                <li aria-haspopup="true"><a href="height.html" class="slide-item">Height</a></li>
                                <li aria-haspopup="true"><a href="margin.html" class="slide-item">Margin</a></li>
                                <li aria-haspopup="true"><a href="padding.html" class="slide-item">Padding</a></li>
                                <li aria-haspopup="true"><a href="position.html" class="slide-item">Position</a>
                                </li>
                                <li aria-haspopup="true"><a href="width.html" class="slide-item">Width</a></li>
                                <li aria-haspopup="true"><a href="extras.html" class="slide-item">Extras</a></li>
                            </ul>
                        </li>
                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    class="side-menu__icon" viewBox="0 0 24 24">
                                    <g>
                                        <rect fill="none" />
                                    </g>
                                    <g>
                                        <g />
                                        <g>
                                            <path
                                                d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z" />
                                            <path
                                                d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z"
                                                opacity=".3" />
                                        </g>
                                        <g>
                                            <path
                                                d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z" />
                                            <path
                                                d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z" />
                                            <path
                                                d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z" />
                                        </g>
                                    </g>
                                </svg>Pages <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="profile.html" class="slide-item">Profile</a></li>
                                <li aria-haspopup="true"><a href="editprofile.html"
                                        class="slide-item">Edit-profile</a>
                                </li>
                                <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Mail</a>
                                    <ul class="sub-menu">
                                        <li aria-haspopup="true"><a href="mail.html"
                                                class="slide-item">Mail-inbox</a>
                                        </li>
                                        <li aria-haspopup="true"><a href="mail-compose.html"
                                                class="slide-item">Mail-compose</a></li>
                                        <li aria-haspopup="true"><a href="mail-read.html"
                                                class="slide-item">Mail-read</a></li>
                                        <li aria-haspopup="true"><a href="mail-settings.html"
                                                class="slide-item">Mail-settings</a></li>
                                        <li aria-haspopup="true"><a href="chat.html" class="slide-item">Chat</a>
                                        </li>

                                    </ul>
                                </li>
                                <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Forms</a>
                                    <ul class="sub-menu">
                                        <li aria-haspopup="true"><a href="form-elements.html"
                                                class="slide-item">Form
                                                Elements</a></li>
                                        <li aria-haspopup="true"><a href="form-advanced.html"
                                                class="slide-item">Advanced Forms</a></li>
                                        <li aria-haspopup="true"><a href="form-layouts.html" class="slide-item">Form
                                                Layouts</a></li>
                                        <li aria-haspopup="true"><a href="form-validation.html"
                                                class="slide-item">Form
                                                Validation</a></li>
                                        <li aria-haspopup="true"><a href="form-wizards.html" class="slide-item">Form
                                                Wizards</a></li>
                                        <li aria-haspopup="true"><a href="form-editor.html"
                                                class="slide-item">WYSIWYG
                                                Editor</a></li>
                                    </ul>
                                </li>
                                <li aria-haspopup="true"><a href="invoice.html" class="slide-item">Invoice</a></li>
                                <li aria-haspopup="true"><a href="todotask.html" class="slide-item">Todotask</a>
                                </li>
                                <li aria-haspopup="true"><a href="pricing.html" class="slide-item">Pricing</a></li>
                                <li aria-haspopup="true"><a href="gallery.html" class="slide-item">Gallery</a></li>
                                <li aria-haspopup="true"><a href="faq.html" class="slide-item">Faqs</a></li>
                                <li aria-haspopup="true"><a href="empty.html" class="slide-item">Empty Page</a></li>
                            </ul>
                        </li>
                        <li aria-haspopup="true"><a href="widgets.html" class="">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"
                                        opacity=".3" />
                                    <path
                                        d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                </svg> Widgets </a></li>
                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"
                                        opacity=".3" />
                                    <path
                                        d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                                </svg> Adminpage <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ route('admin.user')}}" class="slide-item">User List</a></li>
                                <li aria-haspopup="true"><a href="signup.html" class="slide-item">Sign Up</a></li>
                                <li aria-haspopup="true"><a href="forgot.html" class="slide-item">Forgot
                                        Password</a>
                                </li>
                                <li aria-haspopup="true"><a href="reset.html" class="slide-item">Reset Password</a>
                                </li>
                                <li aria-haspopup="true"><a href="lockscreen.html" class="slide-item">Lock
                                        screen</a>
                                </li>
                                <li aria-haspopup="true"><a href="underconstruction.html"
                                        class="slide-item">UnderConstruction</a></li>
                                <li aria-haspopup="true"><a href="404.html" class="slide-item">404 Error</a></li>
                                <li aria-haspopup="true"><a href="500.html" class="slide-item">500 Error</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!--Nav-->
            </div>
        </div>
    </div>
    <!--Horizontal-main -->