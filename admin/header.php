<?php 
echo ' 
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="netije.php" class="nav-link">Baş sahypa</a>
      </li>      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Gözleg" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>      
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="position:fixed;">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->          
          <li class="nav-item">
            <a href="netije.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Netijeler               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sreje.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Synag reje              
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="halypa.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Halypa mugallym              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="gosmak.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Goşmak             
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Ulanyjylar              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dersler.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Dersler
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sgor.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Synag görnüşi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="umumy_reje.php" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Umumy reje
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="online.php" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Ulgamdakylar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pozmak.php" class="nav-link">
              <i class="nav-icon fas fa-trash"></i>
              <p>
                Netijäni pozmak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="user_girish.php" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Ulanyjy giriş
              </p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  ';
?>