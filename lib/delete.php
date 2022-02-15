<?php
require_once "lib/autoload.php";
CreateConnection();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //controle CSRF token
    if (!key_exists("csrf", $_POST)) die("Missing CSRF");
    if (!hash_equals($_POST['csrf'], $_SESSION['lastest_csrf'])) die("Problem with CSRF");

    $_SESSION['lastest_csrf'] = "";


    /* Delete book records */
    //Delete all records from Book_Genre based on book_id
    ExecuteSQL("DELETE FROM Book_Genre WHERE book_id = '" . $_POST['book_id'] . "'");

    //Delete all records from Author_Book based on book_id
    ExecuteSQL("DELETE FROM Author_Book where book_id = '" . $_POST['book_id'] . "'");

    //Delete all records from Book
    ExecuteSQL("DELETE FROM Book where book_id = '" . $_POST['book_id'] . "'");

    /* Delete author records*/
    //Delete all records from Author_Book based on aut_id
    ExecuteSQL("DELETE FROM Author_Book where aut_id = '" . $_POST['aut_id'] . "'");

    //Delete all records about the author
    ExecuteSQL("DELETE FROM Author where aut_id = '" . $_POST['aut_id'] . "'");


    //redirect after delete
    header("Location: ../" . 'index.php');
}
