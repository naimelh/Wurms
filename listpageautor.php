<?php
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    PrintHead("Autheur");
    ?>
    <link rel="stylesheet" href="./styles/listpage.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&display=swap"
    rel="stylesheet">
</head>
<body>
<?php
PrintHeader();
?>

<main>
    
        <div class="lContainer">
            <section class="listpage">
                
        <?php

                // get template for Articles
                $template = file_get_contents("templates/listpageautor.html");
                
                // SQL query to get the data from the database
                $sql = 'SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname, A.aut_birthday, A.aut_img, A.aut_bio
                        FROM Book B
                            INNER JOIN Author_Book AB on B.book_id = AB.book_id
                            INNER JOIN Author A on AB.aut_id = A.aut_id
                        WHERE B.fav_id = 1';

                // get the data
                $data = GetData($sql);
                
                // Merge the Template of Article with the data and fill in the @..@ positions
                print MergeViewWithData($template, $data);

                ?>

        </section>
    </div>
</main>

<?php
printFooter();
?>
</body>
</html>