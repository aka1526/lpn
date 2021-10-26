@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')
 
<section id="not-found" class="not-found-section bg-danger">
    <div class="container">
        @if( $act )
        
            <script>   
            Swal.fire({
            icon: 'success',
            title: '{{ $message }}',
            showConfirmButton: true,
            timer: 2000
            }).then(() => {
               // window.location.href = "/";
               $("#frmModallogin").modal('show');
                
            })
            </script>
        @else 
             <script>   
                 Swal.fire({
                icon: 'error',
                title: '{{ $message }}',
                showConfirmButton: true,
                timer: 2000
                }).then(() => {
                  //  window.location.href = "/";
                     
                    $("#frmModallogin").modal('show');
                })
              </script> 
        @endif
 
  
    </div>
 </section>

 
   
@endsection
