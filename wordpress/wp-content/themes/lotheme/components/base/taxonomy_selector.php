<?php

function taxonomy_selector($action_url, $taxonomy_name, $field_name) {

    $taxonomy_selector = '';
    $terms = get_terms(array(
        'taxonomy' => $taxonomy_name,
        'hide_empty' => true,
    ));
    $selected_typology = isset($_GET[$field_name]) ? $_GET[$field_name] : '';

    $taxonomy_selector.='<form class = "taxonomy_selector" action="' . site_url($action_url) . '" method="get">';
    $taxonomy_selector.='<div class="select-container">';
    $taxonomy_selector.='<span class="material-symbols-outlined">keyboard_arrow_down</span>';
    $taxonomy_selector.='<select name="' . $field_name . '"  onchange="this.form.submit()">';
    $taxonomy_selector.='<option value="">Tutte le Tipologie</option>';

    foreach ($terms as $term) {
        $selected = ($term->slug === $selected_typology) ? 'selected' : '';
        $taxonomy_selector.='<option value="' . $term->slug . '" ' . $selected . '>' . $term->name . '</option>';
    }

    $taxonomy_selector.='</select>';
    $taxonomy_selector.='</div>';
    // $taxonomy_selector.='<input type="submit" value="Filtra">';
    $taxonomy_selector.='</form>';

    return array('taxonomy_selector' => $taxonomy_selector, 'selected_typology' => $selected_typology);
}