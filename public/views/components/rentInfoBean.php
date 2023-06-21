<?php
function RentInfo($text, $editable = false, $id = ''): string
{
    $output = '<div class="info-title drop-shadow">';

    if ($editable) {
        $output .= '<input type="text" class="info-title-content editable" value="' . $text . '" id="' . $id . '">';
    } else {
        $output .= '<h3 class="info-title-content">' . $text . '</h3>';
    }

    $output .= '</div>';

    return $output;
}
