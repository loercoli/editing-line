<?php get_header(); 

$page_name = 'Finiture';
$action_url = 'post-printing';
$taxonomy_name = 'post-printing-typology';
$field_name =  'typology';

$header_archive_page = header_archive_page($page_name, $action_url, $taxonomy_name, $field_name);
$header_archive_html = $header_archive_page['header_archive_html'];
$selected_typology = $header_archive_page['selected_typology'];

echo $header_archive_html;

?>
<div class="block archive-block">
    <div class="main-column list-post-container">
        <?php filter_typology_cpt($action_url, $selected_typology, $taxonomy_name); ?>
    </div>
</div>

<?php
get_footer();