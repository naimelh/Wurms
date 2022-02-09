<?php
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author</title>
    <link rel="stylesheet" href="styles/detailpage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap" rel="stylesheet" />
</head>

<body>
    <?php
    PrintHeader();
    ?>
    <main>
        <div class="aContainer">
            <?php

            // SQL query to get the data from the database
            $sql = 'SELECT B.book_id, B.book_title, B.book_img, A.aut_id, A.aut_firstname, A.aut_lastname
                        FROM Book B
                            INNER JOIN Author_Book AB on B.book_id = AB.book_id
                            INNER JOIN Author A on AB.aut_id = A.aut_id
                        WHERE B.aut_id = 1';

            // get the data
            $data = GetData($sql);

            // get template about the author
            $template = file_get_contents("templates/detailpage.html");

            //merge
            $output = MergeViewWithData($template, $data);
            print $output;

            ?>
        </div>
    </main>
    <?php
    printFooter();
    ?>
</body>

</html>