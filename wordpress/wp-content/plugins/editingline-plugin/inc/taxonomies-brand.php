<?php
function register_brand_taxonomy() {
    // Register Global Custom Taxonomy for Brand
    $labels = array(
        'name'                       => _x('Brands', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Brand', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Brand', 'text_domain'),
        'all_items'                  => __('All Brands', 'text_domain'),
        'parent_item'                => __('Parent Brand', 'text_domain'),
        'parent_item_colon'          => __('Parent Brand:', 'text_domain'),
        'new_item_name'              => __('New Brand Name', 'text_domain'),
        'add_new_item'               => __('Add New Brand', 'text_domain'),
        'edit_item'                  => __('Edit Brand', 'text_domain'),
        'update_item'                => __('Update Brand', 'text_domain'),
        'view_item'                  => __('View Brand', 'text_domain'),
        'separate_items_with_commas' => __('Separate brands with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove brands', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Brands', 'text_domain'),
        'search_items'               => __('Search Brands', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No items', 'text_domain'),
        'items_list'                 => __('Brands list', 'text_domain'),
        'items_list_navigation'      => __('Brands list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy('brand', array(), $args); // Empty array for initially no post types
}

add_action('init', 'register_brand_taxonomy');

// Adjusted function to ensure 'brand' taxonomy is correctly associated with both CPTs
function ensure_brand_taxonomy_for_cpts() {
    register_taxonomy_for_object_type('brand', 'digital-print');
    register_taxonomy_for_object_type('brand', 'pre-printing');
    register_taxonomy_for_object_type('brand', 'post-printing');
    register_taxonomy_for_object_type('brand', 'consumable');
    // Add any additional CPTs as needed
}