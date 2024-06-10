<?php
	add_action( 'init', function() {
		$post_type = 'consumable'; // il nome del cpt
		$post_type_object = get_post_type_object( $post_type );
		$post_type_object->template = array(
			
			// cover_group
			array(
				'core/group',
				array(
					'className' => 'cover_group'
				),
				array(
					array(
						'core/heading',
						array(
							'className' => 'consumable_subtitle',
							'placeholder' => 'Sottotitolo',
							'level' => 3
						)
					),
					array(
						'core/post-featured-image',
						array(
							'className' => 'consumable_cover',
						)
					),
					array( 
						'core/paragraph',
						array(
						'className' => 'consumable_product_description',
						'placeholder' => 'Descrizione del prodotto',
						)
					),
				)
			)
		);
	});
?>
