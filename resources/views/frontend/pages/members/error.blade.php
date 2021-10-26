@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')
@if ($errors->any())
<div class="card" id="solid-alert">
    <div class="text-wrap">
        <div class="example">
            @foreach ($errors->all() as $error)

                <div class="alert alert-solid-danger bg-danger text-white   mg-b-10" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert"
                        type="button">
                        <span aria-hidden="true">&times;</span></button>
                    <strong>Oh snap!</strong> {{ $error }}
                </div>
            @endforeach
        </div>
    </div>
</div>
@else 

<section id="not-found" class="not-found-section bg-danger">
    <div class="container">
       <div class="not-found-content text-center  ">
          <span class="text-white">PLEASE CLICK IN THE LINK BELOW TO GO TO THE CLIENT LOGIN</span>
          <button data-toggle="modal" class="btn btn-primary btn-block" data-target="#frmModallogin"><i class="fas fa-user"></i> Login Page</button>
         
       </div>
    </div>
 </section>

 
@endif
{{-- <script>
    $(document).ready(function() {
        $('#frmModallogin').modal('show');
    });

</script> --}}
@endsection
