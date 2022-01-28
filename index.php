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
    <link rel="stylesheet" href="./styles/homepage.css"/>
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
    <div class="mContainer">
        <section class="slogan">
            <p>Proud to be a bookworm</p>
            <p>Make reading a habit!</p>
            <p>Welcome, Bookworm! The next chapter's waiting for you!</p>
        </section>
        <section class="books">
            <h2>Popular Books</h2>
            <div class="list_books">
                <?php
                $template = file_get_contents("templates/home.html");

                $sql = 'SELECT B.book_id, B.book_title, A.aut_id, A.aut_firstname, A.aut_lastname
                        FROM Book B
                            INNER JOIN Author_Book AB on B.book_id = AB.book_id
                            INNER JOIN Author A on AB.aut_id = A.aut_id
                        WHERE B.fav_id = 1';

                $data = GetData($sql);

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