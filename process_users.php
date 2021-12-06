<?php
    include("dbh.php");

    if(isset($_GET['delete_user'])){
        $user_id = $_GET['delete_user'];
        $mysqli->query("DELETE FROM users WHERE id = '$user_id' ") or die ($mysqli->error());

        $_SESSION['userError'] = "User has been deleted!";
        header("location: users.php");
    }

    if(isset($_GET['validate_user'])){
        $user_id = $_GET['validate_user'];
        $mysqli->query("UPDATE users SET validated = '1' WHERE id = '$user_id' ") or die ($mysqli->error());

        $_SESSION['userError'] = "User has been validated successfully!";
        header("location: users.php");
    }
?>