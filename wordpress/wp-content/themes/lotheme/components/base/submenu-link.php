<?php


function submenu_link($url, $label) {
    $submenu_html = '';
    $submenu_html .= '<a class="submenu-item" href="' . htmlspecialchars($url) . '">
                        <div class="main-column heading-big">' . htmlspecialchars($label) . '</div>
                    </a>';
    return $submenu_html;
}