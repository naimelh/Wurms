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

        <?php
        // Checking if the given id is book_id if not go to else if
        if (key_exists("book_id", $_GET)) {
            echo '<h2>Bewerken Book</h2>';

            // error when book_id is not numeric in the link or not been found
            if (!is_numeric($_GET['book_id']))
                die("Ongeldig argument " . $_GET['book_id'] . "opgegeven");

            //getting the data from the SQL
            $data = GetData("select * from Book where book_id=" . $_GET['book_id']);

            // Only 1 row will be found
            $row = $data[0];

            // Generating the CSRF Security code
            $extra_elements['csrf_token'] = GenerateCSRF("edit.php");

            // Making the Select html for Language
            $extra_elements['select_lang'] = MakeSelect(
                $fkey = 'lang_id',
                $value = $row['lang_id'],
                $sql = "select lang_id, lang_desc from Language");

            // Making the Select html for Popular
            $extra_elements['select_pop'] = MakeSelect(
                $fkey = 'fav_id',
                $value = $row['fav_id'],
                $sql = "select fav_id, fav_desc from Favorite");

            // Get the Template for book_edit
            $output = file_get_contents("templates/book_edit.html");

            // Merge de data from $data with the template
            $output = MergeViewWithData($output, $data);

            // Merging CSRF and the 2 HTML Selects into the template
            $output = MergeViewWithExtraElements($output, $extra_elements);

            // Replace Error Tags when error exist
            $output = MergeViewWithErrors( $output, $errors );

            // Delete all @@ tags that are not filled in
            $output = RemoveEmptyErrorTags( $output, $data );


            // Printing the Form
            print $output;

        } // Checking if the given id is book_id
        else if (key_exists("aut_id", $_GET)) {
            echo '<h2>Bewerken Auteur</h2>';

            // error when aut_id is not numeric in the link or not been found
            if (!is_numeric($_GET['aut_id']))
                die("Ongeldig argument " . $_GET['aut_id'] . "opgegeven");

            //getting the data from the SQL
            $data = GetData("select * from Author where aut_id=" . $_GET['aut_id']);

            // Only 1 row will be found
            $row = $data[0];

            // Generating the CSRF Security code
            $extra_elements['csrf_token'] = GenerateCSRF("edit.php");

            // Making the Select html for Country
            $extra_elements['select_country'] = MakeSelect(
                $fkey = 'country_id',
                $value = $row['country_id'],
                $sql = "select country_id, country_desc from Country");

            // Making the Select html for Gender
            $extra_elements['select_gender'] = MakeSelect(
                $fkey = 'gender_id',
                $value = $row['gender_id'],
                $sql = "select gender_id, gender_desc from Gender");

            // Get the Template for author_edit
            $output = file_get_contents("templates/author_edit.html");

            // Merge de data from $data with the template
            $output = MergeViewWithData($output, $data);

            // Merging CSRF and the 2 HTML Selects into the template
            $output = MergeViewWithExtraElements($output, $extra_elements);

            // Replace Error Tags when error exist
            $output = MergeViewWithErrors( $output, $errors );

            // Delete all @@ tags that are not filled in
            $output = RemoveEmptyErrorTags( $output, $data );


            // Printing the Form
            print $output;

        } else {
            echo "No Book or Author ID given";
        }
        ?>
    </div>
</main>

