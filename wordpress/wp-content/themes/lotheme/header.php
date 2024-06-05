<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Loemme_Theme
 */
$locations = get_nav_menu_locations();
$menu_id = $locations['editing-menu']; // Assicurati che 'loemme-menu' sia lo slug corretto della posizione del menu
$menu_items = wp_get_nav_menu_items($menu_id);
$custom_menu_array = [];

foreach ($menu_items as $menu_item) {
    // Controlla se l'elemento del menu è un genitore
    if (!$menu_item->menu_item_parent) {
        $parent_id = $menu_item->ID;
        $custom_menu_array[$parent_id] = [
            'title' => $menu_item->title,
            'url' => $menu_item->url,
            'children' => [],
        ];

        // Cerca figli per questo elemento
        foreach ($menu_items as $submenu_item) {
            if ($submenu_item->menu_item_parent == $parent_id) {
                $custom_menu_array[$parent_id]['children'][] = [
                    'title' => $submenu_item->title,
                    'url' => $submenu_item->url,
                    'slug' => str_replace(' ', '-', strtolower($submenu_item->title))
                ];
            }
        }
    }
}

$custom_logo_id = get_theme_mod('custom_logo');
$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link
        href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,1,200"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <script src="https://unpkg.com/@egjs/flicking/dist/flicking.pkgd.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/@egjs/flicking/dist/flicking.css" crossorigin="anonymous" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <nav id="site-navigation" class="main-navigation editing-menu">
                <div class="logo-img">
                    <img src="<?= esc_url($logo[0]) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>">
                </div>
                <div class="container-navigation-buttons">
                    <?php

                foreach ($custom_menu_array as $menu_item) {
                    echo '<div class="menu-item">';
                    echo '<a href="' . esc_url($menu_item['url']) . '">' . button(array(
                        'size' => 'medium', 
                        'style' => 'text-only', 
                        'color' => 'primary',
                        'label' => $menu_item['title'],
                    )) . '</a>';
                    if (!empty($menu_item['children'])) {
                        echo '<div class="submenu">';
                        foreach ($menu_item['children'] as $child) {
                            $url = $menu_item['url'] . '?typology=' . $child['slug'];
                            echo submenu_link($url, esc_html($child['title']));
                        }
                        echo '</div>'; // Chiude .submenu
                    }
                    echo '</div>'; // Chiude .menu-item
                }
                ?>
                </div>
            </nav>
        </header>
        <div class="site-content-container">