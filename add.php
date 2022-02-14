<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
PrintHead("Voeg iets toe");
?>
<link rel="stylesheet" href="./styles/edit.css"/>
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
<div class="container">
    <div class="row">

        <?php
        

        $extra_elements['csrf_token'] = GenerateCSRF( "add.php"  );
        
        if(strpos($_SERVER['HTTP_REFERER'], "listpagebook.php")!== false) 
        {

            $output = file_get_contents("templates/addbook.html");
    
            //merge
            $output = MergeViewWithExtraElements( $output, $extra_elements );
    
    
            print $output;

        }
        else{
            

            $output = file_get_contents("templates/addautor.html");
    
            //merge
            $output = MergeViewWithExtraElements( $output, $extra_elements );
    
    
            print $output;
            

        }

        ?>

                </div>
            </div>
        </main>
    </body>
</html>