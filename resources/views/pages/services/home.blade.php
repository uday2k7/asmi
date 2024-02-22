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
  $portfolio=Commonfunc::portfolio('ITEMS_WE_OFFERED');
  //dd($portfolio);  
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
    @include('pages.includes.banner_homecare')
  </section><!-- End Hero -->

  <main id="main">
    
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>OUR Initiative</h2>
          <p></p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ url('assets/frontend/img/service.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>THE CARE YOU NEED. THE CARE YOU DESERVE</h3>
            <p class="fst-italic">
             It is our belief that everyone deserves the proper medical equipment & home health care supplies for their treatment. They deserve the service, support, & care to help make their homes as comfortable as possible. Our commitment to caring is not limited to patients, but extends to caregivers, & physicians as well.
            </p>
            <ul>
              <li> We offered:</li>
              <li><i class="bi bi-check-circle"></i> Digital BP Machine</li>
              <li><i class="bi bi-check-circle"></i> Digital Glucometer</li>
              <li><i class="bi bi-check-circle"></i> Analog Weight Scale</li>
              <li><i class="bi bi-check-circle"></i> Digital Weight Scale</li>
              <li><i class="bi bi-check-circle"></i> Oxygen Concentrator</li>
              <li><i class="bi bi-check-circle"></i> CPAP/BIPAP</li>
              <li><i class="bi bi-check-circle"></i> Patient Bed</li>
              <li><i class="bi bi-check-circle"></i> Water Bed</li>
              
            </ul>
            
          </div>
        </div>

      </div>
    </section>

    <section id="doctors" class="doctors section-bg" style="border-top: 4px solid #3fbbc0;">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>ITEMS WE OFFERED</h2>
          <p></p>
        </div>
        <div class="row">
          @foreach($portfolio as $port)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel{{$port['cnt']}}" class="carousel slide" data-bs-ride="carousel">  
                     
                <div class="carousel-inner">
                  <?php 
                    $portfoliodetails3=Commonfunc::portfoliodetails($port['id']);
                    foreach ($portfoliodetails3 as $details3) {
                  ?>
                  <div class="carousel-item active">
                    <img src="{{ $details3['image'] }}" class="d-block w-100" alt="{{ $details3['name'] }}">
                  </div>
                  <?php } ?>
                                
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$port['cnt']}}" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$port['cnt']}}" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>   
              <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>{{ $port['name'] }}</h4>
              </div>      
            </div> 
          </div>
          @endforeach
          <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel2" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                 
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/h-3.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/h-4.jpg') }}" class="d-block w-100" alt="...">
                </div>
                            
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
             <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>ANALOG WEIGHT SCALE</h4>
              </div>              
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel3" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/h-5.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/h-6.jpg') }}" class="d-block w-100" alt="...">
                </div> 
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/h-7.jpg') }}" class="d-block w-100" alt="...">
                </div> 
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/h-8.jpg') }}" class="d-block w-100" alt="...">
                </div>              
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div> 
             <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>OXYZEN CONCENTRATOR</h4>
              </div>             
            </div>
          </div> -->

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