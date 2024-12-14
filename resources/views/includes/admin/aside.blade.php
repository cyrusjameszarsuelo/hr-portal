

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset ('img/megawidelogoforadmin.jpg') }}" width="100%">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Manage Website
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('main/generalAnnouncements') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Announcements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Memorandum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HMO Announcements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('main/blogs') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blogs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('main/view-all-surveys') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Survey</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item ">
            <a href="{{ url('main/view-all-meganews') }}" class="nav-link active">
              <i class="fa fa-newspaper"></i>
              <p>Meganews</p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ url('main/view-all-megatrivia') }}" class="nav-link ">
              <i class="fa fa-newspaper"></i>
              <p>Megatrivia</p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ url('main/view-all-megagoodvibes') }}" class="nav-link ">
              <i class="fa fa-newspaper"></i>
              <p>Mega Good Vibes</p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ url('main/view-all-corporateoffice') }}" class="nav-link ">
              <i class="fa fa-newspaper"></i>
              <p>Corporate Office</p>
            </a>
          </li>

          {{-- <li class="nav-item ">
            <a href="{{ url('main/view-all-megagram') }}" class="nav-link ">
              <i class="fa fa-newspaper"></i>
              <p>Mega Gram</p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>