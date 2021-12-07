<?php
    include("dbh.php");

    if(isset($_GET['delete_user'])){
        $user_id = $_GET['delete_user'];
        $mysqli->query("DELETE FROM users WHERE id = '$user_id' ") or die ($mysqli->error());

        $_SESSION['userError'] = "User has been deleted!";
        header("location: users.php");
    }
    

    //Validate users
    if(isset($_GET['validate_user'])){
        $user_id = $_GET['validate_user'];
        $mysqli->query("UPDATE users SET validated = '1' WHERE id = '$user_id' ") or die ($mysqli->error());

        $_SESSION['userError'] = "User has been validated successfully!";
        header("location: users.php");
    }

    if(isset($_GET['edit_user'])){
        $user_id = $_GET['edit_user'];
        $users = mysqli_query($mysqli, "SELECT *, u.id AS user_id, r.id AS role_id FROM users u JOIN role r ON r.id = u.role WHERE u.id = '$user_id' ");
        $user = $users->fetch_array();
    }

    if(isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $role = $_POST['role'];
        $student_id = ucfirst($_POST['student_id']);
        $fname = ucfirst($_POST['fname']);
        $lname = ucfirst($_POST['lname']);
        $email = strtolower($_POST['email']);
        $phone_number = $_POST['phone_number'];

        $mysqli->query("UPDATE users SET student_id = '$student_id', firstname = '$fname', lastname = '$lname', email = '$email', phone_number= '$phone_number', role='$role'
        WHERE id = '$user_id' ") or die ($mysqli->error());

        $_SESSION['userError'] = "Information has been updated!";
        header("location: users.php");
    }

?>