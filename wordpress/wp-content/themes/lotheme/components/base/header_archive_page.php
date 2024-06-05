<?php
function header_archive_page($page_name, $action_url, $taxonomy_name, $field_name){

    $taxonomy_input = taxonomy_selector($action_url, $taxonomy_name, $field_name);
    $taxonomy_selector = $taxonomy_input['taxonomy_selector'];
    $selected_typology = $taxonomy_input['selected_typology'];
    $header_archive_html = '';
    $page_class = str_replace(" ", "-", strtolower($page_name));

    $header_archive_html.='<div class="block header-archive ' . $page_class . ' " >';
    $header_archive_html.='<div class="main-column">';
    $header_archive_html.='<h1 class="display">' .$page_name .'</h1>';
    $header_archive_html.= $taxonomy_selector;
    $header_archive_html.='</div>';
    $header_archive_html.='</div>';
    
    return array('header_archive_html' =>$header_archive_html, 'selected_typology' => $selected_typology);

}