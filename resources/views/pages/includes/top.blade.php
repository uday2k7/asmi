<?php
  use App\Helpers\Commonfunc;
?>
<div class="container d-flex align-items-center justify-content-center justify-content-md-between">
  <div class="align-items-center d-none d-md-flex">
    <i class="bi bi-clock"></i> {{ Commonfunc::showContent('8')['content_details'] }}
  </div>
  <div class="d-flex align-items-center">
    <i class="bi bi-phone"></i> Call us now {{ Commonfunc::showContent('10')['content_details'] }}
  </div>
</div>