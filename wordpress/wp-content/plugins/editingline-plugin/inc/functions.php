<?php

function dp_add_custom_metabox() {
    $post_types = ['digital-print', 'post-printing', 'pre-printing', 'consumables']; // Array dei post types
    foreach ($post_types as $post_type) {
        add_meta_box(
            'dp_dimensions',          // ID of the metabox
            __('Dimensions', 'text_domain'), // Title of the metabox
            'dp_dimensions_callback', // Callback function
            $post_type,               // Post type
            'side',                   // Context (where to display)
            'default'                 // Priority
        );
    }
}

function dp_dimensions_callback($post) {
    wp_nonce_field(basename(__FILE__), 'dp_nonce');
    $dp_width = get_post_meta($post->ID, 'dp_width', true);
    $dp_height = get_post_meta($post->ID, 'dp_height', true);

    ?>
<p>
    <label for="dp_width"><?php _e('Width (cm):', 'text_domain'); ?></label>
    <input type="text" id="dp_width" name="dp_width" value="<?php echo esc_attr($dp_width); ?>" />
</p>
<p>
    <label for="dp_height"><?php _e('Height (cm):', 'text_domain'); ?></label>
    <input type="text" id="dp_height" name="dp_height" value="<?php echo esc_attr($dp_height); ?>" />
</p>
<?php
}

add_action('add_meta_boxes', 'dp_add_custom_metabox');

function dp_save_metabox_data($post_id) {
    if (!isset($_POST['dp_nonce']) || !wp_verify_nonce($_POST['dp_nonce'], basename(__FILE__)) || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || !current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['dp_width'])) {
        update_post_meta($post_id, 'dp_width', sanitize_text_field($_POST['dp_width']));
    }
    if (isset($_POST['dp_height'])) {
        update_post_meta($post_id, 'dp_height', sanitize_text_field($_POST['dp_height']));
    }
}

add_action('save_post', 'dp_save_metabox_data');

function lom_render_blocks($blocks) {
    // Rimuovere temporaneamente wpautop per evitare l'inserimento di tag <p></p> vuoti
    remove_filter('the_content', 'wpautop');

    $rendered_content = '';

    foreach ($blocks as $block) {
        $rendered_content .= apply_filters('the_content', render_block($block));
    }

    // Reaggiungere wpautop
    add_filter('the_content', 'wpautop');

    return $rendered_content;
}

function lom_get_blocks($input, $blockName) {
    if (is_int($input)) {
        $post = get_post($input);
        $input = parse_blocks($post->post_content);
    }

    if (is_string($input)) {
        $input = parse_blocks($input);
    }

    $results = array();

    foreach ($input as $block) {
        if ($block['blockName'] == $blockName) {
            $results[] = $block;
        } else {
            if (isset($block['innerBlocks']) && count($block['innerBlocks']) > 0) {
                $results = array_merge($results, lom_get_blocks($block['innerBlocks'], $blockName));
            }
        }
    }

    return $results;
}


function lom_get_group_contents($input, $groupClassName) {
    $groups = lom_get_blocks($input, 'core/group');
    $contents = []; // Inizializza un array vuoto per i contenuti

    foreach ($groups as $group) {
        // Controlla se il gruppo contiene la classe specificata
        if (isset($group['attrs']['className']) && strpos($group['attrs']['className'], $groupClassName) !== false) {
            foreach ($group['innerBlocks'] as $innerBlock) {
                // Controlla se il blocco interno ha una classe
                if (isset($innerBlock['attrs']['className'])) {
                    $className = $innerBlock['attrs']['className'];
                    // Se non esiste già una chiave per questa classe, inizializzala come array vuoto
                    if (!isset($contents[$className])) {
                        $contents[$className] = [];
                    }
                    // Aggiungi il contenuto renderizzato all'array della classe corrispondente
                    $contents[$className][] = lom_render_blocks([$innerBlock]);
                }
            }
            // Rimuovi break se vuoi continuare a cercare in altri gruppi con la stessa className
            break;
        }
    }

    return $contents;
}
