<?php


function chip($style = "filled", $color = "primary", $label = "none", $left_icon = "none", $close_icon = false){

    $chip_html = '';
    
    $chip_html .= '<div class="chip ' . htmlspecialchars($style) . ' ' . htmlspecialchars($color) . '">';
    if ($left_icon != "none") {
        $chip_html .= '<span class="icon  material-symbols-outlined">' . htmlspecialchars($left_icon) . '</span>';
    }
    if ($lable != "none") {
        $chip_html .= '<div class="label label-big">' . htmlspecialchars($label) . '</div>';
    }
    if ($close_icon) {
        $chip_html .= '<span class="icon  material-symbols-outlined">close</span>';
    }
    $chip_html .= '</div>';

    return $chip_html; // Restituisce il markup invece di stamparlo
}