@extends('frontend.layout.index_main')
@section('title')
    Admin Page
@endsection
 

@section('content')
 <!-- Start of not found content section
         ============================================= -->
         <section id="not-found" class="not-found-section">
            <div class="container">
               <div class="not-found-content text-center">
                  <span>Opps! things you are looking for doesn’t exists!</span>
                  <a href="#">Return Home <i class="flaticon-arrow"></i></a>
                  <div class="error-img">
                     <img src="assets/img/er.png" alt="">
                  </div>
               </div>
            </div>
         </section>
      <!-- End of not found content section
         ============================================= -->   



@endsection
  