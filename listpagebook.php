<?php
require_once "lib/config.php";
require_once "lib/pdo.php";
require_once "lib/select.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    PrintHead("Boeken");
    ?>
    <link rel="stylesheet" href="styles/listpage.css"/>
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


              <form action="" method="GET" >
                <div class="input-group mb-3">
                  <input type="number" name="search" size="44" maxlength="88" min="0" value="
                  
                  <?php if(isset($_GET['search'])){
                    echo $_GET['search'];
                  }
                  
                  ?>" class="form-control" placeholder="Aantal pagina's">

                  <?php

                  print  MakeSelect( "genre_id", $value="", "select * from Genre", ["genre_id","genre_desc"], $optional = true);
                
                  ?>
                  
                  <button type="submit" class="btn btn-primary">Zoeken</button>
                </div>
                <a href="add.php"> Voeg een nieuwe boek </a>
              </form>
            
                
              <?php
                  $pages = $_GET['search'];
                  $genre = $_GET['genre_id'];
                  
                  if(empty($pages) AND empty($genre)){
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname, G.genre_id
                    FROM Book B
                          INNER JOIN Author_Book AB on B.book_id = AB.book_id
                          INNER JOIN Author A on AB.aut_id = A.aut_id
                          INNER JOIN Book_Genre BG on BG.book_id =  B.book_id
                          INNER JOIN Genre G on BG.genre_id = G.genre_id";
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpagebook.html");
                    $output= MergeViewWithData($output, $data);
                    print $output;


                  }
                    elseif(empty($genre))
                      {$filtervalues = $_GET['search'];
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname
                    FROM Book B
                          INNER JOIN Author_Book AB on B.book_id = AB.book_id
                          INNER JOIN Author A on AB.aut_id = A.aut_id
                    WHERE  B.book_pages <= $filtervalues ";
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpagebook.html");
                    $output= MergeViewWithData($output, $data);
                    print $output;
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
                        print $output;
                      }
                  else{
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
                    print $output;

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

                  

