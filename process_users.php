<?php
    include("dbh.php");

    if(isset($_GET['delete_user'])){
        $_SESSION['userError'] = "Deletion error encountered!";
        header("location: users.php");
    }
?>