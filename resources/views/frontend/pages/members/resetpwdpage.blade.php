<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lumpinee Academy Muaythai-@yield('title')</title>
    <meta name="Keywords"
        content="สนามมวยลุมพีนี |  โรงเรียนสอนศิลปะการต่อสู้ | โรงเรียนมวยไทยลุมพินี | Lumpinee academy muaythai" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="/assets/css/odometer-theme-default.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{ asset('/assets/img/icon/web/favicon.ico') }}" type="image/x-icon">
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #65ad73;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                          
                                <form id="frmreset" role="form" action="/members/resetpwdurl" autocomplete="off"
                                    class="form" method="post">
                                    @csrf

                                    <input   type="hidden" id="keytoken" name="keytoken" value="{{Request::get('tokenkey') }}">
                                     

                                    <div class="form-group text-left">
                                      <label>New Password</label>
                                      <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Confirm Password</label>
                                      <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                    <button  type="button" class="btn btn-lg btn-primary btn-block" onclick="login();">Reset Password</button>
                                  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<script src="/assets/js/appear.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/jquery.fancybox.js"></script>
<script src="/assets/js/owl.js"></script>
<script src="/assets/js/isotope.pkgd.min.js"></script>
<script src="/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="/assets/js/masonry.pkgd.min.js"></script>
<script src="/assets/js/odometer.js"></script>


<script src="/assets/js/parallax-scroll.js"></script>
<script src="/assets/js/jquery.nice-select.min.js"></script>
<script src="/assets/js/typer.js"></script>
<script>
   
  $(document).ready(function(){            

  });

  function login() {
     
      var password = $("#newpassword").val()
      var password1 = $("#confirmpassword").val()
      var pswlen = password.length;
      if (pswlen < 6) {
          Swal.fire({
          icon: 'error',
          title: 'Minmum  6 characters needed',
          text: "Please try again!",
          showConfirmButton: true,
          timer: 1500
        });
       
      }   else {

         if (password != password1) {
          Swal.fire({
          icon: 'error',
          title: 'Password Not match',
          text: "Please try again!",
          showConfirmButton: true,
          timer: 1500
        });
          } else {
            var form = $("#frmreset");
            var url = form.attr('action');
             
            $.ajax({
                  type: "POST",
                   url: url,
                   data: form.serialize(), 
                  success: function(data)
                  {
                    console.log(data);
                    if(data.success){
                      Swal.fire({
                          icon: 'success',
                          title: data.message,
                          text: "Please Ready to login!",
                          showConfirmButton: true,
                          timer: 1500
                        }).then((result) => {
                          location.href='/';
                        });
                    } else {
                        Swal.fire({
                          icon: 'error',
                          title: data.message,
                          text: "Please try again!",
                          showConfirmButton: true,
                          timer: 1500
                        }) ;
                    }
                  }
              });
          }

      }

  }
 
</script>
</html>
