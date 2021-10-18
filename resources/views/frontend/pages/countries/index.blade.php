@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
    <link href="/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <style>
        .yl-popular-course-section {
            padding: 5px 0px 50px;
            background-color: #f7f7f7;
        }

    </style>
@endsection
@section('content')



    <section id="yl-popular-course" class="yl-popular-course-section">
        <div class="container">
            <div class="yl-popular-course-content">
                <div class="row">
                    @foreach ($Organizations as $item)
                    <div class="owl-item col-md-3 mb-2 mt-2" >
                        <div class="yl-blog-img-text">
                            <div class=" text-center">
                                <img width="230px" class="flag" src="{{ '/assets/plugins/flag-icon-css/flags/4x3/'.$item->org_country_code.'.svg'}}"
                                    alt="Angola Flag">
                            </div>
                            <div class="yl-blog-text yl-headline pera-content">

                                <div class="yl-blog-title  text-center ">
                                    <h3><a onclick="getOrganization('{{ $item->org_country_code }}')" class="footer-logo-btn text-center text-uppercase" href="#">{{ $item->org_country_name }}</a></h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                </div>

            </div>
        </div>
    </section>
    <!-- End of Popular course section
                 ============================================= -->
                 <div class="modal yl-login-modal fade" name="mapModal" id="mapModal" tabindex="-1" role="dialog" aria-hidden="true"
                 style="display: none;">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header btn-primary">
                             <h6 class="modal-title" id="country">  </h6>
                             <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                     aria-hidden="true">×</span></button>
                         </div>
                         <div class="card">
                             <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap"
                                 style="padding: 10px">
                                 <thead>
                                     <tr>
                                         <th class="wd-lg-25p">No.</th>
                                         <th class="wd-lg-25p tx-right">Organization</th>
                                         <th class="wd-lg-25p tx-right">Teachers</th>
                                         <th class="wd-lg-25p tx-right">Website</th>
                                         <th class="wd-lg-25p tx-right">E-mail</th>
                                     </tr>
                                 </thead>
                                 <tbody id="databody">
                                   
                                 </tbody>
                             </table>
         
                         </div>
         
                     </div>
                 </div>
             </div>
@endsection
@section('js')
 <script>

function getOrganization(code) {
           
           var url = "/pageadmin/members/organizations/getorganization";
           $.ajax({
               type: "get",
               url: url,
               data: {
                   country_code: code,
                   
                   "_token": "{{ csrf_token() }}"
               }, // serializes the form's elements.
               success: function(data) {
                   if(data.success){
                       $("#mapModal").modal('show');
                   
                   $("#country").html(data.country);
                   $("#databody").html(data.data);
                   }
                  
                  // console.log(data.data);
               }
           });

           
       }
 </script>
@endsection
