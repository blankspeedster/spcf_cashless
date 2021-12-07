<?php
    include("dbh.php");

    //Process Add Card
    if(isset($_POST['save_rfid'])){
        $user_id = $_POST['user_id'];
        $tag_number = $_POST['tag_number'];
        $checkCard = $mysqli->query("SELECT * FROM cards WHERE tag_number='$tag_number' ");
        if(mysqli_num_rows($checkCard)>0){
            $_SESSION['cardError'] = "This card is already owned by someone. Please try another card.";
            header("location: card.php?user=".$user_id);
        }
        else{
            $mysqli->query(" INSERT INTO cards (user_id, tag_number) VALUES('$user_id','$tag_number') ") or die ($mysqli->error);

            $_SESSION['cardError'] = "Card has been enrolled!";
            header("location: card.php?user=".$user_id);
        }
    }

    if(isset($_GET['delete_card'])){
        $user_id = $_GET['user_id'];
        $card_id = $_GET['delete_card'];
        $checkCard = $mysqli->query("SELECT * FROM cards WHERE tag_number='$tag_number' ");

        $mysqli->query("UPDATE cards SET deleted = '1' WHERE id = '$card_id' ") or die ($mysqli->error);

        $_SESSION['cardError'] = "Card has been deleted!";
        header("location: card.php?user=".$user_id);
    }

?>