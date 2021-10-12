@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')



    <!-- Start of contact content section
                 ============================================= -->
    <section id="contact-content" class="contact-content-section">
        <div class="container">

            <div class="yl-contact-content-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                            <div class="yl-contact-content-icon">
                                <img src="assets/img/cct-icon1.png" alt="">
                            </div>
                            <div class="yl-contact-content-text yl-headline">
                                <h3>Address</h3>
                                <span>
                                    <span> {{ $sysinfo->sys_address }}</span>
                                    <span> {{ $sysinfo->sys_country }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                            <div class="yl-contact-content-icon">
                                <img src="assets/img/cct-icon2.png" alt="">
                            </div>
                            <div class="yl-contact-content-text yl-headline">
                                <h3>Email Us</h3>
                                <span> {{ $sysinfo->sys_email1 }}</span>
                                <span> {{ $sysinfo->sys_email2 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="yl-contact-content-inner text-center">
                            <div class="yl-contact-content-icon">
                                <img src="assets/img/cct-icon3.png" alt="">
                            </div>
                            <div class="yl-contact-content-text yl-headline">
                                <h3>Phone No</h3>
                                <span> {{ $sysinfo->sys_phone1 }}</span>
                                <span>{{ $sysinfo->sys_phone2 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="yl-contact-form-wrap yl-headline">
                <h3>Write us a message</h3>

                <form id="frmmessage" name="frmmessage" class="yl-contact-form-area"
                    action="{{ route('fn.message.contact') }}" method="post">
                    @csrf

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            
                            <div class="alert alert-danger" role="alert">
                              <h3>!!! {{ $error }}</h3>  
                            </div>
                        @endforeach
                    @endif

                    <div class="yl-contact-form-input d-flex mb-2">
                        <input type="text" id="subject" name="subject" placeholder="Your subject*" required >

                    </div>

                    <div class="yl-contact-form-input d-flex">
                        <input type="text" id="name" name="name" placeholder="Your Name*" required>
                        <input type="email" id="email" name="email" placeholder="Your email*" required>
                        <input type="text" id="phone" name="phone" placeholder="Phone">
                    </div>


                    <textarea id="message" name="message" placeholder="Write your message here*" required></textarea>
                    <button type="submit">Submit Now <i class="fas fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </section>
    <!-- End of contact content section
                 ============================================= -->
@endsection
@section('js')

@endsection
