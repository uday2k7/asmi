<?php
  use App\Helpers\Commonfunc;

  $banner_arr=Commonfunc::innerBanner('HOME_CARE_SERVICE');
  
?>
<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <ol  id="hero-carousel-indicators"></ol>

  <div class="carousel-inner" role="listbox">

    
    <div class="carousel-item active" style="background-image: url({!! $banner_arr['image'] !!})">
      <div class="container">
        <h2>{!! $banner_arr['heading_text'] !!}</h2>
        <p>{!! $banner_arr['description'] !!}</p>
        <!-- <a href="#about" class="btn-get-started scrollto">Read More</a> -->
      </div>
    </div>
  </div>

 

</div>