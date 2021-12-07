<?php
require_once("process_profile.php");
include("head.php");
$_SESSION['sidebar'] = "profile";
$session_user_id = $_SESSION['user_id'];
if (isset($_GET['user'])) {
  $current_user = $_GET['user'];
} else {
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

<body class="g-sidenav-show bg-gray-200" id="app">

  <?php include("aside.php"); ?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <?php include("navbar.php"); ?>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="col-12">
        <?php if (isset($_SESSION['profileError'])) { ?>
          <!-- Alert Here -->
          <nav class="navbar navbar-expand-lg border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4 blur-danger">
            <div class="container-fluid ps-2 pe-0">
              <?php
              echo $_SESSION['profileError'];
              unset($_SESSION['profileError']);
              ?>
            </div>
          </nav>
          <!-- End Here -->
        <?php } ?>
      </div>
      <!-- Vue App Here -->
      <span id="vueApp">
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
                  <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
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
                      <button class="btn btn-sm btn-info" @click="editInformation" v-if="!isEdit"><i class="fas fa-edit"></i> Edit Information</button>
                      <button class="btn btn-sm btn-warning" @click="editInformation" v-if="isEdit">Cancel</button>
                      <hr class="horizontal gray-light">
                      <!-- Start Profile Information here -->
                      <ul class="list-group" v-if="!isEdit">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $user['firstname'] . ' ' . $user['lastname']; ?></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phione Number:</strong> &nbsp; <?php echo $user['phone_number'] ?></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $user['email'] ?></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; Systems Plus College Foundation</li>
                      </ul>
                      <div v-else>
                        <form method="post" action="process_profile.php">
                          <div class="input-group input-group-static mb-3">
                            First Name
                            <input type="text" class="form-control" value="<?php echo $user['firstname'] ?>" name="fname" required>
                          </div>
                          <div class="input-group input-group-static mb-3">
                            Last Name
                            <input type="text" class="form-control" value="<?php echo $user['lastname'] ?>" name="lname" required>
                          </div>
                          <div class="input-group input-group-static mb-3">
                            Phone Number
                            <input type="text" class="form-control" value="<?php echo $user['phone_number'] ?>" name="phone_number" required>
                          </div>
                          <div class="input-group input-group-static mb-3">
                            Email
                            <input type="text" class="form-control" value="<?php echo $user['email'] ?>" name="email" required>
                          </div>
                          <input type="text" style="visibility: hidden;" value="<?php echo $current_user; ?>" name="user_id">
                          <br>
                          <button class="btn btn-sm btn-info" type="submit" name="update_profile"><i class="far fa-save"></i> Update Information</button>
                        </form>
                      </div>
                      <!-- End Profile Information here -->
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
        <?php include("footer.php"); ?>
      </span>
      <!-- End Vue App Here -->
    </div>
    <!--   Core JS Files   -->
    <?php include("core-js-files.php"); ?>
</body>
<script>
  new Vue({
    el: "#vueApp",
    data() {
      return {
        isEdit: false,
      }
    },
    methods: {
      editInformation() {
        this.isEdit = !this.isEdit;

      }
    },
    mounted() {

    }
  });
</script>

</html>