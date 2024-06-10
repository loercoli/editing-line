<?php

function print_item_in_list($taxonomy_name) {

    $post_id = get_the_ID(); // Ottieni l'ID del post corrente nel Loop
    $post_data = get_post($post_id); // Ottieni l'oggetto post

    // Controlla se il post è figlio; se lo è, esce dalla funzione
    if ($post_data->post_parent > 0) {
        return ''; // Torna vuoto se è un figlio
    }

    $digital_print_title = get_the_title($post_id);
    $post_link = get_permalink($post_id);
    $thumbnail = get_the_post_thumbnail($post_id, 'full', ['class' => 'custom-class', 'alt' => 'Immagine di copertina']);
    
    // Prepara l'array per memorizzare i dati dei figli
    $children_data = [];

    // Recupera i figli
    $args = array(
        'post_type' => get_post_type($post_id),
        'posts_per_page' => -1, // Ottieni tutti i post figli
        'post_parent' => $post_id,
        'post_status' => 'publish',
    );

    $typology_color = '';

    switch ($taxonomy_name) {
        case 'pre-printing-typology':
            $typology_color = 'quaternary';
            break;
        case 'digital-print-typology':
            $typology_color = 'primary';
            break;
        case 'post-printing-typology':
            $typology_color = 'tertiary';
            break;
        case 'consumable-typology':
            $typology_color = 'secondary';
            break;
        default:
            $typology_color = 'primary';
            break;
    }


        

    $children = new WP_Query($args);
    if ($children->have_posts()) {
        while ($children->have_posts()) {
            $children->the_post();
            $child_id = get_the_ID();
            $width = get_post_meta($child_id, 'dp_width', true);
            $height = get_post_meta($child_id, 'dp_height', true);
            $children_data[] = [
                'title' => get_the_title(),
                'width' => $width,
                'height' => $height
            ];
        }
    }
    wp_reset_postdata(); // Resetta il post data al contesto originale

    $brands = get_the_terms($post_id, 'brand');
    $digital_print_brand = '';
    if (!empty($brands) && !is_wp_error($brands)) {
        foreach ($brands as $brand) {
            $digital_print_brand = $brand->name;
        }
    }

    $typologies = get_the_terms($post_id, $taxonomy_name);
    $digital_print_typology = '';
    if (!empty($typologies) && !is_wp_error($typologies)) {
        foreach ($typologies as $typology) {
            $digital_print_typology = $typology->name;
        }
    }

    // Costruisci l'HTML
    $print_item_in_list = '<a class="print-item-container ' . $taxonomy_name . '" href="' . esc_url($post_link) . '">';
    $print_item_in_list .= '<div class="info-container">';
    $print_item_in_list .= '<div class="tag-category-post">';
    if (!empty($digital_print_typology)) {
        $print_item_in_list .= chip("filled", $typology_color, $digital_print_typology, "none", false);
    }
    if (!empty($digital_print_brand)) {
        $print_item_in_list .= chip("filled", "bright", $digital_print_brand, "none", false);
    }
    $print_item_in_list .= '</div>';
    $print_item_in_list .= '<h2>' . esc_html($digital_print_title) . '</h2>';
    $print_item_in_list .= '<div class = "children-container"><p class="child-title">';
    foreach ($children_data as $child) {
        $print_item_in_list .= esc_html($child['title']) . ' | ' ;
    }
    $print_item_in_list .= '</p></div>';
    $print_item_in_list .= '</div>';
    $print_item_in_list .= '<div class="image-container col-3">';
    $print_item_in_list .= $thumbnail;
    $print_item_in_list .= '</div>';
    $print_item_in_list .= '</a>';

    return $print_item_in_list;
}