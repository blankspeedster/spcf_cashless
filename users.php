<?php
    require_once("process_users.php");
    include("head.php");
    $_SESSION['sidebar'] = "users";
    $session_user_id = $_SESSION['user_id'];
    $users = mysqli_query($mysqli, "SELECT *, u.id AS user_id
    FROM users u
    JOIN role r
    ON r.id = u.role ");
?>
<title>
    SPCF Cashless - Users
</title>
<body class="g-sidenav-show  bg-gray-200">
  <?php include("aside.php"); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include("navbar.php");?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
          <div class="col-12">
              <?php if(isset($_SESSION['userError'])){ ?>
                  <!-- Alert Here -->
                  <!-- Navbar -->
                  <nav class="navbar navbar-expand-lg border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4 blur-danger">
                      <div class="container-fluid ps-2 pe-0">
                          <?php
                          echo $_SESSION['userError'];
                          unset($_SESSION['userError']);
                          ?>
                      </div>
                  </nav>
                  <!-- End Navbar -->
                  <!-- End Here -->
              <?php } ?>
          </div>
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">List of users</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="fas fa-user"></i> Fullname</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="fas fa-hashtag"></i> ID Number</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="fas fa-phone"></i> Phone Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="fas fa-scroll"></i> Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="fas fa-check"></i> Validation Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="fas fa-ellipsis-v"></i> Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($user = mysqli_fetch_array($users)){ ?>
                  <tr>
                      <td>
                          <div class="d-flex px-2 py-1">
                              <div>
                                  <img src="assets/img/profile-picture/dp.png" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm"><a href="profile.php?user=<?php echo $user['id'];?>" target="_blank"><?php echo $user["firstname"]." ".$user["lastname"]; ?></a></h6>
                                  <p class="text-xs text-secondary mb-0"><?php echo $user['email']; ?></p>
                              </div>
                          </div>
                      </td>
                      <td>
                          <p class="text-xs text-secondary mb-0"><?php echo $user['student_id']; ?></p>
                      </td>
                      <td>
                          <p class="text-xs text-secondary mb-0"><?php echo $user['phone_number']; ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                          <?php if($user['role'] == 1){ ?>
                          <span class="badge badge-sm bg-gradient-success">Admin</span>
                          <?php } else if($user['role'] == 2){ ?>
                          <span class="badge badge-sm bg-gradient-info">Student</span>
                          <?php } else { ?>
                          <span class="badge badge-sm bg-gradient-warning">Store Owner</span>
                          <?php } ?>

                      </td>
                      <td class="align-middle text-center text-sm">
                          <?php if($user['validated'] == 0){ ?>
                          <span class="badge badge-sm bg-gradient-primary">Pending</span>
                          <?php } else { ?>
                          <span class="badge badge-sm bg-gradient-success">Validated</span>
                          <?php } ?>
                      </td>
                      <td class="align-middle text-center text-sm">
<!--                          <li class="btn btn-info btn-sm">-->
<!--                              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                                  <i class="fas fa-bars"></i>-->
<!--                              </a>-->
<!--                              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">-->
<!--                                  <li class="mb-2">-->
<!--                                      <a class="dropdown-item border-radius-md" data-bs-toggle="modal" data-bs-target="#exampleModal">-->
<!--                                          <div class="d-flex py-1">-->
<!--                                              <div class="d-flex flex-column justify-content-center">-->
<!--                                                  <h6 class="text-sm font-weight-normal mb-1">-->
<!--                                            <span class="font-weight-bold">Log Out-->
<!--                                                  </h6>-->
<!--                                              </div>-->
<!--                                          </div>-->
<!--                                      </a>-->
<!--                                  </li>-->
<!--                              </ul>-->
<!--                          </li>-->

                          <div class="btn-group">
                              <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-bars"></i>
                              </button>
                              <div class="dropdown-menu shadow-info">
                                  <?php if($user['validated'] != 1){ ?>
                                    <a class="dropdown-item" href="process_users.php?validate_user=<?php echo $user['user_id'];?>">Validate</a>
                                  <?php } ?>
                                  <a class="dropdown-item" href="users.php?edit_user=<?php echo $user['user_id'];?>">Edit Information</a>
                                  <a class="dropdown-item" href="profile.php?user=<?php echo $user['user_id'];?>" target="_blank">View Profile</a>
                                  <button class="dropdown-item" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
                                  <div class="dropdown-menu shadow-danger mb-1">
                                      <span class="dropdown-item">All information related to this user will be permanent. You cannot undo the changes. Confirm Deletion?</span>
                                      <a class="dropdown-item text-info" href="#">Cancel</a>
                                      <a class="dropdown-item text-danger" href="process_users.php?delete_user=<?php echo $user['user_id'];?>">Confirm Delete</a>
                                  </div>
                              </div>
                          </div>
<!--                          <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">-->
<!--                              Edit-->
<!--                          </a>-->
                      </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include("footer.php");?>

    </div>
  </main>
<?php //include("fixed-plugin.php"); ?>
<?php include("core-js-files.php"); ?>
</body>

</html>