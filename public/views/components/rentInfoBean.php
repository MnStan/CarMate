<?php
function RentInfo($text, $editable = false, $id = '', $max_length = 50): string
{
    $output = '<div class="info-title drop-shadow">';

    if ($editable) {
        $output .= '<input type="text" class="info-title-content editable" value="' . $text . '" id="' . $id . '">';
    } else {
        if (strlen($text) > $max_length) {
            $shortened_text = wordwrap($text, $max_length, "<br>\n", true);
            $output .= '<h3 class="info-title-content">' . $shortened_text . '</h3>';
        } else {
            $output .= '<h3 class="info-title-content">' . $text . '</h3>';
        }
    }

    $output .= '</div>';

    return $output;
}
