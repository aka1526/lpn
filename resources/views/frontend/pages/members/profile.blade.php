@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
    <link href="/adminpage/assets/plugins/gallery/gallery.css" rel="stylesheet">


@endsection
@section('content')
    <section id="course-page-course" class="course-page-course-section">
        <div class="container">
            <!-- row -->
            <div class="row row-sm">
                <div class="col-lg-4">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="pl-0">
                                <div class="main-profile-overview">
                                    <div class="main-img-user profile-user">
                                        <img alt="" src="{{ '/images/members/' . $member->img_profile }}">
                                        <span><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="main-profile-name-text mt-2">Name : <span
                                                    class="text-primary m-b-5 tx-14">{{ $member->full_name }}</span></h6>

                                            <h6 class="main-profile-name-text mt-2">Khan : <span
                                                    class="text-primary m-b-5 tx-14">{{ $member->khan_name }}</span></h6>
                                            <h6 class="main-profile-name-text mt-2">Level : <span
                                                    class="text-primary m-b-5 tx-14">{{ $member->user_type }}</span></h6>
                                            <h6 class="main-profile-name-text mt-2">Country : <span
                                                    class="text-primary m-b-5 tx-14">{{ $member->country_name }}</span>
                                            </h6>
                                            <h6 class="main-profile-name-text mt-2">Member at : <span
                                                    class="text-primary m-b-5 tx-14">{{ $member->date_register }}</span>
                                            </h6>
                                            <h6 class="main-profile-name-text mt-2">Card ID:<span
                                                    class="text-primary m-b-5 tx-14"> {{ $member->member_no }}</span>
                                            </h6>


                                        </div>
                                    </div>


                                    <div class="main-profile-bio">

                                        <a href=""> <img alt="" src="{{ '/images/members/card/' . $member->img_idcard }}">
                                        </a>
                                    </div><!-- main-profile-bio -->
                                    <hr class="mg-y-30">
                                    <h6>Certificate No. :</h6>
                                    <div class="main-profile-bio">
                                        <h5 class="text-primary m-b-5 tx-14">{{ $member->certificate_no }}</h5>
                                        {{-- <a href=""> <img alt="" src="{{ '/images/members/' . $member->img_profile }}"> --}}
                                        </a>
                                    </div><!-- main-profile-bio -->

                                </div><!-- main-profile-overview -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="tx-15 text-uppercase mb-3">ABOUT ME</h4>
                        </div>    
                        <div class="card-body">

                         
                            <p class="m-b-5">Hi I'm Petey Cruiser,has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type. Donec pede
                                justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut,
                                imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                                Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                                enim.</p>
                            <div class="m-t-30">
                                <h4 class="tx-15 text-uppercase mt-3">Experience</h4>
                                <div class=" p-t-10">
                                    <h5 class="text-primary m-b-5 tx-14">Lead designer / Developer</h5>
                                    <p class="">websitename.com</p>
                                    <p><b>2010-2015</b></p>
                                    <p class="text-muted tx-13 m-b-0">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown printer took a
                                        galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                                <hr>
                                <div class="">
                                    <h5 class="text-primary m-b-5 tx-14">Senior Graphic Designer</h5>
                                    <p class="">coderthemes.com</p>
                                    <p><b>2007-2009</b></p>
                                    <p class="text-muted tx-13 mb-0">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown printer took a
                                        galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
            {{-- <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="tx-15 text-uppercase mb-3 text-center">Gallary Image</h4>
                            <p class="m-b-5">Hi I'm Petey Cruiser,has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type. Donec pede
                                justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut,
                                imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                                Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,
                                enim.</p>
                            <div class="m-t-30">
                                <h4 class="tx-15 text-uppercase mt-3">Experience</h4>
                                <div class=" p-t-10">
                                    <h5 class="text-primary m-b-5 tx-14">Lead designer / Developer</h5>
                                    <p class="">websitename.com</p>
                                    <p><b>2010-2015</b></p>
                                    <p class="text-muted tx-13 m-b-0">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry's
                                        standard dummy text ever since the 1500s, when an unknown printer took a
                                        galley of type and scrambled it to make a type specimen book.</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div> --}}
            <div class="row mt-3">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="tx-15 text-uppercase mb-3 text-center">YouTube videos</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <iframe src="{{ url('https://www.youtube.com/embed/5Peo-ivmupE') }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                     
                                </div>
                                <p class="">websitename.com</p>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <iframe src="{{ url('https://www.youtube.com/embed/5Peo-ivmupE') }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                     
                                </div>
                                <p class="">websitename.com</p>
                            </div>
                             
                            <div class="col-md-4">
                                <div class="card">
                                    <iframe src="{{ url('https://www.youtube.com/embed/5Peo-ivmupE') }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                     
                                </div>
                                <p class="">websitename.com</p>
                            </div>
                             
                            <div class="col-md-4">
                                <div class="card">
                                    <iframe src="{{ url('https://www.youtube.com/embed/5Peo-ivmupE') }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                     
                                </div>
                                <p class="">websitename.com</p>
                            </div>
                             
                            <div class="col-md-4">
                                <div class="card">
                                    <iframe src="{{ url('https://www.youtube.com/embed/5Peo-ivmupE') }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                     
                                </div>
                                <p class="">websitename.com</p>
                            </div>
                             
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                         
                        <div class="card-body">
                            <div class="table-responsive">
                                <h2>Students List</h2>
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Examination</th>
                                            <th>Khan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Joan Powell</td>
                                            <td>Associate Developer</td>
                                            <td>$450,870</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Gavin Gibson</td>
                                            <td>Account manager</td>
                                            <td>$230,540</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Julian Kerr</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>$55,300</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Cedric Kelly</td>
                                            <td>Accountant</td>
                                            <td>$234,100</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Samantha May</td>
                                            <td>Junior Technical Author</td>
                                            <td>$43,198</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('js')

    <!-- Internal Gallery js -->
    <script src="/adminpage/assets/plugins/gallery/lightgallery-all.min.js"></script>
    <script src="/adminpage/assets/plugins/gallery/jquery.mousewheel.min.js"></script>
    <script src="/adminpage/assets/js/gallery.js"></script>

@endsection
