<?php

function LimpiaCadena($str)
{
    $str=mb_convert_encoding($str, 'UTF-8', 'ISO-8859-1');
    return $str;
}
?>