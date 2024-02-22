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
    @include('pages.includes.banner_medical')
  </section><!-- End Hero -->

  <main id="main">
    
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>WHY CHOOSE US</h2>
          <p></p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ url('assets/frontend/img/about.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3></h3>
            <p class="fst-italic">
            
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Our expertise's have proficiency in deliver the consignment in time. And the precise sense of the urgency of your business needs, requirements as well as aspirations. </li>
              <li>&nbsp;</li>
              <li>&nbsp;</li>
              <li><i class="bi bi-check-circle"></i> We will work with you to ensure that your requirements is to be fulfilled up to the mark and make you glad with the  experience with us.</li>
              <li>&nbsp;</li>
              <li>&nbsp;</li>
              <li><i class="bi bi-check-circle"></i> We will give the support for maintenance of the equipment's around the clock. Not let your business getting slow in this competitive market.</li>
              <li>&nbsp;</li>
              <li>&nbsp;</li>
              <li><i class="bi bi-check-circle"></i> Our goal is to provide the most affordable patient care products & services available within the health care service industry. </li>
              
            </ul>
            <p>
             
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
    <section id="doctors" class="doctors section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>OUR EXPERTISE</h2>
          <p></p>
        </div>

        <div class="row">
          <?php
            $img1=Commonfunc::expertise('1')['image'];
            $img2=Commonfunc::expertise('2')['image'];
            $img3=Commonfunc::expertise('3')['image'];
          ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="{{ $img1 }}" class="img-fluid" alt="">
                <div class="social" style="opacity: 1;border-bottom: 4px solid #3fbbc0;">
                  <h3>{{ Commonfunc::expertise('1')['heading'] }}</h3>
                </div>
              </div>
              <div class="member-info">
                <!-- <h3>Review & Analysis</h3> -->
                <span>{{ Commonfunc::expertise('1')['content'] }}</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="{{ $img2 }}" class="img-fluid" alt="">
                <div class="social" style="opacity: 1;border-bottom: 4px solid #3fbbc0;">
                  <h3>{{ Commonfunc::expertise('2')['heading'] }}</h3>
                </div>
              </div>
              <div class="member-info">
                <!-- <h3>Evaluation</h3> -->
                <span>{{ Commonfunc::expertise('2')['content'] }}</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="{{ $img3 }}" class="img-fluid" alt="">
                <div class="social" style="opacity: 1;border-bottom: 4px solid #3fbbc0;">
                  <h3>{{ Commonfunc::expertise('3')['heading'] }}</h3>
                </div>
              </div>
              <div class="member-info">
               <!--  <h3>Support</h3> -->
                <span>{{ Commonfunc::expertise('3')['content'] }}</span>
              </div>
            </div>
          </div>

        

        </div>

      </div>
    </section>
    <section id="doctors" class="doctors section-bg" style="border-top: 4px solid #3fbbc0;">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel1" class="carousel slide" data-bs-ride="carousel">  
                <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>           
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ url('assets/frontend/img/doctors/img-1.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-2.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-3.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>   
              <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>X- Ray 100/300/500mA</h4>
              </div>      
            </div> 

          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel2" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/img-4.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-5.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-6.jpg') }}" class="d-block w-100" alt="...">
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
                <h4>ECG Machine 12/3 Channel</h4>
              </div>              
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel3" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel3" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/img-8.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-7.jpg') }}" class="d-block w-100" alt="...">
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
                <h4>EEG / USG Machine </h4>
              </div>             
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel4" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel4" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel4" data-bs-slide-to="1" aria-label="Slide 2"></button>
                   <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel4" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel4" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/img-9.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-10.jpg') }}" class="d-block w-100" alt="...">
                </div> 
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-11.jpg') }}" class="d-block w-100" alt="...">
                </div> 
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-12.jpg') }}" class="d-block w-100" alt="...">
                </div>              
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel4" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel4" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>  
             <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>Pathological EquipmentA</h4>
              </div>            
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel5" class="carousel slide" data-bs-ride="carousel">  
                <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel5" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel5" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel5" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>           
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ url('assets/frontend/img/doctors/img-13.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-14.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-15.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel5" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel5" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div> 
               <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>Operation Theatre</h4>
              </div>    
                     
            </div>            
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel6" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel6" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel6" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel6" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/img-16.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-17.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-18.jpg') }}" class="d-block w-100" alt="...">
                </div>               
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel6" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel6" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div> 
             <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>Ward</h4>
              </div>             
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel7" class="carousel slide" data-bs-ride="carousel">  
                <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel7" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel7" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel7" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>           
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ url('assets/frontend/img/doctors/img-19.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-20.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ url('assets/frontend/img/doctors/img-21.jpg') }}" class="d-block w-100" alt="...">
                  </div>
                  
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel7" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel7" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>   
                 <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>  ICU / HDU </h4>
              </div>       
            </div>            
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div id="carousel8" class="carousel slide" data-bs-ride="carousel">   
              <div class="carousel-indicators">
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel8" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel8" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" style="background-color:#3fbbc0;" data-bs-target="#carousel8" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>          
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ url('assets/frontend/img/doctors/img-22.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-23.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ url('assets/frontend/img/doctors/img-24.jpg') }}" class="d-block w-100" alt="...">
                </div>               
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel8" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel8" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
             <div class="member-info" style="border-top: 2px solid #3fbbc0;">
                <h4>OPD</h4>
              </div>              
            </div>
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