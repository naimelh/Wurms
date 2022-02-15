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


              <form action="" method="GET" >
                <div class="input-group mb-3">
                

                  <?php

                    print  MakeSelectAut( "aut_id", $value="", "select * from Author", ["aut_id", "aut_firstname", "aut_lastname"], $optional = true);
                
                  ?>
                  
                  <button type="submit" class="btn btn-primary">Zoeken</button>
                </div>
                <a href="add.php"> Voeg een nieuwe Autheur </a>
              </form>
                
              <?php
                  $aut = $_GET['aut_id'];
                  
                
                  if (empty($aut)) {
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname,A.aut_birthday,A.aut_bio, A.aut_img
                    FROM Book B
                    INNER JOIN Author_Book AB on B.book_id = AB.book_id
                    INNER JOIN Author A on AB.aut_id = A.aut_id";     
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpageauthor.html");
                    $output = MergeViewWithData($output, $data); 
                    print $output;
                  } 
                  else{
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname,A.aut_birthday,A.aut_bio, A.aut_img
                    FROM Book B
                    INNER JOIN Author_Book AB on B.book_id = AB.book_id
                    INNER JOIN Author A on AB.aut_id = A.aut_id
                    WHERE A.aut_id = $aut";     
                    $data = GetData($sql);
                    $output = file_get_contents("templates/listpageauthor.html");
                    $output = MergeViewWithData($output, $data); 
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

                  

