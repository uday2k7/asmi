<?php
  use App\Helpers\Commonfunc;
?>
<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-6">
        <div class="footer-info">
          <h3>ASMI</h3>
          <p>
           {{ Commonfunc::showContent('7')['content_details'] }}
          </p>
          <div class="social-links mt-3">
            <!-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
            <a href="https://www.facebook.com/profile.php?id=100087151610936" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
            <!-- <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
          </div>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 footer-links">
        <h4>INFORMATION</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('/')}}">Home</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('about-us')}}">About us</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('contact-us')}}">Contact Us</a></li>
          <!-- <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li> -->
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>CATEGORY</h4>
        <ul>
          <!-- <li><i class="bx bx-chevron-right"></i> <a href="{{url('portfolio')}}">Portfolio</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('contact-us')}}">Contact Us</a></li> -->
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('services/1')}}">Medical Equipments</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('services/2')}}">Home Care Service</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="{{url('services/3')}}">Project Consultancy</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6 footer-newsletter">
        <div class="footer-info">
          <h3>Contact</h3>
          <p>
            {{ Commonfunc::showContent('9')['content_details'] }}<br><br>
            <strong>Phone:</strong> {{ Commonfunc::showContent('10')['content_details'] }}<br>
            <strong>Email:</strong> {{ Commonfunc::showContent('12')['content_details'] }}<br>
          </p>
          <div class="social-links mt-3">
            <!-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
            <!-- <a href="https://www.facebook.com/profile.php?id=100087151610936" class="facebook"><i class="bx bxl-facebook"></i></a> -->
            <!-- <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>asmi</span></strong>. All Rights Reserved
  </div>
  
</div>