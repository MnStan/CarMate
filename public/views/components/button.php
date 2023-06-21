<?php

function Button($content): string
{
    $output = "<button class='button drop-shadow-animate' type='" .
        $content['type']
        . "'";

    if (isset($content['id'])) {
        $output .= " id='" . $content['id'] . "'";
    }

    $output .= ">" .
        $content['value']
        . "</button>"
    ;

    return $output;
}
