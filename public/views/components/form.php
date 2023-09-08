<?php

function Form($content, $onSubmitFunctionName): string
{
    $output = "<form class='flex flex-column flex-center form-login' action='" .
        $content['action']
        . "' method='" .
        $content['method']
        . "' enctype='multipart/form-data' onsubmit='return " .
        $onSubmitFunctionName .
        "()'>";

    $output .= $content['content'];

    $output .= "</form>";

    return $output;
}
