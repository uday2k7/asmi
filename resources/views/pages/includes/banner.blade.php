<?php
  use App\Helpers\Commonfunc;

  $banner=Commonfunc::homebanner();
  //dd($banner);
  
?>
<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

  <div class="carousel-inner" role="listbox">
    @foreach($banner as $details)
    <!-- Slide 1 -->
    <div class="carousel-item active" style="background-image: url({{ $details['image'] }})">
      <div class="container">
        <h2>{{ $details['heading'] }}</h2>
        <p>{{ $details['description'] }}</p>
        <!-- <a href="#about" class="btn-get-started scrollto">Read More</a> -->
      </div>
    </div>
    @endforeach
    
  </div>

  <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
  </a>

  <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
  </a>

</div>