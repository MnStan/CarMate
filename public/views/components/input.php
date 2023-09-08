<?php

function Input($content): string
{
    $output = "<div class='input-container'>";

    $output .= "<div class='input-icon'><img src='" . $content['image'] . "' alt='Ikona'></div>";

    $output .= "<input class='input' type='" . $content['type'] . "' name='" . $content['name'] . "' placeholder='" . $content['placeholder'] . "'";

    if (isset($content['value'])) {
        $output .= " value='" . $content['value'] . "'";
    }

    $output .= "></div>";

    return $output;
}