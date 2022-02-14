<?php
require_once "lib/autoload.php";
CreateConnection();
?>


DeleteFormData();

function DeleteFormData()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //controle CSRF token
        if (!key_exists("csrf", $_POST)) die("Missing CSRF");
        if (!hash_equals($_POST['csrf'], $_SESSION['lastest_csrf'])) die("Problem with CSRF");

        $_SESSION['lastest_csrf'] = "";

        //sanitization
        $_POST = StripSpaces($_POST);
        $_POST = ConvertSpecialChars($_POST);

        $table = $pkey = $delete = $where = $str_keys_values = "";

        //get important metadata
        if (!key_exists("table", $_POST)) die("Missing table");
        if (!key_exists("pkey", $_POST)) die("Missing pkey");

        $table = $_POST['table'];
        $pkey = $_POST['pkey'];
        $book = $_POST['id'];
        $author = $_POST['id'];

        //validation
        $sending_form_uri = $_SERVER['HTTP_REFERER'];
        CompareWithDatabase($table, $pkey);

        //terugkeren naar afzender als er een fout is
        if (array_key_exists('errors', $_SESSION) && $_SESSION["errors"] != null && count($_SESSION['errors']) > 0 ) {
            header("Location: " . $sending_form_uri);
            exit();

        }

        //delete?
        if ( $_POST["$pkey"] > 0 ) $delete = true;

        //delete query
        $sql = "DELETE $table SET ";


        foreach ($_POST as $field => $value) {
            //skip non-data fields
            if (in_array($field, ['table', 'pkey', 'afterinsert', 'afterupdate', 'csrf', 'afterdelete'])) continue;

            //handle primary key field
            if ($field == $pkey) {
                if ($delete) $where = " WHERE $pkey = $value ";
                continue;
            }

        }

        //extend SQL with WHERE
        $sql .= $where;

        //run SQL
        $result = ExecuteSQL($sql);

        //output if not redirected
        print $sql;
        print "<br>";
        print $result->rowCount() . " records affected";

        //redirect after insert or update
        if ($delete and $_POST["afterdelete"] > "") header("Location: ../" . $_POST["afterdelete"] );
    }
}
