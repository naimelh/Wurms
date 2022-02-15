<?php

function PrintHead($title = "")
{
    $head = file_get_contents("templates/head.html");
    $head = str_replace( "@title@", $title, $head );
    print $head;
}
function PrintHeader($search = ""){
    $header = file_get_contents("templates/header.html");
    $header = str_replace( "@search@", $search, $header );
    print $header;
}
function printFooter(){
    $footer = file_get_contents("templates/footer.html");
    print $footer;
}


function MergeViewWithData( $template, $data )
{
    $returnvalue = "";

    foreach ( $data as $row )
    {
        $output = $template;

        foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
        {
            $output = str_replace( "@$field@", $row["$field"], $output );
        }

        $returnvalue .= $output;
    }

    if ( $data == [] )
    {
        $returnvalue = $template;
    }

    return $returnvalue;
}



function MergeViewWithExtraElements( $template, $elements )
{
    foreach ( $elements as $key => $element )
    {
        $template = str_replace( "@$key@", $element, $template );
    }
    return $template;
}

function MergeViewWithErrors( $template, $errors )
{
    foreach ( $errors as $key => $error )
    {
        $template = str_replace( "@$key@", "<p style='color:red'>$error</p>", $template );
    }
    return $template;
}

function RemoveEmptyErrorTags( $template, $data )
{
    foreach ( $data as $row )
    {
        foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
        {
            $template = str_replace( "@$field" . "_error@", "", $template );
        }
    }

    return $template;
}