<?php
require_once "pdo.php";

function MakeSelect( $fieldname, $value, $sql, $list_fields = [], $optional = true )
    // $fieldname = img_lan_id, $list_fields = [ "lan_id", "lan_land" ]
{
    $rows = GetData($sql);

    $myselect = "";

    $myselect .= "<select id=$fieldname name=$fieldname>";

    if ( $optional ) $myselect .= "<option></option>";

    foreach ( $rows as $row )
    {
        $selected = "";

        $myselect .= "<option $selected value='" . $row[$list_fields[0]] . "'>" . $row[$list_fields[1]] . "</option>";
    }

    $myselect .= "</select>";

  return $myselect;
}


function MakeSelectAut( $fieldname, $value, $sql, $list_fields = [], $optional = true )
    // $fieldname = img_lan_id, $list_fields = [ "lan_id", "lan_land" ]
{
    $rows = GetData($sql);

    $myselect = "";

    $myselect .= "<select id=$fieldname name=$fieldname>";

    if ( $optional ) $myselect .= "<option></option>";

    foreach ( $rows as $row )
    {
        $selected = "";

        $myselect .= "<option $selected value='" . $row[$list_fields[0]] . "'>" . $row[$list_fields[1]]  . " ".  $row[$list_fields[2]]  . "</option>";
    }

    $myselect .= "</select>";

  return $myselect;
}