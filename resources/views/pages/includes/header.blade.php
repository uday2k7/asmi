<div class="container d-flex align-items-center">

  <a href="{{url('/')}}" class="logo me-auto"><img src="{{ url('assets/frontend/img/logo.png') }}" alt=""></a>
  <!-- Uncomment below if you prefer to use an image logo -->
  <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

  <nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
      <li><a class="nav-link scrollto {{ (Request::is('/')) ? 'active' : '' }}"  href="{{url('/')}}">Home</a></li>
      <li class="dropdown nav-link scrollto"><a href="#"><span class="{{ (Request::is('services/*')) ? 'active' : '' }}">Services</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
          <li><a class="{{ (Request::is('services/1')) ? 'active' : '' }}" href="{{url('services/1')}}">Medical Equipments</a></li>         
          <li><a class="{{ (Request::is('services/2')) ? 'active' : '' }}" href="{{url('services/2')}}">Home Care Service</a></li>
          <li><a class="{{ (Request::is('services/3')) ? 'active' : '' }}" href="{{url('services/3')}}">Project Consultancy</a></li>
        </ul>
      </li>
      <li><a class="nav-link scrollto {{ (Request::is('portfolio')) ? 'active' : '' }}" href="{{url('portfolio')}}">Portfolio </a></li>
      <li><a class="nav-link scrollto {{ (Request::is('contact-us')) ? 'active' : '' }}" href="{{url('contact-us')}}">Contact Us</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->

  <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> -->

</div>