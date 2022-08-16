<?php

header("content-type:application/json");
function Message($status, $message, $so1 = '', $so2 = '', $so3='')
{
    $notice = array(
        "status" => $status,
        "message" => $message,
        "data" => array(
            "mot" => $so1,
            "hai" => $so2,
            "ba" => $so3
        )
    );
    return json_encode($notice);
}

?>