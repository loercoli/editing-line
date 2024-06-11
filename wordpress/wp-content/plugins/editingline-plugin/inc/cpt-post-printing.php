<?php
function register_post_printing_cpt_and_taxonomies() {
    // Register Custom Post Type Post-Printing
    $labels = array(
        'name'                  => _x('Post Printings', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Post Printing', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Finitura', 'text_domain'),
        'name_admin_bar'        => __('Post Printing', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Post Printing', 'text_domain'),
        'description'           => __('Custom Post Type for Post Printing', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'), 
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-desktop',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type('post-printing', $args);


    // Register Custom Taxonomy for Post-Printing Typology
    $labels = array(
        'name'                       => _x('Post-printing-typologies', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Typology', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Typology', 'text_domain'),
        'all_items'                  => __('All Typologies', 'text_domain'),
        'parent_item'                => __('Parent Typology', 'text_domain'),
        'parent_item_colon'          => __('Parent Typology:', 'text_domain'),
        'new_item_name'              => __('New Typology Name', 'text_domain'),
        'add_new_item'               => __('Add New Typology', 'text_domain'),
        'edit_item'                  => __('Edit Typology', 'text_domain'),
        'update_item'                => __('Update Typology', 'text_domain'),
        'view_item'                  => __('View Typology', 'text_domain'),
        'separate_items_with_commas' => __('Separate typologies with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove typologies', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Typologies', 'text_domain'),
        'search_items'               => __('Search Typologies', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No items', 'text_domain'),
        'items_list'                 => __('Typologies list', 'text_domain'),
        'items_list_navigation'      => __('Typologies list navigation', 'text_domain'),
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
    register_taxonomy('post-printing-typology', array('post-printing'), $args);
}

add_action('init', 'register_post_printing_cpt_and_taxonomies');
