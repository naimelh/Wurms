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
    <link rel="stylesheet" href="./styles/home.css"/>
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
      <section class="slogan">
        <div class="container">
          <p>Proud to be a bookworm</p>
          <p>Make reading a habit!</p>
          <p>Welcome, Bookworm! The next chapter's waiting for you!</p>
        </div>
      </section>
      <div class="container">
        <section class="books">
          <h2>Popular books</h2>
          <div class="books__pop">
                <?php

                // get template for Articles
                $template = file_get_contents("templates/home.html");
                
                // SQL query to get the data from the database
                $sql = 'SELECT B.book_id, B.book_title, B.book_img, A.aut_id, A.aut_firstname, A.aut_lastname
                        FROM Book B
                            INNER JOIN Author_Book AB on B.book_id = AB.book_id
                            INNER JOIN Author A on AB.aut_id = A.aut_id
                        WHERE B.fav_id = 1';

                // get the data
                $data = GetData($sql);
                
                // Merge the Template of Article with the data and fill in the @..@ positions
                print MergeViewWithData($template, $data);

                ?>
          </div>
        </section>
        
      </div>
    </main>

<?php
printFooter();
?>
</body>
</html>