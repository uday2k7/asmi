<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>About- Asmi Medical Technologies</title>
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
    @include('pages.includes.banner_about')
  </section><!-- End Hero -->

  <main id="main">
    
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Why Us</h2>
          <p>We are committed to providing the BEST quality, in-time delivery, and a very happy experience to our customers. No surprises on why we are growing at such an impressive rate!.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ url('assets/frontend/img/about.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>Asmi Medical Technologies enables better professional decisions by delivering high-value solutions </h3>
            <p class="fst-italic">
             to Establish any Diagnostic Centers and Hospitals along with the expert service to operating closer to the clients by delivering high-value solutions to Establish any Diagnostic Centers and Hospitals along with the expert service to operating closer to the client. Our mission is to
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Improve patient care by supplying market-leading diagnostic & Hospital products that enable physicians to more rapidly and accurately determine the course of treatment.</li>
              <li><i class="bi bi-check-circle"></i> Give the complete Planning and Guidance to make the Dream Project successful of our clients.</li>
              
            </ul>
            <p>
              Asmi Medical Technologies is committed to serve the organizations to a level not delivered today with superior support clients can count on.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    
    



    
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