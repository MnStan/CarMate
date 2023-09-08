<?php

function CarCard($content): string
{
    $output = '
    <div class="car-card">';

    $output .= '<div class="car-card-content drop-shadow">';

    $output .= '<div class="car-photo-container">';
    $output .= '<a href="carInfo?id=' . $content['car']->getCarId() . '">';
    $output .= '<img class="car-photo drop-shadow" ' . $content['content'];
    $output .= '</a>';
    $output .= '</div>';

    $output .= '<div class="text-container">';
    $output .= '<div class="car-name">' . $content['car-name'] . '</div>';
    $output .= '<div class="car-localization">' . $content['car-lozalization'] . '</div>';
    $output .= '</div>';

    $output .= '</div>';

    $output .= '</div>';

    return $output;
}
