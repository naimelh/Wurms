<?php
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    PrintHead("Home");
    ?>
    <link rel="stylesheet" href="./styles/search.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap"
          rel="stylesheet">
</head>
<body>
<?php
if (key_exists("search",$_GET)){
    PrintHeader($_GET["search"]);
}
else{PrintHeader();}
 ?>
<div class="container">
    <section class="books">
        <?php if (!key_exists("search",$_GET) || $_GET["search"] == ""){
            echo "<h2>Books</h2>";

        } else {
            echo "<h2>Books that contain ".$_GET["search"]."</h2>";
        }?>
        <div class="books__pop">
            <?php

            // get template for Articles
            $template = file_get_contents("templates/search_book.html");

            // SQL query to get the data from the database
            if (key_exists("search",$_GET)){
                $sql = 'SELECT book_id, book_title, book_img
                        FROM Book 
                        WHERE book_title LIKE "%'.$_GET["search"].'%"';
            }else {
                $sql = 'SELECT book_id, book_title, book_img
                        FROM Book';
            }


            // get the data
            $data = GetData($sql);

            // Merge the Template of Article with the data and fill in the @..@ positions
            print MergeViewWithData($template, $data);

            ?>
        </div>
    </section>
    <section class="books">
        <?php if (!key_exists("search",$_GET) || $_GET["search"] == ""){
            echo "<h2>Author</h2>";

        } else {
            echo "<h2>Author that contain ".$_GET["search"]."</h2>";
        }?>
        <div class="books__pop">
            <?php

            // get template for Articles
            $template = file_get_contents("templates/search_author.html");

            // SQL query to get the data from the database
            if (key_exists("search",$_GET)){
                $sql = 'SELECT aut_id, aut_firstname, aut_lastname, aut_img
                        FROM Author 
                        WHERE aut_firstname LIKE "%'.$_GET["search"].'%" OR aut_firstname LIKE "%'.$_GET["search"].'%"';
            }else {
                $sql = 'SELECT aut_id, aut_firstname, aut_lastname, aut_img
                        FROM Author';
            }
            // get the data
            $data = GetData($sql);

            // Merge the Template of Article with the data and fill in the @..@ positions
            print MergeViewWithData($template, $data);

            ?>
        </div>
    </section>
</div>
</body>