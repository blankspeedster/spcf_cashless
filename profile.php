<?php
    require_once("process_profile.php");
    include("head.php");
    $_SESSION['sidebar'] = "profile";
    $session_user_id = $_SESSION['user_id'];
    if(isset($_GET['user'])){
        $current_user = $_GET['user'];
    }
    else{
        $current_user = $session_user_id;
    }
    $users = mysqli_query($mysqli, "SELECT *, u.id AS user_id
    FROM users u
    JOIN role r
    ON r.id = u.role
    WHERE u.id = '$current_user' ");
    $user = $users->fetch_array();
?>
<title>SPCF Cashless - Profile</title>
<body class="g-sidenav-show bg-gray-200">
<?php include("aside.php"); ?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
      <!-- Navbar -->
      <?php include("navbar.php");?>
      <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('./assets/img/profile-background.jpg');">
        <span class="mask bg-gradient-info opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="./assets/img/profile-picture/dp.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $user['firstname'].' '.$user['lastname']; ?>
<!--                  Richard Davis-->
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?php echo ucfirst($user['code']); ?>
<!--                  CEO / Co-Founder-->
              </p>
            </div>
          </div>
        <div class="row">
          <div class="row">

            <div class="col-12 col-xl-12">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Profile Information</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm">
                      <?php echo ucwords($user['description']); ?>
                  </p>
                    <a class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#profileModal">Edit Information</a>
                  <hr class="horizontal gray-light">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $user['firstname'].' '.$user['lastname']; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $user['phone_number'] ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $user['email'] ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; Systems Plus College Foundation</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-12 mt-4">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Cards</h6>
                <p class="text-sm">Below are your cards associated with you</p>
              </div>
              <div class="row">
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-header p-0 mt-n4 mx-3">
                    </div>
                    <div class="card-body p-3">
                      <p class="mb-0 text-sm">Card # 1</p>
                      <a href="javascript:;">
                        <h5>
                          Tag Number:
                        </h5>
                      </a>
<!--                      <p class="mb-4 text-sm">-->
<!--                        -->
<!--                      </p>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php include("footer.php");?>
    <!-- Header Modal -->
    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="profileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirm Log Out and end the session.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cancel</button>
                    <a href="logout.php" type="button" class="btn bg-gradient-info">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Modal -->
  </div>
  <!--   Core JS Files   -->
<?php include("core-js-files.php"); ?>
</body>
<script>
    export default{
        data(){
            return{
                firstName: "sample"
            }
        }
    }
</script>
</html>