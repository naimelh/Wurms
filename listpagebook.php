<?php
require_once "lib/autoload.php";
require_once "lib/select.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    PrintHead("Boeken");
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


              <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="post">
<?php
              $csrf_token = GenerateCSRF();
                print '<input type="hidden" name="csrf" value="' . $csrf_token .'"> <p><small></small></p>';
?>
                <input name="searchquery" type="number" size="44" maxlength="88"> 
  

<?php

               print  MakeSelect( "genre_id", $value="", "select * from Genre", ["genre_id","genre_desc"], $optional = true);

?>
<div class="form-group row">
        <div class="col-sm-8">
            <input type="submit" value="Verzenden">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-8">
            <a href="add.php">Voeg een Boek</a>
        </div>
    </div>

</form>

<?php
                $pages=$_POST["searchquery"];
                $genre = $_POST["genre_id"];
              
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // collect value of input field
                  if (empty($pages) AND empty($genre)) {
                    echo "both fields are empty";
                  } 
                  elseif(empty($pages)){

                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname, G.genre_id
                    FROM Book B
                    INNER JOIN Author_Book AB on B.book_id = AB.book_id
                    INNER JOIN Author A on AB.aut_id = A.aut_id
                    INNER JOIN Book_Genre BG on BG.book_id =  B.book_id
                    INNER JOIN Genre G on BG.genre_id = G.genre_id
                    WHERE  G.genre_id = $genre ";
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpagebook.html");
                    $output= MergeViewWithData($output, $data);
                    $output = MergeViewWithExtraElements( $output, $extra_elements );
                    print $output;
                  }
                  
                  elseif(empty($genre)){

                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname
                    FROM Book B
                    INNER JOIN Author_Book AB on B.book_id = AB.book_id
                    INNER JOIN Author A on AB.aut_id = A.aut_id
                    WHERE  B.book_pages <= $pages ";
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpagebook.html");
                    $output= MergeViewWithData($output, $data);
                    $output = MergeViewWithExtraElements( $output, $extra_elements );
                    print $output;
                  }
                    
                  
                  else {
                  
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname, G.genre_id
                    FROM Book B
                          INNER JOIN Author_Book AB on B.book_id = AB.book_id
                          INNER JOIN Author A on AB.aut_id = A.aut_id
                          INNER JOIN Book_Genre BG on BG.book_id =  B.book_id
                          INNER JOIN Genre G on BG.genre_id = G.genre_id
                    WHERE  B.book_pages <= $pages  AND G.genre_id = $genre ";
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpagebook.html");
                    $output= MergeViewWithData($output, $data);
                    $output = MergeViewWithExtraElements( $output, $extra_elements );
                    print $output;

                  }
                }
                ?>

        </section>
    </div>
</main>

<?php
printFooter();
?>
</body>
</html>