<?php
require_once "lib/autoload.php";
CreateConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./styles/delete.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap" rel="stylesheet">
</head>
<div class="dContainer">


    <?php
    //  TEST
    // if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    // $aut_id = $_POST['aut_id'];
    // $sql = "DELETE FROM author WHERE aut_id = $aut_id";
    // or die(mysql_error());
    //  echo "OK";
    //  } else {
    //  header("Location: home.php"); } 


    //Define the query to delete a record
    $sql = "DELETE FROM author WHERE name = {$_POST['delete']} LIMIT 1";

    //sends the query to delete the entry
    // on success delete : redirect the page to original page using header() method
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); //or echo "<div class="deleted"><h2 >Author has been deleted </h2></div><br /><br />" 
        exit;
    } else {
        //if it failed
        echo 'div class="failed"><h2>' . "Deletion Failed" . '</h2></div><br /><br />';
    }
    mysqli_close($conn);
    ?>

</div>