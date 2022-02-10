<?php
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    PrintHead("Search");
    ?>
    <link rel="stylesheet" href="./styles/search.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap"
          rel="stylesheet">
</head>
<body>
<?php
if (key_exists("search", $_GET)) {
    PrintHeader($_GET["search"]);
} else {
    PrintHeader();
}
?>
<div class="container">
    <section class="books">
        <?php
        // Checking if GET has search of if search is an empty string
        if (!key_exists("search", $_GET) || $_GET["search"] == "") {

            // get the all the data from Books
            $sql_book = 'SELECT book_id, book_title, book_img
                        FROM Book';
            echo "<h2>Books</h2>";
            $data_book = GetData($sql_book);

            // get all the data for Author
            $sql_aut = 'SELECT aut_id, aut_firstname, aut_lastname, aut_img
                        FROM Author';
            $data_aut = GetData($sql_aut);

        } else {
            // get all the data that is = to the search value for Book
            $sql_book = 'SELECT book_id, book_title, book_img
                        FROM Book 
                        WHERE book_title LIKE "%' . $_GET["search"] . '%"';
            $data_book = GetData($sql_book);
            if (count($data_book) > 0) {
                echo "<h2>Books that contain " . $_GET["search"] . "</h2>";
            }

            // get all the data that is = to the search value for Book
            $sql_aut = 'SELECT aut_id, aut_firstname, aut_lastname, aut_img
                        FROM Author 
                        WHERE aut_firstname LIKE "%' . $_GET["search"] . '%" OR aut_firstname LIKE "%' . $_GET["search"] . '%"';
            $data_aut = GetData($sql_aut);
        } ?>
        <div class="books__pop">
            <?php

            // get template for Articles
            $template = file_get_contents("templates/search_book.html");

            // only print the template when you have min. 1 row
            if (count($data_book) > 0) {
                // Merge the Template of Article with the data and fill in the @..@ positions
                print MergeViewWithData($template, $data_book);
            }

            ?>
        </div>
    </section>
    <section class="books">
        <?php
        // Checking if GET has search of if search is an empty string
        if (!key_exists("search", $_GET) || $_GET["search"] == "") {

            echo "<h2>Authors</h2>";

        } else {
            if (count($data_aut) > 0) {
                echo "<h2>Authors that contain " . $_GET["search"] . "</h2>";
            }
        } ?>
        <div class="books__pop">
            <?php

            // get template for Articles
            $template = file_get_contents("templates/search_author.html");

            // only print the template when you have min. 1 row
            if (count($data_aut) > 0) {
                // Merge the Template of Article with the data and fill in the @..@ positions
                print MergeViewWithData($template, $data_aut);
            }


            ?>
        </div>
    </section>
    <section class="books">
        <div class="books__pop">
            <?php
                // both has no results print No results
                if(count($data_aut) === 0 && count($data_book) === 0) {
                    echo "<h2> No Results Found! </h2>";
                }
            ?>
        </div>
    </section>
</div>
</body>