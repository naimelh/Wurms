<?php
require_once "lib/autoload.php";
CreateConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

    //printing the header and give the page a title
    PrintHead("Edit Book");

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
        <h2>Bewerken</h2>


        <?php
        // error when book_id is not included in the link or not been found
        if ( ! is_numeric( $_GET['book_id']) ) die("Ongeldig argument " . $_GET['book_id'] . "
        opgegeven");

        //getting the data from the SQL
        $data = GetData( "select * from Book where book_id=" . $_GET['book_id'] );

        // Only 1 row will be found
        $row = $data[0];

        // Generating the CSRF Security code
        $extra_elements['csrf_token'] = GenerateCSRF( "book_edit.php"  );

        // Making the Select html for Language
        $extra_elements['select_lang'] = MakeSelect(
                $fkey = 'lang_id',
                $value = $row['lang_id'] ,
                $sql = "select lang_id, lang_desc from Language" );

        // Making the Select html for Popular
        $extra_elements['select_pop'] = MakeSelect(
            $fkey = 'fav_id',
            $value = $row['fav_id'] ,
            $sql = "select fav_id, fav_desc from Favorite" );

        // Get the Template for book_edit
        $output = file_get_contents("templates/book_edit.html");

        // Merge de data from $data with the template
        $output = MergeViewWithData($output,$data);

        // Merging CSRF and the 2 HTML Selects into the template
        $output = MergeViewWithExtraElements( $output, $extra_elements );



        // Printing the Form
        print $output
        ?>

    </div>
</main>

<?php

// printing the footer
printFooter();

?>
