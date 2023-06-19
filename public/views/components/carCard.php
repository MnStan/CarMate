<?php

function CarCard($content): string
{
    $output = '
    <div class="car-card">';

    $output .= '<div class="car-card-content drop-shadow">';

    $output .= '<div class="car-photo-container">';
    $output .= '<img class="car-photo drop-shadow" ' . $content['content'];
    $output .= '</div>';

    $output .= '<div class="text-container">';
    $output .= '<div class="car-name">' . $content['car-name'] . '</div>';
    $output .= '<div class="car-price">' . $content['car-price'] . '</div>';
    $output .= '</div>';

    $output .= '</div>';

    $output .= '</div>';

    return $output;
}
