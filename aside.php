<?php
    if(!isset($_SESSION['email'])){
        header("Location: sign-in.php");
    }
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-black-50 opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php" target="_self">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-black-50">SPCF Cashless</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-black-50 <?php if($_SESSION['sidebar'] == "dashboard"){echo "active bg-gradient-info";} ?>" href="index.php">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black-50 <?php if($_SESSION['sidebar'] == "users"){echo "active bg-gradient-info";} ?>" href="users.php">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black-50 <?php if($_SESSION['sidebar'] == "billing"){echo "active bg-gradient-info";} ?>" href="billing.php">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link text-black-50 " href="./pages/virtual-reality.html">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a class="nav-link text-black-50 " href="./pages/rtl.html">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a class="nav-link text-black-50 " href="./pages/notifications.html">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li> -->

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-black-50 font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black-50 <?php if($_SESSION['sidebar'] == "profile"){echo "active bg-gradient-info";} ?>" href="profile.php">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link text-black-50 " href="./pages/sign-in.html">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a class="nav-link text-black-50 " href="./pages/sign-up.html">
            <div class="text-black-50 text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li> -->

      </ul>
    </div>
<!--    <div class="sidenav-footer position-absolute w-100 bottom-0 ">-->
<!--      <div class="mx-3">-->
<!--        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>-->
<!--      </div>-->
<!--    </div>-->
  </aside>