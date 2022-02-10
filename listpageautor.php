<?php
require_once "lib/autoload.php";
require_once"lib/select.php";
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

<?php
               print  MakeSelectAut( "aut_id", $value="", "select * from Author", ["aut_id", "aut_firstname", "aut_lastname"], $optional = true);

?>
<div class="form-group row">
        <label class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
            <input type="submit">
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
            $template = file_get_contents("templates/listpagebook.html");
            $data = GetData($sql);
            print MergeViewWithData($template, $data);

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