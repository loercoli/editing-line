<?php
add_action('init', function() {
    $post_type = 'consumables'; // il nome del cpt
    $post_type_object = get_post_type_object($post_type);
    $post_type_object->template = array(
        
        // cover-group
        array(
            'core/group',
            array(
                'metadata' => array('name' => 'cover'),
                'className' => 'cover'
            ),
            array(
                array(
                    'core/heading',
                    array(
                        'placeholder' => 'Sottotitolo',
                        'level' => 2
                    )
                ),
                array(
                    'core/post-featured-image',
                    array()
                ),
            )
        ),
        
        // cover-info
        array(
            'core/group',
            array(
                'metadata' => array('name' => 'info'),
                'className' => 'info'
            ),
            array(
                array(
                    'core/paragraph',
                    array(
                        'placeholder' => 'Descrizione del prodotto'
                    )
                ),
            )
        ),
    );
});