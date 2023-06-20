<?php

function RentInfo($content): string
{
    $output .= '<div class="info-title drop-shadow">' ;
    $output .= '<h3 class="info-title-content">';
    $output .= $content;
    $output .= '</h3></div>';

    return $output;
}
