<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact- Asmi Medical Technologies</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('logo.ico') }}" rel="icon">
  <link href="{{ url('assets/frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('assets/frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('assets/frontend/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio - v4.10.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
  use App\Helpers\Commonfunc;
?>
<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    @include('pages.includes.top')
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    @include('pages.includes.header')
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    @include('pages.includes.banner_contact')
  </section><!-- End Hero -->

  <main id="main">
    
   <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Reach Us</h2>
          <p></p>
        </div>

      </div>

      <!-- <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div> -->

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>{{ Commonfunc::showContent('9')['content_details'] }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>{{ Commonfunc::showContent('12')['content_details'] }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>{{ Commonfunc::showContent('10')['content_details'] }}<br>{{ Commonfunc::showContent('11')['content_details'] }}</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form id="create_campaign" class="php-email-form" action="{{url('contact-us/send')}}" method="post" enctype="multipart/form-data" >
              {{csrf_field()}}
               @if ($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                  @endforeach 
                @endif
                @if (\Session::has('message'))
                  <div class="my-3 form-group alert alert-success" role="alert">{!! \Session::get('message') !!}</div>
                @endif
              <div class="form-group ">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              
              <div class="row pt-2 mt-2">                
                <div class="col-md-6 form-group ">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>
                <div class="col-md-6 form-group">
                  <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No" required="">
                </div>
              </div>
              
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
              </div>

             
              
              <div class="text-center">
                <!-- <button type="submit"></button> -->
                <input class="btn btn-primary btn-user btn-block" type="submit" value="Send Message"  />
              </div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

    
    



    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    @include('pages.includes.footer')
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('assets/frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ url('assets/frontend/vendor/aos/aos.js') }}"></script>
  <script src="{{ url('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ url('assets/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>


  <!-- Template Main JS File -->
  <script src="{{ url('assets/frontend/js/main.js') }}"></script>

</body>

</html>