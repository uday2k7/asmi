<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="pt-4">
          <li class="sidebar-item">
            <a
              class="sidebar-link has-arrow waves-effect waves-dark"
              href="javascript:void(0)"
              aria-expanded="false"
              ><i class="mdi mdi-receipt"></i
              ><span class="hide-menu">Content Management </span></a
            >
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/1') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Review & Analysis </span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/2') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Evaluation</span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/3') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Support </span></a
                >
              </li> 
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/4') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Medical Equipments </span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/5') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Home Health Care Service</span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/content/6') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Project Consultation </span></a
                >
              </li> 
            </ul>
          </li>

          <li class="sidebar-item">
            <a
              class="sidebar-link has-arrow waves-effect waves-dark"
              href="javascript:void(0)"
              aria-expanded="false"
              ><i class="mdi mdi-receipt"></i
              ><span class="hide-menu">Service Management </span></a
            >
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="{{ url('cpanel/service/our-expertise') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Our Expertise </span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/service/our-solutions') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Our Solutions </span></a
                >
              </li>
              <!-- <li class="sidebar-item">
                <a href="{{ url('cpanel/service/medical-equipments') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Medical Equipments </span></a
                >
              </li> -->
              <li class="sidebar-item">
                <a href="{{ url('cpanel/service/items-we-offered') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Items We Offered </span></a
                >
              </li>
            </ul>
          </li>

           
          <!-- <li class="sidebar-item {{ (Request::is('cpanel/emotions/*')) ? 'selected' : '' }}">
            <a
              class="sidebar-link waves-effect waves-dark"
              href="{{ url('cpanel/emotions') }}"
              aria-expanded="false"
              ><i class="fa fa-smile"></i
              ><span class="hide-menu">Banner</span></a
            >
          </li> 
          <li class="sidebar-item {{ (Request::is('cpanel/emotions/*')) ? 'selected' : '' }}">
            <a
              class="sidebar-link waves-effect waves-dark"
              href="{{ url('cpanel/emotions') }}"
              aria-expanded="false"
              ><i class="fa fa-smile"></i
              ><span class="hide-menu">Inner Pages</span></a
            >
          </li>  -->
          <li class="sidebar-item">
            <a
              class="sidebar-link has-arrow waves-effect waves-dark"
              href="javascript:void(0)"
              aria-expanded="false"
              ><i class="mdi mdi-receipt"></i
              ><span class="hide-menu">Banner Management </span></a
            >
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="{{ url('cpanel/banner/home') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Home Page </span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/banner/inner') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-plus"></i
                  ><span class="hide-menu"> Inner Pages </span></a
                >
              </li>
            </ul>
          </li>
          <li class="sidebar-item {{ (Request::is('cpanel/user/*')) ? 'selected' : '' }}"">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link "
              href="{{ url('cpanel/portfolio/list') }}"
              aria-expanded="false"
              ><i class="fa fa-users"></i
              ><span class="hide-menu">Portfolio</span></a
            >
          </li> 
          <!-- <li class="sidebar-item">
            <a
              class="sidebar-link has-arrow waves-effect waves-dark"
              href="javascript:void(0)"
              aria-expanded="false"
              ><i class="mdi mdi-receipt"></i
              ><span class="hide-menu">Website Management </span></a
            >
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="{{ url('cpanel/banner/home') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-outline"></i
                  ><span class="hide-menu"> Contact Information </span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/banner/inner') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-plus"></i
                  ><span class="hide-menu"> Openning Time</span></a
                >
              </li>
              <li class="sidebar-item">
                <a href="{{ url('cpanel/banner/inner') }}" class="sidebar-link"
                  ><i class="mdi mdi-note-plus"></i
                  ><span class="hide-menu"> Footer About Us</span></a
                >
              </li>
            </ul>
          </li> -->
          <!-- <li class="sidebar-item {{ (Request::is('cpanel/contact/*')) ? 'selected' : '' }}"">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link "
              href="{{ url('cpanel/contact/index') }}"
              aria-expanded="false"
              ><i class="fa fa-calendar"></i
              ><span class="hide-menu">Contact</span></a
            >
          </li>  -->
          <!-- <li class="sidebar-item {{ (Request::is('cpanel/activities/*')) ? 'selected' : '' }}"">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link "
              href="{{ url('cpanel/activities') }}"
              aria-expanded="false"
              ><i class="fas fa-tasks"></i
              ><span class="hide-menu">Messages</span></a
            >
          </li> 
          <li class="sidebar-item {{ (Request::is('cpanel/activities/*')) ? 'selected' : '' }}"">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link "
              href="{{ url('cpanel/activities') }}"
              aria-expanded="false"
              ><i class="fas fa-tasks"></i
              ><span class="hide-menu">Services</span></a
            >
          </li> 

          <li class="sidebar-item {{ (Request::is('cpanel/log/*')) ? 'selected' : '' }}"">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link "
              href="{{ url('cpanel/log') }}"
              aria-expanded="false"
              ><i class="fa fa-history"></i
              ><span class="hide-menu">Log</span></a
            >
          </li> -->
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>