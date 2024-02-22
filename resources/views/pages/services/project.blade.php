<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Services- Asmi Medical Technologies</title>
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
    @include('pages.includes.banner_project')
  </section><!-- End Hero -->

  <main id="main">
    
    <section id="doctors" class="doctors section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>OUR SOLUTIONS</h2>
          <p>Project management consultancy services are vital for high impact, time sensitive projects, those most critical to your organization’s success.</p>
        </div>

        <div class="row">
          <?php
            $solutions=Commonfunc::solutions();
            foreach($solutions as $details)
            {
          ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="{{ $details['image'] }}" class="img-fluid" alt="">
                <div class="social" style="opacity: 1;border-bottom: 4px solid #3fbbc0;">
                  <h3>{{ $details['heading'] }}</h3>
                </div>
              </div>
              <div class="member-info">
                
                <span>{{ $details['content'] }}</span>
              </div>
            </div>
          </div>
          <?php
            }
          ?>

        </div>

      </div>
    </section>
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>OUR Business Model</h2>
          <p></p>
        </div>
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
            <div class="icon-box mt-5 mt-lg-0">
              <i class="bx bx-receipt"></i>
              
              <p>We bridge the gap between Clients and completion process, to set up a Diagnostic Centre or A Hospital.</p>
            </div>
            <div class="icon-box mt-5">
              <i class="bx bx-cube-alt"></i>
              
              <p>The setup cost of the Centre purely depends on the service offered and the investment you make. </p>
            </div>
            <div class="icon-box mt-5">
              <i class="bx bx-images"></i>
              
              <p>A good business plan is necessary to grow your business up to the mark. </p>
            </div>
            
          </div>
          <div class="image col-lg-6 order-1 order-lg-2" style='background-image: url("../../assets/frontend/img/features.jpg");' data-aos="zoom-in"></div>
        </div>

      </div>
    </section>



    
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
  <script src="{{ url('assets/frontend/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('assets/frontend/js/main.js') }}"></script>

</body>

</html>