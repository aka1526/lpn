    <!-- main-header opened -->
    <div class="main-header nav nav-item hor-header">
        <div class="container">
            <div class="main-header-left ">
                <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
                <a class="header-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-dark">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo-1">
                    <img src="{{ asset('assets/img/logo/logo1.png') }}" class="desktop-logo-dark">

                </a>
                <div class="ml-4 main-header-center">
                    <div>
                        <h2 class="ml-4 main-content-title tx-24 mg-b-1 mg-b-lg-1">
                            Lumpinee Academy Muaythai
                        </h2>
                    </div>
                </div>
            </div><!-- search -->
            <div class="main-header-right">

                <div class="ml-auto nav nav-item navbar-nav-right">


                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user d-flex" href=""><img alt=""
                                src="{{ asset('adminpage/assets/img/faces/6.jpg') }}"></a>
                        <div class="dropdown-menu">
                            <div class="p-3 main-header-profile bg-primary">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user"><img alt=""
                                            src="{{ asset('adminpage/assets/img/faces/6.jpg') }}"
                                            class="">
                                    </div>
                                    <div class="
                                            my-auto ml-3">
                                        <h6>Petey Cruiser</h6><span>Premium Member</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                            <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                            <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                            <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
                            <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="bx bx-log-out"></i>
                                Sign
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
        <div class="clearfix horizontal-main hor-menu side-header">
            <div class="container clearfix horizontal-mainwrapper">
                <!--Nav-->
                <nav class="clearfix horizontalMenu">
                    <ul class="horizontalMenu-list">
                        <li aria-haspopup="true">
                            <a href="/" class="">
                                <svg xmlns="
                                http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" fill="none">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                                </svg>Home
                            </a>
                        </li>

                        <li aria-haspopup="true"><a href="/pageadmin"
                                class="">
                                <svg xmlns=" http://www.w3.org/2000/svg"
                                class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                <path
                                    d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>Dashboard
                            </a>
                        </li>
                        <li aria-haspopup="true"><a href="/pageadmin/members/prosonal" class="sub-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                    <path
                                        d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>
                                Members <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">


                                <li aria-haspopup="true" class="sub-menu-sub"><a href="/pageadmin/members/prosonal">
                                        Prosonal Member</a>
                                    <ul class="sub-menu">
                                        <li aria-haspopup="true"><a href="/pageadmin/members/prosonal/register"
                                                class="slide-item">New Membership</a></li>
                                        <li aria-haspopup="true"><a href="/pageadmin/members/prosonal/renew"
                                                class="slide-item">Renew Membership</a></li>
                                        <li aria-haspopup="true"><a href="/pageadmin/memberkhans"
                                                class="slide-item">Up Khan Muay</a></li>
                                    </ul>
                                </li>


                                <li aria-haspopup="true"><a href="/pageadmin/members/organizations"
                                        class="slide-item">Organization Member</a>
                                    
                                    </li>
                                <li aria-haspopup="true"><a href="/pageadmin/rankings" class="slide-item">WORLD
                                        RANKINGS</a></li>
                                <li aria-haspopup="true"><a href="/pageadmin/halloffame" class="slide-item">HALL OF
                                        FAME</a></li>


                            </ul>
                        </li>

                        <li aria-haspopup="true"><a href="#" class="sub-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                    <path
                                        d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>
                                Courses <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ route('course.slide') }}" class="slide-item">
                                        Courses Text Slide</a></li>
                                <li aria-haspopup="true"><a href="{{ route('course.home') }}" class="slide-item">
                                        Courses Title</a></li>
                                <li aria-haspopup="true"><a href="{{ route('course.index') }}"
                                        class="slide-item">
                                        Courses List</a></li>



                            </ul>
                        </li>
                        <li aria-haspopup="true"><a href="#" class="sub-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                    <path
                                        d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>
                                News <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ route('news.home') }}" class="slide-item">
                                        News Home</a></li>
                                <li aria-haspopup="true"><a href="{{ route('news.index') }}" class="slide-item">
                                        News item</a></li>


                            </ul>
                        </li>

                        <li aria-haspopup="true"><a href="{{ route('slidepage.index') }}"
                                class="">
                                <svg xmlns=" http://www.w3.org/2000/svg"
                                class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                <path
                                    d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>Slide Page
                            </a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ route('aboutus.index') }}"
                                class="">
                            <svg xmlns=" http://www.w3.org/2000/svg"
                                class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                <path
                                    d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                                </svg>About us
                            </a>
                        </li>

                        {{-- <li aria-haspopup="true"><a href="widgets.html" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"
                                        opacity=".3" />
                                    <path
                                        d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                </svg> Widgets </a></li> --}}

                        <li aria-haspopup="true"><a href="#" class="sub-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"
                                        opacity=".3" />
                                    <path
                                        d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                                </svg>
                                Admin Sytem <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true">
                                    <a href="{{ route('sysinfo.index') }}" class="slide-item">Company Info</a>
                                </li>
                                <li aria-haspopup="true">
                                    <a href="{{ route('admin.user') }}" class="slide-item">User</a>
                                </li>
                                <li aria-haspopup="true">
                                    <a href="{{ route('khans.index') }}" class="slide-item">Khan Muay</a>
                                </li>
                                <li aria-haspopup="true">
                                    <a href="{{ route('country.index') }}" class="slide-item">Country </a>
                                </li>
                                <li aria-haspopup="true">
                                    <a href="{{ route('menu.index') }}" class="slide-item">Menu List</a>
                                </li>


                            </ul>
                        </li>
                    </ul>
                </nav>
                <!--Nav-->
            </div>
        </div>
    </div>
    <!--Horizontal-main -->
