@extends('frontend.layout.index_main')
@section('title')
 หน้าหลัก 
 @endsection
@section('content')
 

      <!-- Start of not found content section
         ============================================= -->
         <section id="not-found" class="not-found-section bg-danger">
            <div class="container">
               <div class="not-found-content text-center  ">
                  <span class="text-white">Opps! things you are looking for doesn’t exists!</span>
                  <a class="btn btn-light  btn-block" href="/"> <i class="fa fa-arrow-left"></i> Return Home  </a>
                 
               </div>
            </div>
         </section>
      <!-- End of not found content section
         ============================================= -->  
@endsection
@section('js')
 
@endsection
