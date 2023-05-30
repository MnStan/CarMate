<?php

function Card($content): string
{
    $output = '
    <div class="card">
    <div class="card-title"><h1>
    ';

    $output .= $content['title'];

    $output .= '</h1></div><div class="card-content drop-shadow">';

    $output .= $content['content'];

    $output .= '
    </div></div>
    ';

    return $output;
}