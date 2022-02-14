<?php
require_once "lib/autoload.php";
require_once "lib/select.php";
CreateConnection();

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

    <input type="hidden" id="table" name="table" value="autor">
    <input type="hidden" id="afterinsert" name="afterinsert" value="index.php">
    <input type="hidden" id="afterupdate" name="afterupdate" value="index.php">
    <!-- end meta info -->

    <!--security-->
  <?php
    $csrf_token = GenerateCSRF();
    print '<input type="hidden" name="csrf" value="' . $csrf_token .'">
    <p><small></small></p>';


               print  MakeSelectAut( "aut_id", $value="", "select * from Author", ["aut_id", "aut_firstname", "aut_lastname"], $optional = true);

?>
<div class="form-group row">
        <div class="col-sm-8">
            <input type="submit" value="Verzenden">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-8">
            <a href="add.php">Voeg een autheur</a>
        </div>
    </div>

</form>

<?php
                
                $aut= $_POST["aut_id"];
              
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // collect value of input field
                  if (empty($aut)) {
                    echo "Field is empty";
                  } else {
                  
                    $sql = "SELECT B.book_id, B.book_title, B.book_img, B.book_pages,  B.publish_year, A.aut_id, A.aut_firstname, A.aut_lastname
                    FROM Book B
                    INNER JOIN Author_Book AB on B.book_id = AB.book_id
                    INNER JOIN Author A on AB.aut_id = A.aut_id
                    WHERE A.aut_id = $aut";     

            ;
            $data = GetData($sql);
            $output = file_get_contents("templates/listpagebook.html");
            $output = MergeViewWithData($template, $data); 
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