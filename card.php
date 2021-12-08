<?php
require_once("process_card.php");
include("head.php");
$_SESSION['sidebar'] = "users";
if (isset($_GET['user'])) {
    $current_user = $_GET['user'];
} else {
    header("location: users.php");
}
$users = mysqli_query($mysqli, "SELECT *, u.id AS user_id
    FROM users u
    WHERE id = '$current_user' ");
$user = $users->fetch_array();
// Current Status Action
$isAdding = true;
?>


<title>
    SPCF Cashless - Enroll Card
</title>

<body class="g-sidenav-show  bg-gray-200">
    <?php include("aside.php"); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include("navbar.php"); ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($_SESSION['cardError'])) { ?>
                        <!-- Alert Here -->
                        <nav class="navbar navbar-expand-lg border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4 blur-danger">
                            <div class="container-fluid ps-2 pe-0">
                                <?php
                                echo $_SESSION['cardError'];
                                unset($_SESSION['cardError']);
                                ?>
                            </div>
                        </nav>
                        <!-- End Here -->
                    <?php } ?>
                </div>
                <!-- Add users here -->
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Enroll a Card for <?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h6>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body p-3">
                                <form action="process_card.php" method="post">
                                    <div class="row m-1">
                                        <div class="col-md-12">
                                            <div class="input-group input-group-static mb-4">
                                                To enroll, make sure that the cursor is in the field below. Then simply tap the card. The registration will take place automatically.
                                                <input type="number" class="form-control" name="tag_number" id="tag_number" required>
                                            </div>
                                        </div>
                                        <input type="text" style="visibility: hidden;" name="user_id" id="user_id" value="<?php echo $current_user; ?>">
                                        <div class="col-md-12 text-end">
                                            <button class="btn btn-info" type="submit" name="save_rfid"><i class="far fa-save"></i> Enroll Card</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Begin list cards here -->
            <?php
            $cards =  mysqli_query($mysqli, "SELECT *
             FROM cards
             WHERE user_id = '$current_user' AND
             deleted = '0' ");
            ?>
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white ps-3">List of Cards on this Account</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <?php if (mysqli_num_rows($cards) > 0) { ?>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><i class="fas fa-hashtag"></i> Number</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="fas fa-hashtag"></i> ID Tag</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="fas fa-check"></i> Created At</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="fas fa-ellipsis-v"></i> Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        while ($card = mysqli_fetch_array($cards)) {
                                            $counter++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1 m-2">
                                                        <p class="text-xs text-secondary mb-0"><?php echo $counter; ?></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $card['tag_number']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $card['created_at']; ?></p>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu shadow-info">
                                                            <button class="dropdown-item" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
                                                            <div class="dropdown-menu shadow-danger mb-1">
                                                                <span class="dropdown-item">This card will be deleted permanently and you cannot undo the changes. Confirm Deletion?</span>
                                                                <a class="dropdown-item text-info" href="#">Cancel</a>
                                                                <a class="dropdown-item text-danger" href="process_card.php?delete_card=<?php echo $card['id'] . '&user_id=' . $current_user; ?>">Confirm Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-12 m-2 text-center">
                                <p class="text-sm text-warning mb-0">No cards enrolled at the moment.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

        </div>
    </main>
    <?php //include("fixed-plugin.php"); 
    ?>
    <?php include("core-js-files.php"); ?>
    <script>
    </script>
</body>

</html>