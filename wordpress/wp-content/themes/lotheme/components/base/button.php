<?php

/**Print a button
button(array(
    'size' => 'small' | 'medium' | 'big' | 
    'style' => 'filled' | 'outlined' | 'tonal' | 'text-only' ;
    'color' => 'primary' | 'secondary' | 'tertiary' | 'quartary';
    'label' => 'label';
    'icon' => 'search';
));
*/

function button($params = array()) {
    $button_html = '';
    
    $text_class = !isset($params['size']) ? "button-small" : "button-" . $params['size'];
    $style = !isset($params['style']) ? "filled" : $params['style'];
    $color = !isset($params['color']) ? "primary" : $params['color'];

    $button_html .= '<button class="button ' . htmlspecialchars($style) . ' ' . htmlspecialchars($color) . '">';

    if (isset($params['label'])) {
        $button_html .= '<div class="label ' . htmlspecialchars($text_class) . '">' . htmlspecialchars($params['label']) . '</div>';
    }

    if (isset($params['icon']) && $params['icon'] != "none") {
        $iconSizeClass = isset($params['iconSize']) ? "icon-" . $params['iconSize'] : "icon-default";
        $button_html .= '<span class="icon ' . htmlspecialchars($iconSizeClass) . ' material-symbols-outlined">' . htmlspecialchars($params['icon']) . '</span>';
    }

    $button_html .= '</button>';

    return $button_html;
}

?>