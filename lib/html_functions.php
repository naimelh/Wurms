<?php

function PrintHead($title = "")
{
    $head = file_get_contents("templates/head.html");
    $head = str_replace("@title@", $title, $head);
    print $head;
}
function PrintHeader()
{
    $header = file_get_contents("templates/header.html");
    print $header;
}
function printFooter()
{
    $footer = file_get_contents("templates/footer.html");
    print $footer;
}


function MergeViewWithData($template, $data)
{
    $returnvalue = "";

    foreach ($data as $row) {
        $output = $template;

        foreach (array_keys($row) as $field)  //eerst "img_id", dan "img_title", ...
        {
            $output = str_replace("@$field@", $row["$field"], $output);
        }

        $returnvalue .= $output;
    }

    if ($data == []) {
        $returnvalue = $template;
    }

    return $returnvalue;
}
