<?php
/**
 * The header for our theme
 * This is the template che visualizza tutta la sezione <head> e tutto fino a <div id="content">
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

        // Estrarre l'ultima parola dell'URL del menu per ottenere il vero nome del CPT
        $url_parts = explode('/', rtrim($menu_item->url, '/'));
        $cpt_name = end($url_parts);

        // Se il titolo del menu è "MATERIALI", recupera le pagine del CPT "materiali"
        if ($menu_item->title == 'Materiali') {
            $args = [
                'post_type' => 'consumable',
                'posts_per_page' => -1, // Recupera tutte le pagine
                'post_status' => 'publish',
            ];
            $materiali_posts = new WP_Query($args);
            if ($materiali_posts->have_posts()) {
                while ($materiali_posts->have_posts()) {
                    $materiali_posts->the_post();
                    $custom_menu_array[$parent_id]['children'][] = [
                        'title' => get_the_title(),
                        'url' => get_permalink(), // Usa il permalink diretto della pagina
                        'slug' => str_replace(' ', '-', strtolower(get_the_title()))
                    ];
                }
                wp_reset_postdata();
            }
        } else {
            // Costruisci dinamicamente il nome della tassonomia
            $taxonomy = $cpt_name . '-typology';
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    $custom_menu_array[$parent_id]['children'][] = [
                        'title' => $term->name,
                        'url' => get_term_link($term),
                        'slug' => $term->slug
                    ];
                }
            } else {
                error_log('Errore nella tassonomia: ' . $taxonomy . ' - ' . (is_wp_error($terms) ? $terms->get_error_message() : 'Nessun termine trovato'));
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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,1,200" rel="stylesheet" />
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
                        echo '<div class="triangle"></div>';
                        if (!empty($menu_item['children'])) {
                            echo '<div class="submenu">';
                            foreach ($menu_item['children'] as $child) {
                                if ($menu_item['title'] == 'Materiali') {
                                    echo submenu_link($child['url'], esc_html($child['title']));
                                } else {
                                    $url = $menu_item['url'] . '?typology=' . $child['slug'];
                                    echo submenu_link($url, esc_html($child['title']));
                                }
                            }
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </nav>
        </header>
        <div class="overlay"></div>
        <div class="site-content-container">
