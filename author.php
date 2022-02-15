<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    //printing the header and give the page a title
    PrintHead("Details about the author");

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
        <div class="container-details">
            <h2 class="detail__header">About</h2>
        <?php

     if  ((key_exists('aut_id', $_GET)) AND (!is_numeric($_GET['aut_id'])))  die('Ongeldig argument: ' . $_GET['aut_id'] . 'is opgegeven</h2>');

        //SQL query to get the data from the database
        $sql = 'SELECT A.aut_id,A.aut_firstname, A.aut_lastname,A.aut_birthday,A.aut_bio, A.aut_img, G.gender_id, G.gender_desc, C.country_id, C.country_desc,B.book_id,B.book_title
                        FROM Author A
                            INNER JOIN Author_Book AB on A.aut_id = AB.aut_id
                            INNER JOIN Book B on AB.book_id = B.book_id
                            INNER JOIN Country C on A.country_id = C.country_id
                            INNER JOIN Gender G on A.gender_id = G.gender_id
                        WHERE A.aut_id=' . $_GET['aut_id'];

        // get the data
        $data = GetData($sql);

        // get detail page template
        $template = file_get_contents("templates/author.html");

        // Merge the template of detail page with the data and fill in the @..@ positions
        $output = MergeViewWithData($template, $data);

        $extra_elements['csrf_token'] = GenerateCSRF();

        //merge with csfr
        $output =  MergeViewWithExtraElements( $output , $extra_elements);
        
        print $output;


         ?>
        </div>
    </main>

        <?php
        printFooter();
        ?>
</body>

