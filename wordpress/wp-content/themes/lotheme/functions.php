<?php

// Disabilita la barra di amministrazione per tutti gli utenti
show_admin_bar(false);

// Registra gli stili del tema
function theme_enqueue_styles() {
    wp_enqueue_style('theme-main-styles', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Registra gli script del tema
function theme_enqueue_scripts() {
    wp_enqueue_script(
        'my-custom-script',
        get_template_directory_uri() . '/js/script.js',
        array(), // Dipendenze, se presenti, vanno qui
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Registra i menu del tema
function register_my_menus() {
    register_nav_menus([
        'editing-menu' => __('Editing menu', 'textdomain'),
    ]);
}
add_action('init', 'register_my_menus');

// Aggiunge supporto per il logo personalizzato
function mytheme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mytheme_setup');

function my_custom_gallery_block_render($block_content, $block) {
    if ($block['blockName'] === 'core/gallery') {
        $new_html = '<div id="carousel" class="flicking-viewport"><div class="flicking-camera">';
  
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($block_content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
  
        $figures = $dom->getElementsByTagName('figure');
  
        foreach ($figures as $index => $figure) {
            if ($index !== 0) { 
                $new_html .= '<div class="panel">' . $dom->saveHTML($figure) . '</div>';
            }
        }
  
        $new_html .= '</div></div>';
  
        $block_content = $new_html;
    }
    return $block_content;
  }
  add_filter('render_block', 'my_custom_gallery_block_render', 10, 2);





// Funzione per filtrare i post per tipologia (incompleta, mancano dettagli)
function filter_typology_cpt($action_url, $selected_typology, $taxonomy_name) {
    $args = array(
        'post_type' => $action_url,
        'posts_per_page' => -1,
        'tax_query' => array()
    );

    if (!empty($selected_typology)) {
        $args['tax_query'][] = array(
            'taxonomy' => $taxonomy_name,
            'field'    => 'slug',
            'terms'    => $selected_typology,
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Assumiamo che print_item_in_list sia una funzione definita altrove per stampare i post
            echo print_item_in_list($taxonomy_name);
        }
        wp_reset_postdata();
    } else {
        echo '<p>Nessun risultato trovato.</p>';
    }
}

// Include componenti aggiuntivi se necessario
require get_template_directory() . '/components/index.php';

