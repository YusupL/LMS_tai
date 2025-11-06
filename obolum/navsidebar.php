<?php
	    include '../dbconnection.php';
	    // $id_ulanyjy=$_SESSION['id'];
	?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav justify-content-between">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item  d-sm-inline">        
        <a class="nav-link"><i class="font-weight-bold fas fa-university"></i><b> Dolandyryş bölümi</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a class="nav-link"><?=$kafedra?></a> -->
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">      
      <li class="nav-item">
          <a class="nav-link font-weight-bold" href="../logout.php" style="color: rgb(14, 105, 14);">
            <i class="fas fa-door-open"></i>
            <span>Çykmak</span>
          </a>
        </li>
    </ul>
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar img sidebar-dark-success bg-success elevation-4 shadow-lg rgba-gradient">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-lg">
      <i class="fas fa-book-reader ml-4 shadow-lg"></i>
      <span class="brand-text font-weight-light font-weight-bold">ŞAHSY otag</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar shadow-lg">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2 text-bold" style="opacity: 1;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="netije.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Netijeler               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($skript=="restrictions.php") echo "active";?>">
              <i class="nav-icon fas fa-times-circle"></i>
              <p class="font-weight-bold">
                  Çäklendirme
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ballar.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class="text-bold">
                Derejeleýin bahalandyrma
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="mugallymlar.php" class="nav-link <?php if($skript=="teachers.php") echo "active";?>">
              <i class="nav-icon fas fa-user-friends"></i>
              <p class="font-weight-bold">
                 Mugallymlar
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>