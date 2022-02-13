<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    PrintHead("Details about the book");
    ?>
    <link rel="stylesheet" href="./styles/detailpage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    PrintHeader();
    ?>

    <main>
        <?php

        if (!is_numeric($_GET['book_id'])) die("Ongeldig argument " . $_GET['book_id'] . " opgegeven");

        //SQL query to get the data from the database
        $sql = 'SELECT B.book_id, B.book_title, B.book_img,B.publish_year, B.book_pages,A.aut_id, A.aut_firstname, A.aut_lastname,L.lang_id,L.lang_desc,G.genre_id,G.genre_desc
                        FROM Book B
                            INNER JOIN Author_Book AB on B.book_id = AB.book_id
                            INNER JOIN Author A on AB.aut_id = A.aut_id
                            INNER JOIN Language L on B.lang_id = L.lang_id
                            INNER JOIN Book_Genre  BG on B.book_id = BG.book_id
                            INNER JOIN Genre G on BG.genre_id = G.genre_id
                        WHERE B.book_id=' . $_GET['book_id'];

        // get the data
        $data = GetData($sql);

        // get detail page template
        $template = file_get_contents("templates/book.html");

        // Merge the template of detail page with the data and fill in the @..@ positions
        print MergeViewWithData($template, $data);
        ?>
    </main>


    <?php
    printFooter();
    ?>

</body>

</html>